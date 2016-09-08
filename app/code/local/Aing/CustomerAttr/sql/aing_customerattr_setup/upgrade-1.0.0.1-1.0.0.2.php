<?php
$installer = $this;
$installer->startSetup();

$attribute  = array(
    'type'              => 'varchar',
    'input'             => 'text',
    'label'             => 'Telephone2',
    'global'             => 1,
    'visible'           => 1,
    'required'          => 1,
    'user_defined'      => 1,
    'visible_on_front' => 1
);
$installer->addAttribute('customer_address', 'telephone2', $attribute);


$used_in_forms[]="customer_register_address";
$used_in_forms[]="customer_address_edit";
$used_in_forms[]="adminhtml_customer_address";

Mage::getSingleton('eav/config')->getAttribute('customer_address', 'telephone2')
    ->setData('used_in_forms', $used_in_forms)
    ->save();


$attribute1  = array(
    'type'              => 'varchar',
    'input'             => 'text',
    'label'             => 'Office Phone',
    'global'             => 1,
    'visible'           => 1,
    'required'          => 0,
    'user_defined'      => 1,
    'visible_on_front' => 1
);
$installer->addAttribute('customer_address', 'office_phone', $attribute1);


Mage::getSingleton('eav/config')->getAttribute('customer_address', 'office_phone')
    ->setData('used_in_forms', $used_in_forms)
    ->save();

$attribute1  = array(
    'type'              => 'varchar',
    'input'             => 'text',
    'label'             => 'Office Ext',
    'global'             => 1,
    'visible'           => 1,
    'required'          => 0,
    'user_defined'      => 1,
    'visible_on_front' => 1
);
$installer->addAttribute('customer_address', 'office_ext', $attribute1);


Mage::getSingleton('eav/config')->getAttribute('customer_address', 'office_ext')
    ->setData('used_in_forms', $used_in_forms)
    ->save();


$tablequote = $this->getTable('sales/quote_address');
$installer->run("
ALTER TABLE  $tablequote ADD  `telephone2` varchar(255) NOT NULL;
ALTER TABLE  $tablequote ADD  `office_phone` varchar(255) NOT NULL;
ALTER TABLE  $tablequote ADD  `office_ext` varchar(255) NOT NULL;
");
 
$tablequote = $this->getTable('sales/order_address');
$installer->run("
ALTER TABLE  $tablequote ADD  `telephone2` varchar(255) NOT NULL;
ALTER TABLE  $tablequote ADD  `office_phone` varchar(255) NOT NULL;
ALTER TABLE  $tablequote ADD  `office_ext` varchar(255) NOT NULL;
");


$installer->endSetup();
?>

