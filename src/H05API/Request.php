<?php

namespace Kata\H05API;

/**
 * Class Request
 * @package Kata\H05API
 */
class Request
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
    private $password_confirm;

    /**
     * @param $username
     * @param $password
     * @param $passwordConfirm
     */
    public function __construct($username='', $password='', $passwordConfirm='')
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setPasswordConfirm($passwordConfirm);
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
     * @param $password
     */
    public function setPasswordConfirm($password)
    {
        $this->password_confirm = $password;
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
    public function getPasswordConfirm()
    {
        return $this->password_confirm;
    }
}






