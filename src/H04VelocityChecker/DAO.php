<?php
/**
 * Created by PhpStorm.
 * User: zoltan.budai
 * Date: 2014.10.21.
 * Time: 23:12
 */
namespace Kata\H04VelocityChecker;
use PDO;

class DAO
{
    /**
     * @var PDO
     */
    private $connection = null;

    public function setConnection(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param $sql
     * @param $data
     * @return \PDOStatement
     * @throws \PDOException
     */
    protected function exec($sql, $data)
    {
        $smt = $this->getConnection()->prepare($sql);
        $res = $smt->execute($data);

        if (false === $res)
        {
            $query = $sql;
            foreach ($data as $key => $val)
            {
                $query = str_replace($key, $val, $query);
            }

            throw new \PDOException(sprintf("Query failed!\nSQL:\n%s,\nData:\n%s", $sql, serialize($data)));
        }

        return $smt;
    }

    /**
     * @param array $data
     * @throws \PDOException
     */
    public function insertRecord(array $data)
    {
        $sql = sprintf("
          INSERT INTO Counter
            (propertyType, propertyValue, counter, ts_create, ts_expiry)
          VALUES
            (:propertyType, :propertyValue, :counter, :ts_create, :ts_expiry);");

        $smt = $this->exec($sql, $data);
    }

    /**
     * @param $id
     * @return array|mixed
     * @throws \PDOException
     */
    public function getRecordById($id)
    {
        $data = array(':id' => (int)$id);
        $sql = "SELECT * FROM Counter WHERE id = :id;";

        $smt = $this->exec($sql, $data);

        return $smt->fetch();
    }
}