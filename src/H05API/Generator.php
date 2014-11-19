<?php

namespace Kata\H05API;

use Kata\H05API\GeneratorException;

/**
 * Class Generator
 * @package Kata\H05API
 */
class Generator
{
    /**
     * Generate random password
     *
     * @param int $randomSource  Random generation source. Use:
     *
     * - on Windows: MCRYPT_RAND (system random number generator)
     * - on Linux:
     *   - MCRYPT_DEV_RANDOM (/dev/random)
     *   - MCRYPT_DEV_URANDOM (/dev/urandom)
     *
     * @return string
     */
    public function generateRandomPassword($minLength, $maxLength, $randomSource = MCRYPT_RAND)
    {
        if ($minLength < 1)
        {
            throw new GeneratorException(sprintf("Minimum password length have to be greater than 0, '%s' is given.", $minLength));
        }

        $min = round($minLength / 2, 0, PHP_ROUND_HALF_UP);
        $max = round($maxLength / 2, 0, PHP_ROUND_HALF_UP);

        $token = bin2hex(mcrypt_create_iv(mt_rand($min, $max), $randomSource));

        if (1 === ($maxLength%2))
        {
            // cut last char in case of odd numbers
            $token = substr($token, 0, -1);
        }

        return $token;
    }
}
