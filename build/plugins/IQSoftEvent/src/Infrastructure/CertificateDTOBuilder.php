<?php

namespace fluxlabs\Plugins\IQSoftEvent\Infrastructure;

use srCertificate;
use fluxlabs\Plugins\IQSoftEvent\IQSoftClient\Certificate\CertificateDTO;
use ILIAS\Filesystem\Filesystems;
use ILIAS\Filesystem\Exception\IOException;
use ILIAS\Filesystem\Exception\FileNotFoundException;
use DateTime;
use srCertificateDefinition;
use ilException;
use srCertificatePlaceholder;
use srCertificateException;

/**
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class CertificateDTOBuilder
{
    const PLACEHOLDER_IQSOFT_ID = 'IQSOFT_ID';
    const LANGUAGE = 'de';

    /**
     * @var Filesystems
     */
    private $filesystem;

    /**
     * CertificateDTOBuilder constructor.
     * @param Filesystems $filesystem
     */
    public function __construct(Filesystems $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @throws FileNotFoundException
     * @throws IOException
     */
    private function getByteArrayOfFileFromStorage(string $file_path) : string
    {
        return base64_encode($this->filesystem->storage()->readStream($file_path)->getContents());
    }

    /**
     * @throws IOException
     * @throws ilException
     */
    public function fromSrCertificate(srCertificate $srCertificate) : CertificateDTO
    {
        $iq_soft_id = $this->fetchIQSoftID($srCertificate);

        if ($iq_soft_id == 0) {
            throw new ilException('certificate definition ' . $srCertificate->getDefinitionId()
                . ' has no valid IQSoft ID configured');
        }
        return (new CertificateDTO(
            $iq_soft_id,
            $srCertificate->getUser()->getLogin(),
            $srCertificate->getFilename(),
            $this->getByteArrayOfFileFromStorage(ltrim(substr($srCertificate->getFilePath(), strlen(CLIENT_DATA_DIR)), '/'))
        ))->withDatum(new DateTime($srCertificate->getCreatedAt()));
    }

    /**
     * @throws srCertificateException
     */
    private function fetchIQSoftID(srCertificate $srCertificate) : int
    {
        /** @var srCertificatePlaceholder $placeholder */
        $placeholder = srCertificatePlaceholder::where(
            ['type_id' => $srCertificate->getTypeId(), 'identifier' => self::PLACEHOLDER_IQSOFT_ID]
        )->first();
        if ($placeholder) {
            $placeholder_id = $placeholder->getId();
            $srCertificatePlaceholderValue = $srCertificate->getDefinition()->getPlaceholderValueByPlaceholderId($placeholder_id);
            if ($srCertificatePlaceholderValue && $srCertificatePlaceholderValue->getValue(self::LANGUAGE)) {
                return (int) $srCertificatePlaceholderValue->getValue(self::LANGUAGE);
            }
        }
        return 0;
    }
}
