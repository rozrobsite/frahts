
<?php
   /*
    * Create Controller for table body_types
    *
    */
    class CurrencyController extends AdminController{

        public function __construct($id , $module = null){
            parent::__construct($id,$module);

        }

        public  function actionIndex(){
            $this->redirect('/admin/Currency/Currency');
        }

        public  function actionCurrency(){
            echo $_REQUEST['Currency'];
            $Currency = new Currency();
            if(isset($_REQUEST['Currency']['name_ru'])){
                $Currency->name_ru = $_REQUEST['Currency']['name_ru'];
            }
            $this->render('Currency',array(
                'Currency' => $Currency,
            ));
        }
        public function actionAdd(){
            echo var_dump($_POST);
            echo var_dump($_REQUEST);
//            echo var_dump($_POST['Currency']['id']);
//            echo var_dump($_POST['Currency']['name_ru']);
//            echo var_dump($_POST['Currency']['vehicle_type_id']);
//            echo var_dump($_POST['Currency']['name_ua]']);
//            echo var_dump($_POST['Currency']['order_by']);
            if(isset($_POST['Currency'])){
                if(!empty($_POST['Currency']['name_ru'])){
                    $BodyType = new Currency();

                    $BodyType->name_ru = $_POST['Currency']['name_ru'];

                    // Currency::model()->insert($_POST['Currency']['name_ru']);
                    $BodyType->insert();
                    unset($BodyType);
                }
            }

            $Currency = new Currency();
            if(isset($_REQUEST['Currency']['name_ru'])){

                $Currency->name_ru = $_REQUEST['Currency']['name_ru'];

            }
            $this->render('Currency',array(
                'Currency' => $Currency,
            ));

//            $this->redirect('/admin/Currency');
        }
        public  function actionEditCurrency(){
            echo $_POST['name_ru'];
            echo $_POST['pk'];
            echo $_POST['value'];
            if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
            {
                Currency::model()->updateByPk((int) $_POST['pk'],
                    array($_POST['name_ru'] => $_POST['value']));
            }
        }
        public  function actionEdit(){
            echo "<pre>";
            echo $_GET['id'];
            echo $_GET['Currency'];
            echo "</pre>";

            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $model = Currency::model()->findByPk($id);
            if (!$model) throw new CHttpException(404, 'Данная новость не найдена.');
            $this->processForm($model);
        }
        public function processForm($model = null)
        {
            //$model = $model == null ? new Currency('search') : $model;
            $model = $model == null ? new Currency() : $model;

            $Currency = Currency::model()->findAll();
            $listBodyTypes = CHtml::listData($Currency, 'id', 'name_ru');

            if (isset($_POST['Currency']))
            {
                $model->attributes = $_POST['Currency'];
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
            $Currency = new Currency();
            if(isset($_GET['Currency']['name_ru'])){

                $Currency->name_ru = $_GET['Currency']['name_ru'];

            }

            $this->render('_CurrencyType',
                array(
                    // 'model' => $model,
                    'Currency' => $Currency,
                ));
        }
        public  function actionDelete(){
            if (isset($_GET['id']))
            {
                if (!empty($_GET['id']))
                {
                    Currency::model()->deleteByPk((int) $_GET['id']);
                }
            }
        }
    }