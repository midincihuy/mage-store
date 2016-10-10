<?php

/* @var Mage_Sales_Model_Resource_Setup $installer */
$installer = $this;
$installer->getConnection()->addColumn($installer->getTable('salesrule/rule'), 'extra_fee_amount', array(
    'type'     => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'comment'  => 'Extra Fee Amount',
    'scale'     => 4,
    'precision' => 12,
    'nullable'  => false,
    'default'   => '0.0000',
));

