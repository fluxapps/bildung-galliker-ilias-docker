<?php

namespace fluxlabs\Plugins\IQSoftEvent\Infrastructure\ActiveRecord;

use ActiveRecord;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class FailedTransmissionAR extends ActiveRecord
{
    const TABLE_NAME = 'iqse_failed';

    /**
     * @var int
     * @con_is_primary true
     * @con_is_unique  true
     * @con_has_field  true
     * @con_sequence   true
     * @con_fieldtype  integer
     * @con_length     8
     */
    protected $id;
    /**
     * @var int
     * @con_has_field       true
     * @con_fieldtype       integer
     * @con_length          8
     * @db_is_notnull       true
     */
    protected $certificate_id;
    /**
     * @var string
     * @con_has_field       true
     * @con_fieldtype       clob
     * @db_is_notnull       true
     */
    protected $error_msg;
    /**
     * @var string
     * @con_has_field true
     * @con_fieldtype text
     * @con_length    1024
     */
    protected $stack_trace;
    /**
     * @var int
     * @con_has_field       true
     * @con_fieldtype       integer
     * @con_length          8
     * @db_is_notnull       true
     */
    protected $timestamp;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCertificateId() : int
    {
        return $this->certificate_id;
    }

    /**
     * @param int $certificate_id
     */
    public function setCertificateId(int $certificate_id)
    {
        $this->certificate_id = $certificate_id;
    }

    /**
     * @return string
     */
    public function getErrorMsg() : string
    {
        return $this->error_msg;
    }

    /**
     * @param string $error_msg
     */
    public function setErrorMsg(string $error_msg)
    {
        $this->error_msg = $error_msg;
    }

    /**
     * @return string
     */
    public function getStackTrace() : string
    {
        return $this->stack_trace;
    }

    /**
     * @param string $stack_trace
     */
    public function setStackTrace(string $stack_trace)
    {
        $this->stack_trace = $stack_trace;
    }

    /**
     * @return int
     */
    public function getTimestamp() : int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     */
    public function setTimestamp(int $timestamp)
    {
        $this->timestamp = $timestamp;
    }


    public function getConnectorContainerName()
    {
        return self::TABLE_NAME;
    }

}
