<?php

namespace Kata\H05API;

class UserBuilder
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var int
     */
    private $minPasswordLength;

    /**
     * @var int
     */
    private $maxPasswordLength;

    /**
     * Constructor.
     *
     * @param Generator $generator
     */
    public function __construct(Generator $generator, $minPasswordLength, $maxPasswordLength)
    {
        $this->generator = $generator;
        $this->minPasswordLength = $minPasswordLength;
        $this->maxPasswordLength = $maxPasswordLength;
    }

    /**
     * Create user withGiven password.
     *
     * @param $username
     * @param $password
     *
     * @return User
     */
    public function createUserWithPassword($username, $password)
    {
        $hashedPassword = $this->hashPassword($password);
        $user = new User($username, $password, $hashedPassword);

        return $user;
    }

    /**
     * Create user with generated password.
     *
     * @param $username
     *
     * @return User
     */
    public function createUserWithGeneratedPassword($username, $hashCost=10, $salt='')
    {
        $randomPassword = $this->generator->generateRandomPassword($this->minPasswordLength, $this->maxPasswordLength);
        $hashedPassword = $this->hashPassword($randomPassword, PASSWORD_DEFAULT, $hashCost, $salt);

        $user = new User($username, $randomPassword, $hashedPassword);

        return $user;
    }

    /**
     * Hash a password.
     *
     * @param $password
     * @param int $algorithm   Default: PASSWORD_DEFAULT
     * @param int $cost        Default 10
     * @param string $salt     Not needed but it could be given
     *
     * @return bool|string
     */
    private function hashPassword($password, $algorithm=PASSWORD_DEFAULT, $cost=10, $salt='')
    {
        $options = array();

        if (is_int($cost) && 10 <= $cost)
        {
            $options['cost'] = $cost;
        }

        if ('' !== $salt && is_string($salt))
        {
            $options['salt'] = $salt;
        }

        $hash = password_hash($password, $algorithm, $options);

        return $hash;
    }
}

