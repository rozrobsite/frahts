
<?php
/*
 * Create Controller for table body_types
 *
 */
class PaymentTypeController extends AdminController{

    public function __construct($id , $module = null){
        parent::__construct($id,$module);

    }

    public  function actionIndex(){
        $this->redirect('/admin/PaymentType/PaymentType');
    }

    public  function actionPaymentType(){
        echo $_REQUEST['PaymentType'];
        $PaymentType = new PaymentType();
        if(isset($_REQUEST['PaymentType']['name_ru'])){
            $PaymentType->name_ru = $_REQUEST['PaymentType']['name_ru'];
        }
        $this->render('PaymentType',array(
            'PaymentType' => $PaymentType,
        ));
    }
    public function actionAdd(){
        echo var_dump($_POST);
        echo var_dump($_REQUEST);
//            echo var_dump($_POST['PaymentType']['id']);
//            echo var_dump($_POST['PaymentType']['name_ru']);
//            echo var_dump($_POST['PaymentType']['vehicle_type_id']);
//            echo var_dump($_POST['PaymentType']['name_ua]']);
//            echo var_dump($_POST['PaymentType']['order_by']);
        if(isset($_POST['PaymentType'])){
            if(!empty($_POST['PaymentType']['name_ru'])){
                $PaymentType = new PaymentType();

                $PaymentType->name_ru = $_POST['PaymentType']['name_ru'];

                // PaymentType::model()->insert($_POST['PaymentType']['name_ru']);
                $PaymentType->insert();
                unset($PaymentType);
            }
        }

        $PaymentType = new PaymentType();
        if(isset($_REQUEST['PaymentType']['name_ru'])){

            $PaymentType->name_ru = $_REQUEST['PaymentType']['name_ru'];

        }
        $this->render('PaymentType',array(
            'PaymentType' => $PaymentType,
        ));
    }
    public  function actionEditPaymentType(){
        echo $_POST['name_ru'];
        echo $_POST['pk'];
        echo $_POST['value'];
        if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
        {
            PaymentType::model()->updateByPk((int) $_POST['pk'],
                array($_POST['name_ru'] => $_POST['value']));
        }
    }
    public  function actionEdit(){
        echo "<pre>";
        echo $_GET['id'];
        echo $_GET['PaymentType'];
        echo "</pre>";

        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $model = PaymentType::model()->findByPk($id);
        if (!$model) throw new CHttpException(404, 'Данная новость не найдена.');
        $this->processForm($model);
    }
    public function processForm($model = null)
    {
        //$model = $model == null ? new PaymentType('search') : $model;
        $model = $model == null ? new PaymentType() : $model;

        $PaymentType = PaymentType::model()->findAll();
        $listBodyTypes = CHtml::listData($PaymentType, 'id', 'name_ru');

        if (isset($_POST['PaymentType']))
        {
            $model->attributes = $_POST['PaymentType'];
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
        $PaymentType = new PaymentType();
        if(isset($_GET['PaymentType']['name_ru'])){

            $PaymentType->name_ru = $_GET['PaymentType']['name_ru'];

        }

        $this->render('_PaymentType',
            array(
                // 'model' => $model,
                'PaymentType' => $PaymentType,
            ));
    }
    public  function actionDelete(){
        if (isset($_GET['id']))
        {
            if (!empty($_GET['id']))
            {
                PaymentType::model()->deleteByPk((int) $_GET['id']);
            }
        }
    }
}