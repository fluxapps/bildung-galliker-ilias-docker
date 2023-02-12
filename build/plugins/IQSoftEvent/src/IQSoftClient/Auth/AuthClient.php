<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth;

use League\OAuth2\Client\OptionProvider\HttpBasicAuthOptionProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class AuthClient
{
    /**
     * @var OAuth2Provider
     */
    private $oAuthProvider;
    /**
     * @var AuthClientConfigDTO
     */
    private $authClientConfig;
    /**
     * @var AuthTokenRepository
     */
    private $authTokenRepository;

    /**
     * AuthClient constructor.
     */
    public function __construct(AuthClientConfigDTO $authClientConfig, AuthTokenRepository $authTokenRepository)
    {

        $this->authClientConfig = $authClientConfig;
        $this->oAuthProvider = new OAuth2Provider([
            'clientId' => $authClientConfig->getClientId(),
            'clientSecret' => $authClientConfig->getClientSecret(),
            'urlAccessToken' => rtrim($authClientConfig->getBaseUrl(), '/') . '/token',
            'urlAuthorize' => '',
            'urlResourceOwnerDetails' => ''
        ], [
            'optionProvider' => new HttpBasicAuthOptionProvider()
        ]);
        $this->authTokenRepository = $authTokenRepository;
    }

    public function isAuthenticated() : bool
    {
        $token = $this->authTokenRepository->getToken();
        return !is_null($token) && !empty($token->getToken()) && !$token->hasExpired();
    }

    /**
     * @throws IdentityProviderException
     */
    public function authenticate()
    {
        $token = $this->oAuthProvider->getAccessToken("password", [
            "username" => $this->authClientConfig->getUsername(),
            "password" => $this->authClientConfig->getPassword()
        ]);
        $this->authTokenRepository->storeToken($token);
    }

    /**
     * @return string
     * @throws IdentityProviderException
     */
    public function getAuthHeader() : string
    {
        if (!$this->isAuthenticated()) {
            $this->authenticate();
        }
        return 'Authorization: Bearer ' . $this->authTokenRepository->getToken()->getToken();
    }
}
