<?php

class Oshop_ExtraFee_Block_Sales_Order_Totals_Rule extends Mage_Core_Block_Abstract
{
    /**
     * Get Source Model
     *
     * @return mixed
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    /**
     * Add this total to parent
     */
    public function initTotals()
    {
        if ((float) $this->getSource()->getExtraFeeRuleAmount() <= 0) {
            return $this;
        }
        if ($this->getSource()->getExtraFeeRuleDescription()) {
            $discountLabel = $this->__('%s (%s)', Mage::helper('oshop_extrafee')->getExtraFeeRuleLabel(),
                $this->getSource()->getExtraFeeRuleDescription());
        } else {
            $discountLabel = Mage::helper('oshop_extrafee')->getExtraFeeRuleLabel();
        }
        $total = new Varien_Object(array(
            'code'  => 'extra_fee_rule',
            'field' => 'extra_fee_rule_amount',
            'value' => $this->getSource()->getExtraFeeRuleAmount(),
            'label' => $discountLabel
        ));
        $this->getParentBlock()->addTotalBefore($total, 'grand_total');
        return $this;
    }
}