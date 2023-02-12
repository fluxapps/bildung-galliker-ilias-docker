<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth;

use League\OAuth2\Client\Token\AccessTokenInterface;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
interface AuthTokenRepository
{
    public function storeToken(AccessTokenInterface $authTokenDTO);
    /**
     * @return AuthTokenDTO|null
     */
    public function getToken() /*: ?AuthTokenDTO*/;
}
