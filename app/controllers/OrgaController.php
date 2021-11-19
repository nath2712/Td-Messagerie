<?php
namespace controllers;

use Ajax\php\ubiquity\JsUtils;
use models\Organization;
use models\Organizationsettings;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\attributes\items\router\Route;
use Ubiquity\controllers\Router;
use Ubiquity\core\postinstall\Display;
use Ubiquity\log\Logger;
use Ubiquity\orm\DAO;
use Ubiquity\orm\repositories\ViewRepository;
use Ubiquity\themes\ThemesManager;
use Ubiquity\utils\http\URequest;

/**
 * Controller OrgaController
 * @property JsUtils $jquery
 */



class OrgaController extends \controllers\ControllerBase{
    private ViewRepository $repo;

    public function initialize() {
        parent::initialize();
        $this->repo??=new ViewRepository($this,Organization::class);
    }

    #[Route('/orgas', name:"orga.index")]
    public function index (){
        $this->repo->all();
        $this->loadView("orgas/index.html");

    }

    #[Get(path:"orgas/update/{id}",name:'orga.update')]
    public function updateForm ($id){
            $orga=$this->repo->byId($id,false);
            $df=$this->jquery->semantic()->dataForm('frm',$orga);
            $df->setActionTarget(Router::path('orgas.submit'),'');
            $df->setProperty('method','post');
            $df->setFields(['id','name','submit']);
            $df->fieldAsHidden('id');
            $df->fieldAsSubmit('submit','green fluid');
            $this->jquery->renderView('orgas/update.html');


            $this->loadView('orgas/update.html',compact('orga'));


    }

    #[Post('orgas/update',name:'orgas.submit')]
    public function update(){
            $orga=$this->repo->ById(Organization::class,URequest::post('id'));
            if($orga){
                URequest::setValuesToObject($orga);
                $this->repo->save($orga);

            }
            $this->index();
    }
    #[Get(path:"orgas/{id}",name:"orga.getOne")]

        public function getOne($id)
    {

        $this->loadView('OrgaController/getOne.html');

    }

}