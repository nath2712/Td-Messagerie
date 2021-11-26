<?php
namespace controllers;
 use Ubiquity\attributes\items\router\Get;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\utils\http\URequest;

 /**
  * Controller Main
  */
class MainController extends \controllers\ControllerBase{
    #[Route('_default',name:'crud.home')]
	public function index()
    {
        $this->loadView('@activeTheme/IndexCrudController/index.html');

    }
    #[Get(path:'MyAuth/index',name:'crud.auth')]
    public function indexMyAuth()
    {
        $this->loadView('@activeTheme/MyAuth/index.html');

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


   /* public function index() {
        $defaultPage = Display::getDefaultPage();
        $links = Display::getLinks();
        $infos = Display::getPageInfos();

        $activeTheme = ThemesManager::getActiveTheme();
        $themes = Display::getThemes();
        if (\count($themes) > 0) {
            $this->loadView('@activeTheme/main/vMenu.html', \compact('themes', 'activeTheme'));
        }
        $this->loadView($defaultPage, \compact('defaultPage', 'links', 'infos', 'activeTheme'));
    }
*/
}
