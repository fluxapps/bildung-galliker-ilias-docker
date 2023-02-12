<?php
use Da\QrCode\QrCode;

/**
 * Class srCertificateCustomHooks
 *
 * @author Theodor Truffer <tt@studer-raimann.ch>
 */
class srCertificateCustomHooks extends srCertificateHooks {

    const MD_ID_COURSE_NR = 2;
    const MD_ID_COURSE_OBJECTIVES = 7;

    /**
     * @param srCertificate $cert
     * @param array $placeholders
     * @return array
     */
    public function processPlaceholders(srCertificate $cert, array $placeholders) {
        return [];
        // define a different (custom) qr link

        $digital_signature = $placeholders['DIGITAL_SIGNATURE'];
        $link_digital_signature = 'https://bildung.galliker.com/Customizing/global/certificate/checkCertificate.php?client_id=' . CLIENT_ID . '&signature=' . strtr($digital_signature, '+/=', '-_,');
        $QrCode = new QrCode($link_digital_signature);
        $QrCode->setSize(80);
        $placeholders['DIGITAL_SIGNATURE_QR_CODE'] = base64_encode($QrCode->writeString());

        // include advanced metadata field "course number"
        /** @var ilAdvancedMDValues[] $metadata */
        $ilAdvancedMDValues = new ilAdvancedMDValues(1, ilObjCourse::_lookupObjectId($cert->getDefinition()->getRefId()));
        $ilAdvancedMDValues->read();
        $ilADTGroup = $ilAdvancedMDValues->getADTGroup();
        $ilADT = $ilADTGroup->getElement(self::MD_ID_COURSE_NR);
        $placeholders['COURSE_NR'] = $ilADT->getText() ? $ilADT->getText() : '';

        // include advanced metadata field "course objectives"
        $ilADTGroup = $ilAdvancedMDValues->getADTGroup();
        $ilADT = $ilADTGroup->getElement(self::MD_ID_COURSE_OBJECTIVES);
        $placeholders['COURSE_OBJECTIVES'] = $this->nl2li($ilADT->getText() ? $ilADT->getText() : '');

        return $placeholders;

    }


	/**
	 * @param $param
	 * @return string
	 */
	protected function nl2li($param) {
		if (strpos($param, "\n") !== false) {
			return '<li>' . str_replace("\n", "</li><li>", $param) . '</li>';
		} else {
			return $param;
		}
	}
}
