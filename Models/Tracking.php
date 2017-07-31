<?php
namespace Exponea\ExponeaFree\Models; 

class Tracking {    

    const BASE_URL = 'http://free.exponea.com/api';

    private $_privateAccessToken;

    public function __construct($privateAccessToken) {
        $this->_privateAccessToken = $privateAccessToken;
    }

    public function updateProduct($product) {
        $this->_send('/products', $product);
    }   

    public function updateProducts($products) {
        $this->_send('/bulk', array('commands' => array_map(function ($product) {
            return array(
                'name' => 'product',
                'data' => $product
            );
        }, $products)));
    }

    private function _send($url, $json) {
        $data_string = json_encode($json);
            
        $ch = curl_init();                   
        curl_setopt($ch, CURLOPT_URL, self::BASE_URL . '/' . $this->_privateAccessToken . $url);    
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );     

        $result = curl_exec($ch);
        curl_close($ch);        
    }
}

