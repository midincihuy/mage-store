<?php
$installer = $this;
$installer->startSetup();

$installer->updateAttribute('customer_address', 'coba_validate', 'frontend_class', 'validate-mobile');

$installer->endSetup();
?>

