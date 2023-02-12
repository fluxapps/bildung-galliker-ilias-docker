<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class AuthClientConfigDTO
{
    /**
     * @var string
     */
    private $base_url;
    /**
     * @var string
     */
    private $client_id;
    /**
     * @var string
     */
    private $client_secret;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;

    /**
     * AuthClientConfigDTO constructor.
     * @param string $base_url
     * @param string $client_id
     * @param string $client_secret
     * @param string $username
     * @param string $password
     */
    public function __construct(
        string $base_url,
        string $client_id,
        string $client_secret,
        string $username,
        string $password
    ) {
        $this->base_url = $base_url;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getBaseUrl() : string
    {
        return $this->base_url;
    }

    /**
     * @return string
     */
    public function getClientId() : string
    {
        return $this->client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret() : string
    {
        return $this->client_secret;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

}
