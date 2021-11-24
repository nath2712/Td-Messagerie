<?php
namespace controllers;
 use Ubiquity\utils\http\URequest;

 /**
  * Controller Main
  */
class MainController extends \controllers\ControllerBase{
    #[Route('_default','/crud/home')]
	public function index()
    {
    }
        public function _displayInfoAsString() {
            return true;
        }

        protected function finalizeAuth() {
            if(!URequest::isAjax()){
                $this->loadView('@activeTheme/main/vFooter.html');
            }
        }

        protected function initializeAuth() {
            if(!URequest::isAjax()){
                $this->loadView('@activeTheme/main/vHeader.html');
            }
        }

        public function _getBodySelector() {
            return '#page-container';
        }

}
