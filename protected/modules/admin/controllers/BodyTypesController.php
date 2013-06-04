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
            echo var_dump($_POST);
            echo var_dump($_REQUEST);
//            echo var_dump($_POST['BodyTypes']['id']);
//            echo var_dump($_POST['BodyTypes']['name_ru']);
//            echo var_dump($_POST['BodyTypes']['vehicle_type_id']);
//            echo var_dump($_POST['BodyTypes']['name_ua]']);
//            echo var_dump($_POST['BodyTypes']['order_by']);
            if(isset($_POST['BodyTypes'])){
                if(!empty($_POST['BodyTypes']['name_ru'])){
                    $BodyType = new BodyTypes();

                    $BodyType->name_ru = $_POST['BodyTypes']['name_ru'];

                   // BodyTypes::model()->insert($_POST['BodyTypes']['name_ru']);
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

//            $this->redirect('/admin/BodyTypes');
        }
        public  function actionEditBodyTypes(){
            echo $_POST['name_ru'];
            echo $_POST['pk'];
            echo $_POST['value'];
            if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
            {
                BodyTypes::model()->updateByPk((int) $_POST['pk'],
                    array($_POST['name_ru'] => $_POST['value']));
            }
        }
        public  function actionEdit(){
            echo "<pre>";
            echo $_GET['id'];
            echo $_GET['BodyTypes'];
            echo "</pre>";

            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $model = BodyTypes::model()->findByPk($id);
            if (!$model) throw new CHttpException(404, 'Данная новость не найдена.');
            $this->processForm($model);
        }
        public function processForm($model = null)
        {
            //$model = $model == null ? new BodyTypes('search') : $model;
            $model = $model == null ? new BodyTypes() : $model;

            $BodyTypes = BodyTypes::model()->findAll();
            $listBodyTypes = CHtml::listData($BodyTypes, 'id', 'name_ru');

            if (isset($_POST['BodyTypes']))
            {
                $model->attributes = $_POST['BodyTypes'];
                if ($model->isNewRecord)
                    $model->created_at = time();

                if ($model->save())
                {
                    Yii::app()->user->setFlash('_success', 'Документ добавлен в базу.');

                    $stringHelper = new StringHelper();
                    $model->slug = $stringHelper->convertToSlug($model->title . ' ' . $model->id);
                    $model->update();
                    unset($stringHelper);

                    $this->redirect('/admin/docs/list/');
                }
                else
                {
                    Yii::app()->user->setFlash('_error',
                        'Ошибки при добавлении документа в базу. Проверьте введенные данные и попробуйте еще раз.');
                }
            }
            $BodyTypes = new BodyTypes();
            if(isset($_GET['BodyTypes']['name_ru'])){

                $BodyTypes->name_ru = $_GET['BodyTypes']['name_ru'];

            }

            $this->render('_BodyType',
                array(
                   // 'model' => $model,
                    'BodyType' => $BodyTypes,
                ));
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