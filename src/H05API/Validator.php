<?php

namespace Kata\H05API;

/**
 * Class Validator
 * @package Kata\H05API
 */
class Validator
{
    const DEFAULT_USERNAME_MIN_LENGTH = 4;
    const DEFAULT_USERNAME_MAX_LENGTH = 128;
    const DEFAULT_PASSWORD_MIN_LENGTH = 6;

    /**
     * @param $username
     *
     * @return bool
     */
    public function validateUsername($username)
    {
        $lengthResult = $this->validateLength($username, self::DEFAULT_USERNAME_MIN_LENGTH, self::DEFAULT_USERNAME_MAX_LENGTH);
        $contentResult = $this->isAlpha($username);

        return ($lengthResult && $contentResult);
    }

    /**
     * @param $password
     * @param $password_confirm
     *
     * @return bool
     */
    public function validatePassword($password, $password_confirm)
    {
        $lengthResult = $this->validateLength($password, self::DEFAULT_PASSWORD_MIN_LENGTH);
        $passwordsMatch = ($password === $password_confirm);

        return ($lengthResult && $passwordsMatch);
    }

    /**
     * @param $username
     * @param $minLength
     * @param null $maxLength
     *
     * @return bool
     */
    private function validateLength($username, $minLength, $maxLength=null)
    {
        $result = true;

        if (strlen($username) < (int)$minLength)
        {
            $result = false;
        }
        elseif(is_int($maxLength)
            && strlen($username) > (int)$maxLength
        )
        {
            $result = false;
        }

        return $result;
    }

    /**
     * @param $username
     *
     * @return bool
     */
    public function isAlpha($username)
    {
        $result = preg_match_all("/[^0-9a-z]/", $username, $matches);

        return ($result === 0);
    }
} 