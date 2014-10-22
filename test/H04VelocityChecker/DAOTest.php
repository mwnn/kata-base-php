<?php

/* TODO:
 * - test setConnection
 * - test insert
 * - test update
 * - test delete
 * - test cleanupExpiredRecords
 * - test getters: user, ip, iprange, country
 */

use Kata\H04VelocityChecker\DAO;
use Kata\Test\H04VelocityChecker\TestHelper;

class DAOTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PDO
     */
    protected static $sqLite;

    /**
     * @var DAO
     */
    protected static $DAO;

    public static function setUpBeforeClass()
    {
        self::$sqLite = TestHelper::getSqlite(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'DBSchema.sql'));
        self::$DAO    = TestHelper::getDAO();
    }

    public static function tearDownAfterClass()
    {
        self::$sqLite = NULL;
        self::$DAO = NULL;
    }

    public function testNoConnection()
    {
        $newDAO = new DAO();
        $this->assertEquals(null, $newDAO->getConnection());
        return $newDAO;
    }

    /**
     * @depends testNoConnection
     */
    public function testSetConnection(DAO $DAO)
    {
        $DAO->setConnection(self::$sqLite);
        $this->assertInstanceOf('PDO', $DAO->getConnection());
    }

    public function testInsertAndGetRecordById()
    {
        $time = time();
        $data = array(
            ':propertyType'  => 'username',
            ':propertyValue' => 'mwnn',
            ':counter' => '1',
            ':ts_create' => $time,
            ':ts_expiry' => $time + 3600,
        );

        self::$DAO->insertRecord($data);

        $data   = TestHelper::removeColons($data); // remove ':' before the given array keys
        $dbData = self::$DAO->getRecordById(1);

        array_shift($dbData); // remove auto increment 'id' value

        $this->assertEquals($data, $dbData);
    }

    /**
     * @expectedException PDOException
     */
    public function testThrowPDOExceptionOnMalformedQueryString()
    {
        $data = array(
            ':propertyType'  => 'username',
            // the other required keys are missing...
        );

        self::$DAO->insertRecord($data);
    }
}