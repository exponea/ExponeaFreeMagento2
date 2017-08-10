<?php
namespace Exponea\ExponeaFree\Observer; 

use Magento\Framework\Event\ObserverInterface;
use Exponea\ExponeaFree\Models\Tracking;

class ProductSaveAfter implements ObserverInterface {    

    private $_helper, $_tracking = null;

    public function __construct(\Exponea\ExponeaFree\Helper\Data $helper) { 
        $this->_helper = $helper;

        $privateToken = $this->_helper->getPrivateToken();
        if ($this->_helper->getEnable() && $privateToken) {
            $this->_tracking = new Tracking($privateToken);
        }
    }
 
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $product = $observer->getProduct();
        $product->getProductId();

        if ($this->_tracking) {
            $this->_tracking->updateProduct(array(
                'product_id' => (string) $product->getId(),
                'name' => $product->getName(),
                'price' => doubleval($product->getPrice())
            ));

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
        }
    }   
}

