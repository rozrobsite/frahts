
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
        $paymentType = new PaymentType();
		
        if(isset($_REQUEST['PaymentType']['name_ru'])){
            $paymentType->name_ru = $_REQUEST['PaymentType']['name_ru'];
        }
		
        $this->render('PaymentType',array(
            'PaymentType' => $paymentType,
        ));
    }
    public function actionAdd(){
        if(isset($_POST['PaymentType'])){
            if(!empty($_POST['PaymentType']['name_ru'])){
                $paymentType = new PaymentType();

                $paymentType->name_ru = $_POST['PaymentType']['name_ru'];

                // PaymentType::model()->insert($_POST['PaymentType']['name_ru']);
                $paymentType->insert();
                unset($paymentType);
            }
        }

        $paymentType = new PaymentType();
        if(isset($_REQUEST['PaymentType']['name_ru'])){

            $paymentType->name_ru = $_REQUEST['PaymentType']['name_ru'];

        }
        $this->render('PaymentType',array(
            'PaymentType' => $paymentType,
        ));
    }
    public  function actionEditPaymentType(){
        if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
        {
            PaymentType::model()->updateByPk((int) $_POST['pk'],
                array($_POST['name_ru'] => $_POST['value']));
        }
    }
    public  function actionEdit(){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
		
        $model = PaymentType::model()->findByPk($id);
        
		if (!$model) throw new CHttpException(404, 'Данная новость не найдена.');
        
		$this->processForm($model);
    }
    public function processForm($model = null)
    {
        //$model = $model == null ? new PaymentType('search') : $model;
        $model = $model == null ? new PaymentType() : $model;

        $paymentType = PaymentType::model()->findAll();
        $listBodyTypes = CHtml::listData($paymentType, 'id', 'name_ru');

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
        $paymentType = new PaymentType();
        if(isset($_GET['PaymentType']['name_ru'])){

            $paymentType->name_ru = $_GET['PaymentType']['name_ru'];

        }

        $this->render('_PaymentType',
            array(
                // 'model' => $model,
                'PaymentType' => $paymentType,
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