<?php

namespace CountryListLocale\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CountryListLocale extends AbstractPlugin {
    
    function __construct() {
        $this->realPath = realpath(__DIR__ . '/../../../..');
    }

    public function getCountryList($locale) {
        $file = $this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . strtolower($locale) . DIRECTORY_SEPARATOR . 'country.php';
        if(!file_exists($file)){
            return false;
        }
        $content = include($file);
        return $content;
    }
    
    public function getRegionList($countryCode){
        $file = $this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'regions' . DIRECTORY_SEPARATOR . strtolower($countryCode) .'.php';
        if(!file_exists($file)){
            return false;
        }
        $content = include($file);
        return $content;
    }
}
