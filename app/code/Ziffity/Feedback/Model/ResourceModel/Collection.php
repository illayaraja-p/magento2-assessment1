<?php
namespace Ziffity\Feedback\Model\ResourceModel\DataExample;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	public function _construct(){
		$this->_init("Ziffity\Feedback\Model\DataExample","Ziffity\Feedback\Model\ResourceModel\DataExample");
	}
}
 ?>
