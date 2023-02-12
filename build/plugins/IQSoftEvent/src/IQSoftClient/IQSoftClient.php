<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient;

use fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Auth\AuthClient;
use fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Certificate\CertificateDTO;
use fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Certificate\DocClient;
use ilCurlConnectionException;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class IQSoftClient
{
    /**
     * @var AuthClient
     */
    private $authClient;
    /**
     * @var DocClient
     */
    private $docClient;

    public function __construct(AuthClient $authClient, DocClient $docClient)
    {
        $this->authClient = $authClient;
        $this->docClient = $docClient;
    }

    /**
     * @throws ilCurlConnectionException
     * @throws Certificate\DocClientException
     */
    public function sendCertificate(CertificateDTO $certificateDTO)
    {
        $this->docClient->sendCertificate($certificateDTO, $this->authClient->getAuthHeader());
    }
}
