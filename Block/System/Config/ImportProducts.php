<?php
namespace Exponea\ExponeaFree\Block\System\Config;

class ImportProducts extends \Magento\Config\Block\System\Config\Form\Field {

    /**
     * @var string
     */
    protected $_template = 'Exponea_ExponeaFree::system/config/import-products.phtml';

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Remove scope label
     *
     * @param  AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element) {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);        
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element) {
        return $this->_toHtml();
    }

    public function getAjaxUrl() {
        return $this->getUrl('exponea_exponeafree/system_config/importproducts');
    }

    public function getButtonHtml() {
        $button = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')->setData([
            'id' => 'import_products',
            'label' => __('Import products'),
        ]);

        return $button->toHtml();
    }
}

