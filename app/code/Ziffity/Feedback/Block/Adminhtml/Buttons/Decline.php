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
class Decline extends Generic implements ButtonProviderInterface
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $authorization;

    const URL_PATH_VIEW = 'ziffity_feedback/Status/Decline';
    const LABEL_BUTTON = 'Decline';
    const STATUS = 'Declined';

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
        return $this->getBtnData($id, self::LABEL_BUTTON, self::URL_PATH_VIEW, self::STATUS);
    }
}
