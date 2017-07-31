<?php
namespace Exponea\ExponeaFree\Block;

class ExponeaFree extends \Magento\Framework\View\Element\Template {

    protected $_helper;
	/**
	 * @var \Magento\Checkout\Model\Session
	 */
	protected $_checkoutSession;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Exponea\ExponeaFree\Helper\Data $helper,
        \Magento\Checkout\Model\Session $checkoutSession,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->_helper = $helper;
        $this->_checkoutSession = $checkoutSession;
    }

    public function getPublicToken() {
        return $this->_helper->getPublicToken();
    }

    public function getOrder() {
		return $this->_checkoutSession->getLastRealOrder();
	}

    public function getOrderItems() {
        $result = [];
        foreach ($this->getOrder()->getAllItems() as $orderedItem) {
            $result[] = array(
                'product_id' => $orderedItem->getProductId(),
                'price' => doubleval($orderedItem->getPriceInclTax()),
                'quantity' => doubleval($orderedItem->getQtyOrdered())
            );
        }
        return $result;
    }

    protected function _toHtml() {
        if ($this->_helper->getEnable() && $this->_helper->getPublicToken()) {
            return parent::_toHtml();
        }
        return '';
    }

}

