<?php
namespace Ziffity\Feedback\Ui\Component\Listing\Grid\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ProductActions extends Column
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /** Url Path */
    const PRODUCT_URL_PATH_VIEW = 'ziffity_feedback/feedback/feedback';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = array(),
        UrlInterface $urlBuilder,
        array $data = array())
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return void
     */
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name] = html_entity_decode('<a href="'.$this->urlBuilder->getUrl(self::PRODUCT_URL_PATH_VIEW, ['id' => $item['id']]).'">View</a>');

                }
            }
        }
        //echo"<pre>";
        //print_r($dataSource);
        //print_r($dataSource['data']['items'][2]['firstname']);
        //exit;
        return $dataSource;
    }
}
