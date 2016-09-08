<?php
$installer = $this;
$installer->startSetup();

$attribute  = array(
    'type'              => 'varchar',
    'input'             => 'text',
    'label'             => 'Coba Pake validate-mobile',
    'class'             => 'validate-mobile',
    'global'             => 1,
    'visible'           => 1,
    'required'          => 1,
    'user_defined'      => 1,
    'visible_on_front' => 1
);
$installer->addAttribute('customer_address', 'coba_validate', $attribute);


$used_in_forms[]="customer_register_address";
$used_in_forms[]="customer_address_edit";
$used_in_forms[]="adminhtml_customer_address";

Mage::getSingleton('eav/config')->getAttribute('customer_address', 'coba_validate')
    ->setData('used_in_forms', $used_in_forms)
    ->save();


$tablequote = $this->getTable('sales/quote_address');
$installer->run("
ALTER TABLE  $tablequote ADD  `coba_validate` varchar(255) NOT NULL;
");
 
$tablequote = $this->getTable('sales/order_address');
$installer->run("
ALTER TABLE  $tablequote ADD  `coba_validate` varchar(255) NOT NULL;
");


$installer->endSetup();
?>

