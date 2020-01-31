<?php
namespace Ziffity\Feedback\Controller\Index;

use Ziffity\Feedback\Model\DataExampleFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Ziffity\Feedback\Helper\Email;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Index extends \Magento\Framework\App\Action\Action{
    protected $_dataExample;
    protected $resultRedirect;
    private $helperEmail;
    protected $request;
    protected $scopeConfig;

    public function __construct(\Magento\Framework\App\Action\Context $context,
        \Ziffity\Feedback\Model\DataExampleFactory  $dataExample,
        \Magento\Framework\Controller\ResultFactory $result,
        Email $helperEmail,
        \Magento\Framework\App\Request\Http $request,
        ScopeConfigInterface $scopeConfig){

        parent::__construct($context);
        $this->_dataExample = $dataExample;
        $this->resultRedirect = $result;
        $this->helperEmail = $helperEmail;
        $this->scopeConfig = $scopeConfig;
        $this->request = $request;

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




        $email = $this->scopeConfig->getValue('trans_email/ident_support/email',ScopeInterface::SCOPE_STORE);
        /*$name  = $this->scopeConfig->getValue('trans_email/ident_support/name',ScopeInterface::SCOPE_STORE);

        echo $email;echo "<br/>";
        echo $name;echo "<br/>";

        $this->_view->loadLayout();
        $this->_view->renderLayout();*/

        $this->helperEmail->sendEmail();

        if($saveData){
            $this->messageManager->addSuccess( __('Feedback received Successfully!') );
        }
		return $resultRedirect;
	}
}
 ?>
