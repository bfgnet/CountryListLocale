<?php

namespace CountryListLocale\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Response;

class IndexController extends AbstractActionController {

    private $realPath;
    protected $response;

    function __construct() {
        $this->realPath = realpath(__DIR__ . '/../../..');
        $this->response = new Response();
    }

    public function indexAction() {
        $params = $this->params()->fromRoute();
        return $this->forward()->dispatch('CountryListLocale\Controller\Index', array('action' => 'array','locale' => $params['locale']));
    }

    public function xmlAction() {
        $params = $this->params()->fromRoute();
        $content = file_get_contents($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . strtolower($params['locale']) . DIRECTORY_SEPARATOR . 'country.xml');
        if(!$content){
            return $this->response->setContent(false);
        }
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'text/xml; charset=utf-8');
        $this->response->setContent($content);
        return $this->response;
    }

    public function jsonAction() {
        $params = $this->params()->fromRoute();
        $content = file_get_contents($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . strtolower($params['locale']) . DIRECTORY_SEPARATOR . 'country.json');
        if(!$content){
            return $this->response->setContent(false);
        }
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
        $this->response->setContent($content);
        return $this->response;
    }

    public function htmlAction() {
        $params = $this->params()->fromRoute();
        $content = file_get_contents($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . strtolower($params['locale']) . DIRECTORY_SEPARATOR . 'country.html');
        if(!$content){
            return $this->response->setContent(false);
        }
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'text/html');
        $this->response->setContent($content);
        return $this->response;
    }

    public function arrayAction() {
        $params = $this->params()->fromRoute();
        $file = $this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . strtolower($params['locale']) . DIRECTORY_SEPARATOR . 'country.php';
        if(!file_exists($file)){
            return $this->response->setContent(false);
        }
        $content = include($file);
        $this->response->setContent($content);
        return $this->response;
    }

    public function csvAction() {
        $params = $this->params()->fromRoute();
        $content = file_get_contents($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . strtolower($params['locale']) . DIRECTORY_SEPARATOR . 'country.csv');
        if(!$content){
            return $this->response->setContent(false);
        }
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine('Content-Disposition', sprintf("attachment; filename=\"%s\"", 'countries.csv'))
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($content));
        $this->response->setContent($content);
        return $this->response;
    }

    public function txtAction() {
        $params = $this->params()->fromRoute();
        $content = file_get_contents($this->realPath . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . strtolower($params['locale']) . DIRECTORY_SEPARATOR . 'country.csv');
        if(!$content){
            return $this->response->setContent(false);
        }
        $this->response->getHeaders()->addHeaderLine('Content-Type', 'text')
                ->addHeaderLine('Content-Disposition', sprintf("attachment; filename=\"%s\"", 'countries.txt'))
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($content));
        $this->response->setContent($content);
        return $this->response;
    }

}
