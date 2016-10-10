<?php
class Oshop_CustomRule_Model_Validator extends Mage_SalesRule_Model_Validator{

	public function process(Mage_Sales_Model_Quote_Item_Abstract $item) {
	    Mage::log('Im Inside Process Function');
	    switch ($rule->getSimpleAction()) {
	        case Mage_SalesRule_Model_Rule::FIX_FEE:
	            Mage::log('Helllll..');
	            break;
	    }
	}
}