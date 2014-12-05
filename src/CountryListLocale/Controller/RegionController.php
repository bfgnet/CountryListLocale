<?php

namespace CountryListLocale\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Response;

class RegionController extends AbstractActionController {

    private $realPath;
    protected $response;

    function __construct() {
        $this->realPath = realpath(__DIR__ . '/../../..');
        $this->response = new Response();
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();
        return $this->forward()->dispatch('CountryListLocale\Controller\Region', array('action' => 'array','countrycode' => $params['countrycode']));
    }

    public function xmlAction() {
        $params = $this->params()->fromRoute();
        $content = file_get_contents($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'regions' . DIRECTORY_SEPARATOR . strtolower($params['countrycode']) .'.xml');
        if(!$content){
            return $this->response->setContent(false);
        }
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'text/xml; charset=utf-8');
        $this->response->setContent($content);
        return $this->response;
    }

    public function jsonAction() {
        $params = $this->params()->fromRoute();
        $content = file_get_contents($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'regions' . DIRECTORY_SEPARATOR . strtolower($params['countrycode']) .'.json');
        if(!$content){
            return $this->response->setContent($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'regions' . DIRECTORY_SEPARATOR . strtolower($params['countrycode']) .'.json');
        }
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $this->response->setContent($content);
        return $this->response;
    }

    public function arrayAction() {
        $params = $this->params()->fromRoute();
        $file = $this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'regions' . DIRECTORY_SEPARATOR . strtolower($params['countrycode']) .'.php';
        if(!file_exists($file)){
            return $this->response->setContent(false);
        }
        $content = include($file);
        $this->response->setContent($content);
        return $this->response;
    }

}
