<?php

namespace Kata\H05API;

/**
 * Class User
 * @package Kata\H05API
 */
class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $hashedPassword;

    /**
     * @param $username
     * @param string $password
     * @param string $hashedPassword
     */
    public function __construct($username, $password = '', $hashedPassword = '')
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setHashedPassword($hashedPassword);
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param $hashedPassword
     */
    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }
}