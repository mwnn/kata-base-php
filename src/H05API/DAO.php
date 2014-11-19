<?php

namespace Kata\H05API;

use PDO;

class DAO
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param User $user
     *
     * @return \PDOStatement
     * @throw \PDOException
     */
    public function addUser(User $user)
    {
        $q   = "INSERT INTO users (username, password_hash) VALUES (:username, :password)";

        $smt = $this->pdo->prepare($q);

        $result = $smt->execute(array(
            ':username' => $user->getUsername(),
            ':password' => $user->getHashedPassword()
        ));

        return $smt;
    }
}
