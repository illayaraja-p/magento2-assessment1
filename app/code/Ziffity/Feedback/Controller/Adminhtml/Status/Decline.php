<?php
namespace Ziffity\Feedback\Controller\Adminhtml\Status;


use Ziffity\Feedback\Model\ResourceModel\DataExampleFactory;
use Magento\Framework\Controller\ResultFactory;
use Ziffity\Feedback\Helper\Email;

class Decline extends \Magento\Framework\App\Action\Action
{
    protected $resultRedirect;
    const DECLINE_MSG = 'Ziffity Solutions! Your feedback has been declined by the admin. Please provide valid feedback! Thank you!!!';

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Controller\ResultFactory $result,
        \Ziffity\Feedback\Model\DataExampleFactory $postFactory,
        Email $helperEmail
    ) {
        parent::__construct($context);
        $this->request = $request;
        $this->resultRedirect = $result;
        $this->_postFactory = $postFactory;
        $this->helperEmail = $helperEmail;
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirect->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        $this->messageManager->addSuccess( __('Feedback declined!') );

        //update status
        $id = $this->getRequest()->getParam('id');
        $post = $this->_postFactory->create();

        $postUpdate = $post->load($id);
        $postUpdate->setStatus("Declined");
        $postUpdate->save();
        //update status

        $email = $postUpdate->getEmail();
        $this->helperEmail->sendEmail($email, self::DECLINE_MSG);

      return $resultRedirect;
    }
}
