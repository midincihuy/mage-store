<?php

class Practice_CheckoutComments_Model_Observer
{
	public function prepareCheckoutComment($observer)
	{
		$message = $observer->getControllerAction()
				->getRequest()
				->getPost('checkoutcomments');
		Mage::getSingleton('core/session')->setCheckoutComment($message);
	}
	
	public function saveCheckoutComment($observer)
	{
		$order = $observer->getOrder();
		$message = Mage::getSingleton('core/session')->getCheckoutComment(true);
		if(!$order || empty($message)) {
			return;
		}

		$commentModel = Mage::getModel('checkoutcomments/comment');
		$commentModel->setOrderId($order->getId())
			->setComment($message)
			->save();
	}
}
