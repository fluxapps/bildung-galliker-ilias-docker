<?php
$_GET['client_id'] = "default";
chdir('../../../');
include_once "Services/Context/classes/class.ilContext.php";
ilContext::init(ilContext::CONTEXT_SOAP_NO_AUTH);
require_once("Services/Init/classes/class.ilInitialisation.php");
ilInitialisation::initILIAS();

require 'Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/Certificate/classes/DigitalSignature/class.srCertificateDigitalSignature.php';
$decrypted = srCertificateDigitalSignature::decryptSignature(strtr($_GET['signature'], '-_,', '+/='));
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <link rel="stylesheet" href="../skin/skin_galliker_ilias_7/custom/galliker.css">
    <link rel="stylesheet" href="../skin/skin_galliker_ilias_7/custom/skin_galliker_ilias_7.css">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Galliker Transport & Logistics</title>
</head>
<body class="std"  >
<div id="drag_zmove"></div>
<div id="ilAll">
    <div id="ilTopBar" class="ilTopBar ilTopBar_startup">
        <a></a>
        <div class="container">
        </div>
    </div>
    <!--<div class="ilMainHeader">-->
    <!--<header class="container">-->
    <!--<div id="il_startup_logo" class="row">-->
    <!--<img class="hidden-xs noMirror" src="{HEADER_ICON}" alt="Logo" />-->
    <!--<img class="visible-xs-inline-block noMirror" src="{HEADER_ICON_RESPONSIVE}" alt="Logo" />-->
    <!--</div>-->
    <!--</header>-->
    <!--</div>-->
    <!--<div class="ilMainMenu">-->
    <!--<div class="container">-->
    <!--<div class="row">-->
    <!--<nav id="ilTopNav" class="navbar navbar-default" role="navigation"></nav>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <div id="mainspacekeeper" class="container galliker_startup_mainspacekeeper">
        <div class="row" style="position: relative;">
            <div id="fixed_content" class=" ilContentFixed">
                <div id="mainscrolldiv" class="ilStartupFrame container">
                    <?php if($decrypted) { ?>
                        <div style="color:white;">
                            <h2>CHECK CERTIFICATE SIGNATURE</h2>
                            <h5 class="ilAccHeadingHidden"><a id="il_message_focus" name="il_message_focus">Informationsmeldung</a></h5>
                            <p>The decryption was successful.<br/><?php echo $decrypted; ?></p>
                        </div>
                    <?php } else { ?>
                        <div style="color:white;">
                            <h2>CHECK CERTIFICATE SIGNATURE</h2>
                            <h5 class="ilAccHeadingHidden">
                                <a id="il_message_focus" name="il_message_focus">Fehlermeldung</a>
                            </h5>
                            <p>The signature value could not be decrypted.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div id="minheight"></div>
    <footer id="ilFooter" class="ilFooter hidden-print" style="display:none">
        <div class="container">
            <div class="row"><div class="ilFooterContainer">{PRMLINK} {FOOTER}</div></div>
        </div>
    </footer>
</div>
</body>
</html>
