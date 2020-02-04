<?php
namespace Ziffity\Feedback\Helper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        \Magento\Framework\App\Request\Http $request
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
        $this->request = $request;
    }
    public function sendEmail($customerMail, $message)
    {
        try {
            //$email = $this->getRequest()->getParam('email');
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Ziffity Solutions'),
                'email' => $this->escaper->escapeHtml('illayaraja.palraj@gmail.com'),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('email_demo_template')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'templateVar'  => $message,
                ])
                ->setFrom($sender)
                ->addTo($customerMail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }

}
