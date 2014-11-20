<?php

namespace Kata\Test\H05API;

use Kata\H05API\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check response array format
     */
    public function testGetResponseFormat()
    {
        $responseObj = new Response(true, 404, 1);
        $response = $responseObj->getResponse();

        $this->assertArrayHasKey("success", $response);
        $this->assertArrayHasKey("resultCode", $response);
        $this->assertArrayHasKey("resultId", $response);
    }

    /**
     * @dataProvider dataForTestGetResponseValues
     */
    public function testGetResponseValues($success, $resultCode, $resultId)
    {
        $responseObj = new Response($success, $resultCode, $resultId);
        $response = $responseObj->getResponse();

        $expected = array(
            "success" => ($success ? 'yes' : 'no'),
            "resultCode" => $resultCode,
            "resultId" => $resultId,
        );

        $this->assertEquals($expected, $response);
    }

    public function dataForTestGetResponseValues()
    {
        return array(
            array(true,  201,   1),
            array(false, 121,   0),
            array(true,  623,   1422),
            array(false, 34534, 0),
        );
    }
}
 