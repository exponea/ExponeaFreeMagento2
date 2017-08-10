<?php
namespace Exponea\ExponeaFree\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Exponea\ExponeaFree\Models\Tracking;

class ImportProducts extends Action {

    const MAX_BULK_SIZE = 1000;

    protected $helper;
    protected $resultJsonFactory;

    public function __construct(Context $context, JsonFactory $resultJsonFactory, \Exponea\ExponeaFree\Helper\Data $helper) {
        $this->helper = $helper;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute() {
        $result = $this->resultJsonFactory->create();                 

        $enabled = $this->helper->getEnable();
        if (!$enabled) {
            return $result->setData(['success' => false, 'error' => 'Exponea Free is not enabled.']);
        }
   
        $privateToken = $this->helper->getPrivateToken();
        if (!$privateToken) {
            return $result->setData(['success' => false, 'error' => 'Private token is not configured.']);
        }

        $tracking = new Tracking($privateToken);

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        $collection = $productCollection->create()
            ->addAttributeToSelect('*')
            ->load();
                
        $products = [];
        foreach ($collection as $product) {
            $products[] = [
                'product_id' => (string) $product->getId(),
                'name' => $product->getName(),
                'price' => doubleval($product->getPrice())

                // TODO:
                // 'available' => 0,
                // 'view_url' => '',
                // 'image_url' => '',
                // 'color' => '',
                // 'brand' => '',
                // 'collection' => '',
                // 'date_add' => '',
                // 'date_launch' => '',
                // 'date_stop' => ''
            ];

            if (count($products) == self::MAX_BULK_SIZE) {
                $tracking->updateProducts($products);
                $products = [];
            }
        }  

        if (count($products) > 0) {
            $tracking->updateProducts($products);
        }

        return $result->setData(['success' => true]);
    }    
}

