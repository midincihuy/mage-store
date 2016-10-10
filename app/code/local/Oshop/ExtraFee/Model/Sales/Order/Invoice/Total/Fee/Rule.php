<?php

class Oshop_ExtraFee_Model_Sales_Order_Invoice_Total_Fee_Rule extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{
    /**
     * Collect Invoice Totals
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     *
     * @return Mage_Sales_Model_Order_Invoice_Total_Abstract
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        if (!Mage::helper('oshop_extrafee')->isRuleExtraFeeEnabled()) {
            return $this;
        }
        $invoice->setExtraFeeRuleAmount(0);
        $invoice->setBaseExtraFeeRuleAmount(0);
        if ($this->_isAmountInvoiced($invoice)) {
            return $this;
        }

        $extraFeeRuleAmount     = $invoice->getOrder()->getExtraFeeRuleAmount();
        $baseExtraFeeRuleAmount = $invoice->getOrder()->getBaseExtraFeeRuleAmount();
        if ($extraFeeRuleAmount) {
            $invoice->setExtraFeeRuleAmount($extraFeeRuleAmount);
            $invoice->setBaseExtraFeeRuleAmount($baseExtraFeeRuleAmount);
            $invoice->setGrandTotal($invoice->getGrandTotal() + $extraFeeRuleAmount);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseExtraFeeRuleAmount);
        }
        return $this;
    }

    /**
     * Check Amount has been invoiced
     *
     * @param $invoice
     *
     * @return bool
     */
    protected function _isAmountInvoiced($invoice)
    {
        foreach ($invoice->getOrder()->getInvoiceCollection() as $previusInvoice) {
            if ($previusInvoice->getExtraFeeRule() && !$previusInvoice->isCanceled()) {
                return true;
            }
        }

        return false;
    }
}
 