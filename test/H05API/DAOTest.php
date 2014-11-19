<?php

namespace Kata\Test\H05API;

use PDO;
use Kata\H05API\User;
use Kata\H05API\DAO;

class DAOTest extends \PHPUnit_Framework_TestCase
{
    const DB_FILE = 'test_api.sqlite';

    /**
     * @var PDO
     */
    private static $pdo;

    /**
     * @var DAO
     */
    private $DAO;

    /**
     * Global setup.
     */
    public static function setUpBeforeClass()
    {
        if (file_exists(self::DB_FILE))
        {
            self::tearDownAfterClass();
        }

        $dsn = sprintf("sqlite:%s", self::DB_FILE);
        self::$pdo = new PDO($dsn);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $createUserTableQuery = "
            CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                username VARCHAR(128) NOT NULL UNIQUE,
                password_hash VARCHAR(64) NOT NULL
            );
        ";

        self::$pdo->exec($createUserTableQuery);
    }

    /**
     * Global tearDown.
     */
    public static function tearDownAfterClass()
    {
        unlink(self::DB_FILE);
    }

    /**
     * Test setup.
     */
    public function setUp()
    {
//        self::$pdo->exec("DELETE FROM users;");
        $this->DAO = new DAO(self::$pdo);
    }

    /**
     * @dataProvider dataForTestAddUser
     */
    public function testAddUser($expectedRecord, $user)
    {
        $result = $this->DAO->addUser($user);
        $this->assertInstanceOf('\PDOStatement', $result);

        $q = "SELECT * FROM users ORDER BY id DESC;";

        $smt = self::$pdo->prepare($q);
        $smt->execute();
        $data = $smt->fetch();

        unset($expectedRecord['password']);
        $this->assertEquals($expectedRecord, $data);
    }

    /**
     * @dataProvider dataForTestAddUser
     *
     * @expectedException \PDOException
     * @expectedExceptionCode 23000
     */
    public function testAddUserThrowsExceptionOnDuplicateUserInsert($expectedRecord, $user)
    {
        $result = $this->DAO->addUser($user);

        // insert same -> exception
        $result = $this->DAO->addUser($user);
    }

    public function dataForTestAddUser()
    {
        $userData = Array(
            array('id' => 1, 'username'=> 'Mwnn',        'password' => 'default1234'),
            array('id' => 2, 'username'=> 'WizardOfWar', 'password' => 'table9876')
        );

        $expectedRecords = Array();

        foreach ($userData as $data)
        {
            $data['password_hash'] = hash('sha256', $data['password']);

            $expectedRecords[] = Array(
                $data,
                new User($data['username'], $data['password'], $data['password_hash'])
            );
        }

        return $expectedRecords;
    }
}
 