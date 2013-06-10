<?php
   /*
    * Create Controller for table body_types
    *
    */
    class BodyTypesController extends AdminController{

        public function __construct($id , $module = null){
            parent::__construct($id,$module);
        }
        public  function actionIndex(){
            $this->redirect('/admin/BodyTypes/BodyTypes');
        }

        public  function actionBodyTypes(){
            echo $_REQUEST['BodyTypes'];
            $BodyTypes = new BodyTypes();
            if(isset($_REQUEST['BodyTypes']['name_ru'])){
                $BodyTypes->name_ru = $_REQUEST['BodyTypes']['name_ru'];
            }
            $this->render('BodyTypes',array(
                'BodyType' => $BodyTypes,
            ));
        }
        public function actionAdd(){
            if(isset($_POST['BodyTypes'])){
                if(!empty($_POST['BodyTypes']['name_ru'])){
                    $BodyType = new BodyTypes();
                    $BodyType->name_ru = $_POST['BodyTypes']['name_ru'];
                    $BodyType->insert();
                    unset($BodyType);
                }
            }

            $BodyTypes = new BodyTypes();
            if(isset($_REQUEST['BodyTypes']['name_ru'])){
                $BodyTypes->name_ru = $_REQUEST['BodyTypes']['name_ru'];
            }
            $this->render('BodyTypes',array(
                'BodyType' => $BodyTypes,
            ));
        }
        public  function actionEditBodyTypes(){
            if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
            {
//              // BodyTypes::
//                BodyTypes::model()->updateByPk((int) $_POST['pk'],
//                    array($_POST['name_ru'] => $_POST['value']));
                if(!empty($_POST['name_ru'])){
                    $BodyType = new BodyTypes();
                    $BodyType->name_ru = $_POST['BodyTypes']['name_ru'];
                    $BodyType->updateByPk((int) $_POST['pk'], array($_POST['name_ru'] => $_POST['value']));
                    unset($BodyType);
                }
            }
        }
        public  function actionDelete(){
            if (isset($_GET['id']))
            {
                if (!empty($_GET['id']))
                {
                    BodyTypes::model()->deleteByPk((int) $_GET['id']);
                }
            }
        }
    }