<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public $layout = '//layouts/column2';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionQuienesSomos() {
        $this->render('quienes_somos');
    }

    public function actionNuestrosTeatros() {

        $teatros = Escenario::model()->findAll();


        $this->render('teatros'
                , array('teatros' => $teatros)
        );
    }

    public function actionNuestrosElencos() {

        $elencos = Elenco::model()->findAll();
//        var_dump($elencos);
//        die();

        $this->render('elencos'
                , array('elencos' => $elencos)
        );
    }

    public function actionProduccionesPropias() {

        $producciones = Produccion::model()->findAll();


        $this->render('producciones'
                , array('producciones' => $producciones)
        );
    }

    public function actionProduccion($id) {

        $produccion = Produccion::model()->findByPk($id);

        $header = ProduccionMultimedia::model()->findByAttributes(array("tipo" => 'IMAGEN', 'produccion_id' => $id, 'menu' => 1));
        if (!$header) {
            $header = ProduccionMultimedia::model()->findByAttributes(array("tipo" => 'IMAGEN', 'produccion_id' => $id));
        }


        $this->render('view_produccion'
                , array('produccion' => $produccion, 'header' => $header)
        );
    }

    public function actionElenco($id) {

        $elenco = Elenco::model()->findByPk($id);

        $header = ElencoMultimedia::model()->findByAttributes(array("tipo" => 'IMAGEN', 'elenco_id' => $id, 'menu' => 1));
        if (!$header) {
            $header = ElencoMultimedia::model()->findByAttributes(array("tipo" => 'IMAGEN', 'elenco_id' => $id));
        }


        $this->render('view_elenco'
                , array('elenco' => $elenco, 'header' => $header)
        );
    }

    public function actionTeatro($id) {

        $teatro = Escenario::model()->findByPk($id);

        $header = EscenarioMultimedia::model()->findByAttributes(array("tipo" => 'LOGO', 'escenario_id' => $id));
        if (!$header) {
            $header = EscenarioMultimedia::model()->findByAttributes(array("tipo" => 'IMAGEN', 'escenario_id' => $id));
        }


        $this->render('view_teatros'
                , array('teatro' => $teatro, 'header' => $header)
        );
    }

    public function actionGaleria() {

//        $elencos = Elenco::model()->findAll();


        $this->render('_galeria'
//                , array('elencos' => $elencos)
        );
    }
    public function actionSlider() {

//        $elencos = Elenco::model()->findAll();


        $this->render('demo_slider'
//                , array('elencos' => $elencos)
        );
    }

}
