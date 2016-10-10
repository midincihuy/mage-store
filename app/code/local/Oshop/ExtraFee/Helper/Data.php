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
}