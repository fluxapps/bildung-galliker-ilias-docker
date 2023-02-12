<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Certificate;

use DateTime;
use JsonSerializable;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class CertificateDTO implements JsonSerializable
{
    const DATE_TIME_FORMAT = 'Y-m-d';

    /**
     * @var string
     */
    private $documentID;
    /**
     * @var int|null
     */
    private $version;
    /**
     * @var int|null
     */
    private $skillID;
    /**
     * @var string
     */
    private $personID;
    /**
     * @var DateTime|null
     */
    private $datum;
    /**
     * @var string
     */
    private $filename;
    /**
     * @var string
     */
    private $bytes;

    /**
     * CertificateDTO constructor.
     * @param string      $documentID
     * @param string|null $personID
     * @param string      $filename
     * @param string      $bytes
     */
    public function __construct(string $documentID, string $personID, string $filename, string $bytes)
    {
        $this->documentID = $documentID;
        $this->personID = $personID;
        $this->filename = $filename;
        $this->bytes = $bytes;
    }

    public function withVersion(int $version) : self
    {
        $clone = clone $this;
        $clone->version = $version;
        return $clone;
    }

    public function withSkillID(int $skillID) : self
    {
        $clone = clone $this;
        $clone->skillID = $skillID;
        return $clone;
    }

    public function withDatum(DateTime $datum) : self
    {
        $clone = clone $this;
        $clone->datum = $datum;
        return $clone;
    }

    /**
     * @return string
     */
    public function getDocumentID() : string
    {
        return $this->documentID;
    }

    /**
     * @return int|null
     */
    public function getVersion() /*: ?int*/
    {
        return $this->version;
    }

    /**
     * @return int|null
     */
    public function getSkillID() /*: int*/
    {
        return $this->skillID;
    }

    /**
     * @return string
     */
    public function getPersonID() : string
    {
        return $this->personID;
    }

    /**
     * @return DateTime|null
     */
    public function getDatum() /*: DateTime*/
    {
        return $this->datum;
    }

    /**
     * @return string
     */
    public function getFilename() : string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getBytes() : string
    {
        return $this->bytes;
    }

    public function jsonSerialize()
    {
        return [
            "DokumentID" => $this->documentID,
            "version" => $this->version,
            "skillID" => $this->skillID,
            "personID" => $this->personID,
            "datum" => $this->datum ? $this->datum->format(self::DATE_TIME_FORMAT) : null,
            "nachweis" => [
                "filename" => $this->filename,
                "bytes" => $this->bytes
            ]
        ];
    }
}
