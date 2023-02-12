<#1>
<?php
\fluxlabs\Plugins\IQSoftEvent\Repository::getInstance()->installTables();
?>
<#2>
<?php
\fluxlabs\Plugins\IQSoftEvent\Infrastructure\ActiveRecord\FailedTransmissionAR::updateDB();
?>
