
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
            $Currency = new Currency();
            if(isset($_REQUEST['Currency']['name_ru'])){
                $Currency->name_ru = $_REQUEST['Currency']['name_ru'];
            }
            $this->render('Currency',array(
                'Currency' => $Currency,
            ));
        }
        public function actionAdd(){
            if(isset($_POST['Currency'])){
                if(!empty($_POST['Currency'2]['name_ru'])){
                    $Currency = new Currency();
                    $Currency->name_ru = $_POST['Currency']['name_ru'];
                    $Currency->insert();
                    unset($Currency);
                }
            }

            $Currency = new Currency();
            if(isset($_REQUEST['Currency']['name_ru'])){
                $Currency->name_ru = $_REQUEST['Currency']['name_ru'];
            }
            $this->render('Currency',array(
                'Currency' => $Currency,
            ));
        }
        public  function actionEditCurrency(){
            echo $_POST['Currency']['name_ru'];
            if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
            {
                if(!empty($_POST['name_ru'])){
                    $Currency = new Currency();
                    $Currency->name_ru = $_POST['Currency']['name_ru'];
                    $Currency->updateByPk((int) $_POST['pk'], array($_POST['name_ru'] => $_POST['value']));
                    unset($Currency);
                }


            }
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