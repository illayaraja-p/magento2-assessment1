<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ziffity\Feedback\Block\Adminhtml\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

use Ziffity\Feedback\Block\Adminhtml\Buttons\Generic;

/**
 * Class OrderButton
 */
class Approve extends Generic implements ButtonProviderInterface
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $authorization;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->authorization = $context->getAuthorization();
        parent::__construct($context, $registry);
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
      $id = $this->request->getParams('id');

        $data = [];
        //if ($customerId && $this->authorization->isAllowed('Magento_Sales::create')) {
            $data = [
                'label' => __('Approve'),
                'class' => 'save primary',
                //'on_click' => sprintf("location.href = '%s';", $this->getCreateOrderUrl()),
                'on_click' => sprintf("location.href = '%s';", $this->getUrl('ziffity_feedback/Status/Approve', ['id'=>$id['id'],'status'=>'Accepted'])),

                'class' => 'add',
                'sort_order' => 40,
            ];
        //}
        return $data;
    }

    /**
     * Retrieve the Url for creating an order.
     *
     * @return string
     */
    public function getCreateOrderUrl()
    {
        //return $this->getUrl('ziffity_feedback/Status/Approve', ['id'=>$this->request->getParams('id'), 'status'=>'Accepted']);
    }
}
