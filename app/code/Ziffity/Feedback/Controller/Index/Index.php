<?php
namespace Ziffity\Feedback\Controller\Index;

use Ziffity\Feedback\Model\DataExampleFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action{
    protected $_dataExample;
    protected $resultRedirect;
    public function __construct(\Magento\Framework\App\Action\Context $context,
        \Ziffity\Feedback\Model\DataExampleFactory  $dataExample,
        \Magento\Framework\Controller\ResultFactory $result){

        parent::__construct($context);
        $this->_dataExample = $dataExample;
        $this->resultRedirect = $result;

    }
	public function execute(){
        $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    		$model = $this->_dataExample->create();

        $postData = $this->getRequest();

        if (!empty($postData)) {
          $firstname = $postData->getPost('firstname');
          $lastname = $postData->getPost('lastname');
          $email = $postData->getPost('email');
          $comment = $postData->getPost('comment');
        }

    		$model->addData([
    			"firstname" => $firstname,
    			"lastname" => $lastname,
          "email" => $email,
          "comment" => $comment,
    			"status" => true,
    			"sort_order" => 1
    			]);
        $saveData = $model->save();
        if($saveData){
            $this->messageManager->addSuccess( __('Feedback received Successfully!') );
        }
		return $resultRedirect;
	}
}
 ?>
