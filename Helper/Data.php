<?php
namespace Exponea\ExponeaFree\Helper; 

class Data extends \Magento\Framework\App\Helper\AbstractHelper { 

    protected $_scopeConfig; 

    CONST ENABLE = 'exponea_exponeafree/general/enable'; 
    CONST PUBLIC_TOKEN = 'exponea_exponeafree/general/public_token'; 
    CONST PRIVATE_TOKEN = 'exponea_exponeafree/general/private_token'; 

    public function __construct(
        \Magento\Framework\App\Helper\Context $context, 
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) { 
        parent::__construct($context); 
        $this->_scopeConfig = $scopeConfig;
    }
 
    public function getEnable() {
        return $this->_scopeConfig->getValue(self::ENABLE);
    }
 
    public function getPublicToken() {
        return $this->_scopeConfig->getValue(self::PUBLIC_TOKEN);
    }
 
    public function getPrivateToken(){
        return $this->_scopeConfig->getValue(self::PRIVATE_TOKEN);
    }
}

