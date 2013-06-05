
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
     
        $PaymentType = new PaymentType();
        if(isset($_REQUEST['PaymentType']['name_ru'])){
            $PaymentType->name_ru = $_REQUEST['PaymentType']['name_ru'];
        }
        $this->render('PaymentType',array(
            'PaymentType' => $PaymentType,
        ));
    }
    public function actionAdd(){
        if(isset($_POST['PaymentType'])){
            if(!empty($_POST['PaymentType']['name_ru'])){
                $PaymentType = new PaymentType();
                $PaymentType->name_ru = $_POST['PaymentType']['name_ru'];
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