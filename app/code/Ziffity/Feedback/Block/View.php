<?php
namespace Ziffity\Feedback\Block;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_customerSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getCustomerData() {

        if ($this->_customerSession->isLoggedIn()) {
            $firstname = $this->_customerSession->getCustomerData()->getFirstName();
            $lastName = $this->_customerSession->getCustomerData()->getLastName();
            $email = $this->_customerSession->getCustomerData()->getEmail();

            return array($firstname, $lastName, $email);
        }
        return false;
    }
}
