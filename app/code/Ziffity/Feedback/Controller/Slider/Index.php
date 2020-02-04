<?php
namespace Ziffity\Feedback\Controller\Slider;



class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
     protected $resultPageFactory;
     private $jsonResultFactory;


    protected $resultJsonFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Ziffity\Feedback\Model\ResourceModel\Feedback\CollectionFactory $CollectionFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory

        )
    {

      $this->_collectionFactory = $CollectionFactory;
$this->jsonResultFactory = $jsonResultFactory;
        return parent::__construct($context);
    }

     public function execute()
     {
       $collection = $this->_collectionFactory->create()->addFieldToFilter('status', 'Approved');

         //$firstname = $this->getRequest()->getParam('firstname');


           $data = $collection->getData();
           //$result->setData($data);

           $result = $this->jsonResultFactory->create();
           $result->setData($data);
           
         return $result;
     }
}
