<?php

class Oshop_ExtraFee_Model_SalesRule_Discount_Validator extends Mage_SalesRule_Model_Validator
{
    /**
     * Check if we can process rule
     *
     * @param Mage_SalesRule_Model_Rule $rule
     * @param Mage_Sales_Model_Quote_Address $address
     *
     * @return bool
     */
    protected function _canProcessRule($rule, $address)
    {
        if (!Mage::helper('oshop_extrafee')->isRuleExtraFeeEnabled()) {
            return parent::_canProcessRule($rule, $address);
        }
        if ($rule->getDiscountAmount() == 0) {
            return false;
        }
        return parent::_canProcessRule($rule, $address);
    }
}