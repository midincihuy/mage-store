<?php

class Oshop_ExtraFee_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_EXTRA_FEE_RULE_ACTIVE              = 'extra_fee_settings/extra_fee_rule/active';
    const XML_PATH_EXTRA_FEE_RULE_LABEL               = 'extra_fee_settings/extra_fee_rule/label';

    /**
     * Check If Rule Extra Fee Enabled
     *
     * @return bool
     */
    public function isRuleExtraFeeEnabled()
    {
        $result = (bool) Mage::getStoreConfig(self::XML_PATH_EXTRA_FEE_RULE_ACTIVE);
        return $result;
    }

    /**
     * Get Extra Fee for Shopping Cart Rule
     *
     * @return string
     */
    public function getExtraFeeRuleLabel()
    {
        return (string) Mage::getStoreConfig(self::XML_PATH_EXTRA_FEE_RULE_LABEL);
    }


    const PERCENT_FEE   = 'percent_fee';
    const FIX_FEE       = 'fix_fee';
    const RANDOM_FEE    = 'random_fee';
        
    public function getDiscountTypes($asOptions=false)
    {
        $types = array(
            self::PERCENT_FEE   => $this->__('Percent Extra Fee'),
            self::FIX_FEE   => $this->__('Fix Extra Fee'),
            self::RANDOM_FEE   => $this->__('Random Extra Fee'),
        );
        
        if (!$asOptions){
            $values = array();
            foreach ($types as $k=>$v){
                $values[] = array(
                    'value' => $k, 
                    'label' => $v                
                );
            }
            $types = $values;
        }

        return $types;
    }
}