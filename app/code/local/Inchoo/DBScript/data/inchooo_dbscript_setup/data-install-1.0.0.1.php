<?php
 
$tickets = array(
    array(
        'title' => 'Broken cart',
        'description' => 'Unable to add items to cart.',
    ),
    array(
        'title' => 'Login issues',
        'description' => 'Cannot login when using IE.',
    ),
);
 
foreach ($tickets as $ticket) {
    Mage::getModel('inchoo_dbscript/ticket')
        ->setData($ticket)
        ->save();
}