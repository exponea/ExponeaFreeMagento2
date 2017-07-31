<?php
namespace Exponea\ExponeaFree\Observer; 

use Magento\Framework\Event\ObserverInterface;
use Exponea\ExponeaFree\Models\Tracking;

class ProductImportBunchSaveAfter implements ObserverInterface {    

    private $_helper, $_tracking = null;

    public function __construct(\Exponea\ExponeaFree\Helper\Data $helper) { 
        $this->_helper = $helper;

        $privateToken = $this->_helper->getPrivateToken();
        if ($privateToken) {
            $this->_tracking = new Tracking($privateToken);
        }
    }
 
    public function execute(\Magento\Framework\Event\Observer $observer) {
        if (!$this->_tracking) return;

        $bunch = $observer->getBunch();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $productManager = $objectManager->get('Magento\Catalog\Model\Product');

        $products = array();
        foreach ($bunch as $row) {
            $products[] = array(
                'product_id' => (string) $productManager->getIdBySku($row['sku']),
                'name' => $row['name'],
                'price' => doubleval($row['price'])

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
            );            
        }
        $this->_tracking->updateProducts($products);
    }   
}

