<?php
 
$tickets = Mage::getModel('inchoo_dbscript/ticket')
                ->getCollection();
 
foreach ($tickets as $ticket) {
    $ticket->setCreatedAt(strftime('%Y-%m-%d %H:%M:%S', time()))
           ->save();
}