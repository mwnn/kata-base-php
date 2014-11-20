<?php

namespace Kata\Test\H05API;

use Kata\H05API\User;
use Kata\H05API\Generator;
use Kata\H05API\UserBuilder;

class UserBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var UserBuilder
     */
    private $builder;

    /**
     * test setup
     */
    public function setUp()
    {
        $this->builder   = new UserBuilder(new Generator(), 8, 16);
    }

    /**
     * @param $username
     * @param $password
     *
     * @dataProvider dataForTestUserObjectCreateWithUsernameAndPassword
     */
    public function testUserObjectCreateWithUsernameAndPassword($username, $password)
    {
        $user = $this->builder->createUserWithPassword($username, $password);

        $this->assertInstanceOf('Kata\H05API\User', $user);

        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($password, $user->getPassword());
        $this->assertTrue(password_verify($password, $user->getHashedPassword()));
    }

    /**
     * @param $username
     * @param $password
     *
     * @dataProvider dataForTestUserObjectCreateWithUsernameAndPassword
     */
    public function testUserObjectCreateWithUsernameAndGeneratedPassword($username, $password)
    {
        $user = $this->builder->createUserWithGeneratedPassword($username, 10, 'TheMinSaltIs22Character');

        $this->assertInstanceOf('Kata\H05API\User', $user);

        $this->assertEquals($username, $user->getUsername());
        $this->assertNotEmpty($user->getPassword());
        $this->assertTrue(password_verify($user->getPassword(), $user->getHashedPassword()));
    }

    public function dataForTestUserObjectCreateWithUsernameAndPassword()
    {
        return array(
            array('mwnn', 'asdfgh123'),
            array('mwnn43', 'xcva12945sdasb234'),
        );
    }
}
