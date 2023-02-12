<?php

namespace fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Certificate;

use ilCurlConnection;
use ilCurlConnectionException;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class DocClient
{
    /**
     * @var string
     */
    private $base_url;

    /**
     * @param string $base_url
     */
    public function __construct(string $base_url)
    {
        $this->base_url = $base_url;
    }

    /**
     * @throws ilCurlConnectionException
     * @throws DocClientException
     */
    public function sendCertificate(CertificateDTO $certificateDTO, string $auth_header)
    {
        $curl = new ilCurlConnection($this->base_url . 'api/dok/Dokumente/' . $certificateDTO->getDocumentID() . '/selbststudium');
        $curl->init();
        $curl->setOpt(CURLOPT_CUSTOMREQUEST, 'POST');
        $jsonSerialize = json_encode($certificateDTO->jsonSerialize());
        $curl->setOpt(CURLOPT_POSTFIELDS, $jsonSerialize);
        $curl->setOpt(CURLOPT_HTTPHEADER, [
            $auth_header,
            'Content-type: application/json'
        ]);
        $response = $curl->exec();
        $status = $curl->getInfo(CURLINFO_HTTP_CODE);
        if ($status > 299) {
            throw new DocClientException($status . ' - failed sending certificate, api response: ' . $response, $status);
        }
    }

}
