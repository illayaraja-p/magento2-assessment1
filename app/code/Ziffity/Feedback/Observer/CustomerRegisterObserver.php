<?php
namespace Ziffity\Feedback\Observer;
use Magento\Framework\Event\ObserverInterface;
use Ziffity\Feedback\Helper\Email;
class CustomerRegisterObserver implements ObserverInterface
{
    private $helperEmail;

    public function __construct(
        Email $helperEmail
    ) {
        $this->helperEmail = $helperEmail;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        return $this->helperEmail->sendEmail();
    }
}
