<?php

class Practice_CheckoutComments_Model_Resource_Comment extends Mage_Core_Model_Resource_Db_Abstract
{
	protected function _construct()
	{
		$this->_init('checkoutcomments/comments_table', 'comment_id');
	}
}
