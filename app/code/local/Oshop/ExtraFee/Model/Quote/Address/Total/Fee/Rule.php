<?php

class Oshop_ExtraFee_Model_Quote_Address_Total_Fee_Rule extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    /**
     * Discount calculation object
     *
     * @var Mage_SalesRule_Model_Validator
     */
    protected $_calculator;

    /**
     * Initialize discount collector
     */
    public function __construct()
    {
        $this->_calculator = Mage::getSingleton('oshop_extrafee/salesRule_validator');
    }

    /**
     * @param Mage_Sales_Model_Quote_Address $address
     *
     * @return Mage_Sales_Model_Quote_Address_Total_Abstract
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        if (!Mage::helper('oshop_extrafee')->isRuleExtraFeeEnabled()) {
            return $this;
        }
        parent::collect($address);
        $quote = $address->getQuote();
        $store = Mage::app()->getStore($quote->getStoreId());
        $this->_calculator->reset($address);

        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }

        $this->_calculator->init($store->getWebsiteId(), $quote->getCustomerGroupId(), $quote->getCouponCode());
        $this->_calculator->initTotals($items, $address);

        $items = $this->_calculator->sortItemsByPriority($items);
        foreach ($items as $item) {
            if ($item->getParentItemId()) {
                continue;
            }
            if ($item->getHasChildren() && $item->isChildrenCalculated()) {
                foreach ($item->getChildren() as $child) {
                    $this->_calculator->process($child);
                    $this->_addAmount($child->getExtraFeeRuleAmount());
                    $this->_addBaseAmount($child->getBaseExtraFeeRuleAmount());
                }
            } else {
                $this->_calculator->process($item);
                $this->_addAmount($item->getExtraFeeRuleAmount());
                $this->_addBaseAmount($item->getBaseExtraFeeRuleAmount());
            }
        }

        $this->_calculator->prepareDescription($address);
    }

    /**
     * Fetch Totals
     *
     * @param Mage_Sales_Model_Quote_Address $address
     *
     * @return Oshop_ExtraFee_Model_Quote_Address_Total_Fee_Rule
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        if (!Mage::helper('oshop_extrafee')->isRuleExtraFeeEnabled()) {
            return $this;
        }
        $amount = $address->getExtraFeeRuleAmount();
        if ($address->getExtraFeeRuleDescription()) {
            $discountLabel = Mage::helper('oshop_extrafee')->__('%s (%s)',
                Mage::helper('oshop_extrafee')->getExtraFeeRuleLabel(), $address->getExtraFeeRuleDescription());
        } else {
            $discountLabel = Mage::helper('oshop_extrafee')->getExtraFeeRuleLabel();
        }

        if ($amount > 0) {
            $address->addTotal(array(
                'code'  => $this->getCode(),
                'title' => $discountLabel,
                'value' => $amount
            ));
        }
        return $this;
    }
}
