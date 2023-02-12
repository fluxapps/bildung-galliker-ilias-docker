<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth;

use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Grant\AbstractGrant;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class OAuth2Provider extends GenericProvider
{
    protected function createAccessToken(array $response, AbstractGrant $grant)
    {
        return new AuthTokenDTO($response['access_token'], strtotime($response['expiration']));
    }

}
