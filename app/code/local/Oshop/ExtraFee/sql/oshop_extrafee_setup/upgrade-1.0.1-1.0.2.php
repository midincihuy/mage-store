<?php

/* @var Mage_Sales_Model_Resource_Setup $installer */
$installer = $this;
$tables = array(
    $installer->getTable('sales/quote_address'),
    $installer->getTable('sales/quote_item'),
    $installer->getTable('sales/order'),
);

foreach ($tables as $table) {
    $installer->getConnection()
        ->addColumn($table,
            'base_extra_fee_rule_amount',
            array(
                'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
                'length' => '12,4',
                'nullable'  => true,
                'comment' => 'Base Rule Extra Fee',
            )
        );
    $installer->getConnection()
        ->addColumn($table,
            'extra_fee_rule_amount',
            array(
                'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
                'length' => '12,4',
                'nullable'  => true,
                'comment' => 'Rule Extra Fee',
            )
        );
}
