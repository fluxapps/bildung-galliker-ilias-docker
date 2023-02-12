<?php

namespace fluxlabs\Plugins\IQSoftEvent\Infrastructure;

use fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth\AuthTokenRepository;
use fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth\AuthTokenDTO;
use fluxlabs\Plugins\IQSoftEvent\Config\Repository;
use League\OAuth2\Client\Token\AccessTokenInterface;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class PluginConfigAuthTokenRepository implements AuthTokenRepository
{
    const KEY_TOKEN = 'token';

    /**
     * @var AccessTokenInterface
     */
    private $cached_token;

    public function storeToken(AccessTokenInterface $authTokenDTO)
    {
        Repository::getInstance()->setValue(self::KEY_TOKEN, $authTokenDTO->__toString());
        $this->cached_token = null;
    }

    /**
     * @return AuthTokenDTO|null
     */
    public function getToken() /*: ?AuthTokenDTO*/
    {
        if (is_null($this->cached_token)) {
            $serialized_token = Repository::getInstance()->getValue(self::KEY_TOKEN);
            if (is_string($serialized_token) && !empty($serialized_token)) {
                $this->cached_token = AuthTokenDTO::ofArray(json_decode($serialized_token, true));
            }
        }
        return $this->cached_token;
    }
}
