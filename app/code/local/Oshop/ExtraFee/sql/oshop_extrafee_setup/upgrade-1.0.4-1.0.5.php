<?php

/* @var Mage_Sales_Model_Resource_Setup $installer */
$installer = $this;
$tables = array(
    $installer->getTable('sales/invoice'),
);

foreach ($tables as $table) {
    $installer->getConnection()
        ->addColumn($table,
            'extra_fee_rule_description',
            array(
                'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
                'length' => '255',
                'nullable'  => true,
                'comment' => 'Rule Extra Fee Description',
            )
        );
}
