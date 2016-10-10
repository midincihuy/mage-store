<?php

class Oshop_ExtraFee_Model_Observer
{
    /**
     * Process Sales Rule Model Before Save
     *
     * @param $observer
     * @return $this
     */
    public function beforeSaveSalesRuleModel($observer)
    {
        if (!Mage::helper('oshop_extrafee')->isRuleExtraFeeEnabled()) {
            return $this;
        }

        if (Mage::app()->getRequest()->isPost()) {
            $postData = Mage::app()->getRequest()->getPost();
            if (isset($postData['extra_fee_amount'])) {
                $salesRuleModel = $observer->getEvent()->getDataObject();
                $salesRuleModel->setExtraFeeAmount($postData['extra_fee_amount']);
            }
        }
    }

    /**
     * Prepare Form for Sales Rule
     *
     * @param $observer
     * @return $this
     */
    public function prepareFormSalesRuleEdit($observer)
    {
        if (!Mage::helper('oshop_extrafee')->isRuleExtraFeeEnabled()) {
            return $this;
        }

        $model = Mage::registry('current_promo_quote_rule');
        if (!$model) {
            return $this;
        }
        /** @var Varien_Data_Form $form */
        $form = $observer->getEvent()->getForm();
        $fieldset = $form->getElement('action_fieldset');
        $fieldset->addField('extra_fee_amount', 'text', array(
            'name' => 'extra_fee_amount',
            'class' => 'validate-not-negative-number',
            'label' => Mage::helper('salesrule')->__('Extra Fee Amount'),
        ), 'discount_amount');
        $model->setExtraFeeAmount($model->getExtraFeeAmount()*1);

        // Edit Form 
        $actionsSelect = $observer->getForm()->getElement('simple_action');
        if ($actionsSelect){
            $actionsSelect->setValues(array_merge(
                $actionsSelect->getValues(), 
                Mage::helper('oshop_extrafee')->getDiscountTypes()
            ));
            
            // yang ini gak usah dulu deh
            // $actionsSelect->setOnchange('ampromo_hide()'); //ampromo is correct name
        }

        $allow = array(
            'percent_fee',
            'fix_fee',
            'random_fee'
                );
        Mage::app()->getLayout()->getBlock('promo_quote_edit_tab_actions')
            ->setChild('form_after', Mage::app()->getLayout()->createBlock('adminhtml/widget_form_element_dependence')
            ->addFieldMap('rule_extra_fee_amount', 'extra_fee_amount')
            ->addFieldMap('rule_simple_action', 'simple_action')
            ->addFieldDependence('extra_fee_amount', 'simple_action', $allow)
        );


    }

    /**
     * PayPal prepare request
     *
     * @param $observer
     */
    public function paypalPrepareLineItems($observer)
    {

        /* @var $cart Mage_Paypal_Model_Cart */
        $cart = $observer->getEvent()->getPaypalCart();
        $address = $cart->getSalesEntity()->getIsVirtual() ?
            $cart->getSalesEntity()->getBillingAddress() : $cart->getSalesEntity()->getShippingAddress();
        $feeAmount = $address->getExtraFeeRuleAmount();
        $cart->updateTotal(Mage_Paypal_Model_Cart::TOTAL_TAX, $feeAmount);
    }
}