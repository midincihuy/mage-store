<?php

/* @var Mage_Sales_Model_Resource_Setup $installer */
$installer = $this;
$tables = array(
    $installer->getTable('sales/quote_address'),
    $installer->getTable('sales/order'),
    $installer->getTable('sales/invoice'),
);

foreach ($tables as $table) {
    $installer->getConnection()->dropColumn($table, 'base_extra_fee_payment_amount');
    $installer->getConnection()->dropColumn($table, 'extra_fee_payment_amount');
}

