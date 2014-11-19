<?php

namespace Kata\H05API;

/**
 * Class Response
 * @package Kata\H05API
 */
class Response
{
    /**
     * @var string
     */
    private $success;

    /**
     * @var int
     */
    private $resultCode;

    /**
     * @var int
     */
    private $resultId;

    /**
     * Constructor.
     *
     * @param $success
     * @param $resultCode
     * @param $resultId
     */
    public function __construct($success, $resultCode, $resultId)
    {
        $this->setSuccess($success);
        $this->setResultCode($resultCode);
        $this->setResultId($resultId);
    }

    /**
     * @param bool $success
     */
    public function setSuccess($success)
    {
        $this->success = (true === (bool)$success) ? 'yes' : 'no';
    }

    /**
     * @param int $code
     */
    public function setResultCode($code)
    {
        $this->resultCode = (int)$code;
    }

    /**
     * @param int $id
     */
    public function setResultId($id)
    {
        $this->resultId = (int)$id;
    }

    /**
     * @return array
     *
     * <pre>
     * success:
     *     'yes' - if ok
     *     'no'  - if any failure
     *
     * resultCode:
     *     201 - if ok
     *     601 - username format error
     *     602 - password format error701 - username already exists
     *     500 - other error (eg. database exception)
     *
     * resultId:
     *     users.id field value - if ok
     *     0 - if any failure
     * </pre>
     */
    public function getResponse()
    {
        return array(
            "success"    => $this->success,
            "resultCode" => $this->resultCode,
            "resultId"   => ('yes' === $this->success) ? $this->resultId : 0,
        );
    }
}
