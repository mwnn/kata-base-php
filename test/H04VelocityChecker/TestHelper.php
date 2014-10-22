<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.10.22.
 * Time: 20:30
 */

namespace Kata\Test\H04VelocityChecker;

use Kata\H04VelocityChecker\DAO;
use \PDO;

Class TestHelper
{
    /**
     * @var PDO
     */
    protected static $sqLite = null;

    /**
     * @var DAO
     */
    protected static $DAO = null;

    protected static function initSqlite($sql='')
    {
        self::$sqLite = new PDO('sqlite::memory:', null, null, array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ));

        if ('' !== $sql) {
            self::$sqLite->query($sql);
        }
    }

    protected static function initDAO($sql='')
    {
        if (null === self::$sqLite) {
            self::initSqlite($sql);
        }
        self::$DAO = new DAO();
        self::$DAO->setConnection(self::$sqLite);
    }

    public static function getSqlite($sql)
    {
        if (null === self::$sqLite) {
            self::initSqlite($sql);
        }

        return self::$sqLite;
    }

    public static function getDAO($sql='')
    {
        if (null === self::$DAO) {
            self::initDAO($sql);
        }

        return self::$DAO;
    }

    public static function removeColons(array $data)
    {

        $keysWihoutColon = array_map(function ($key) {
            return str_replace(':', '', $key);
        }, array_keys($data));

        return array_combine($keysWihoutColon, $data);
    }

}