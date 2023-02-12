<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth;

use JsonSerializable;
use League\OAuth2\Client\Token\AccessTokenInterface;
use RuntimeException;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class AuthTokenDTO implements JsonSerializable, AccessTokenInterface
{
    /**
     * @var string
     */
    private $access_token;
    /**
     * @var int
     */
    private $expiry;

    /**
     * AuthTokenDTO constructor.
     * @param string $access_token
     * @param int    $expiry
     */
    public function __construct(string $access_token, int $expiry)
    {
        $this->access_token = $access_token;
        $this->expiry = $expiry;
    }

    public function jsonSerialize()
    {
        return [
            'access_token' => $this->access_token,
            'expiry' => $this->expiry
        ];
    }

    public static function ofArray(array $array) : self
    {
        return new self(
            $array['access_token'],
            $array['expiry']
        );
    }

    public function getToken()
    {
        return $this->access_token;
    }

    public function getRefreshToken()
    {
        return null;
    }

    public function getExpires()
    {
        return $this->expiry;
    }

    public function hasExpired()
    {
        $expires = $this->getExpires();

        if (empty($expires)) {
            throw new RuntimeException('"expires" is not set on the token');
        }

        return $expires < time();
    }

    public function getValues()
    {
        return $this->jsonSerialize();
    }

    public function __toString()
    {
        return json_encode($this->jsonSerialize());
    }
}
