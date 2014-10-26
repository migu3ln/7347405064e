<?php

class ElencoController extends AweController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $admin = false;
    public $defaultAction = 'admin';

    public function filters() {
        return array(
            array('CrugeAccessControlFilter'),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id = null) {
        $model = new Elenco;
        if ($id) {
            $model->id = $id;
        }
        $model->estado = Elenco::ESTADO_ACTIVO;
        $result = array();
        $modeloMultimedia = new ElencoMultimedia('search');
//        $archivo = new XUploadForm;
        $this->ajaxValidation($model);

        if (isset($_POST['Elenco'])) {
            $model->attributes = $_POST['Elenco'];
//            var_dump($model->attributes);
//            var_dump($_POST['Elenco']['logo']);
//            die("entro");
            $result['success'] = $model->save();

            if ($result['success']) {
                $result['attr'] = $model->attributes;
                if ($_POST['Elenco']['url_archivo'] != null) {
                    $name_archivo_temporal = $_POST['Elenco']['url_archivo'];
                    $modeloMultimedia->local = 0;
                    $modeloMultimedia->tipo = Constants::MULTIMEDIA_TIPO_LOGO;
                    $modeloMultimedia->menu = 0;
                    $modeloMultimedia->encabezado = 0;
                    $modeloMultimedia->elenco_id = $model->id;
                    if (!file_exists("uploads/elenco/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO)) {
                        mkdir("uploads/elenco/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO, 0777, true);
                    }
                    $path = realpath(Yii::app()->getBasePath() . "/../uploads/elenco/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO) . "/";
                    $pathorigen = realpath(Yii::app()->getBasePath() . "/../uploads/tmp/") . "/";
                    $publicPath = Yii::app()->getBaseUrl() . "/uploads/elenco/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO . '/';
                    if (rename($pathorigen . $name_archivo_temporal, $path . $name_archivo_temporal)) {
                        $modeloMultimedia->ubicacion = $publicPath . $name_archivo_temporal;
//                        die(var_dump($modelpMultimedia->attributes, $modelpMultimedia->validate(), $modelpMultimedia->errors));
                        $modeloMultimedia->save();
                    }
                }
            }
            echo CJSON::encode($result);
        } else {
            $this->render('create', array('model' => $model, 'modeloMultimedia' => $modeloMultimedia));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);


        if (isset($_POST['Elenco'])) {
            die(var_dump("s"));
            $model->attributes = $_POST['Elenco'];
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Elenco('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Elenco']))
            $model->attributes = $_GET['Elenco'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public
            function loadModel($id, $modelClass = __CLASS__) {
        $model = Elenco::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected
            function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'elenco-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Validacion por ajax
     * @author Alex Yepez <alex.yepez@outlook.com>
     * @param $model
     * @param string $form_id
     */
    protected
            function ajaxValidation($model, $form_id = "elenco-form") {
        $portAtt = str_replace('-', ' ', (str_replace('-form', '', $form_id)));
        $portAtt = ucwords(strtolower($portAtt));
        $portAtt = str_replace(' ', '', $portAtt);
        if (isset($_POST['ajax']) && $_POST['ajax'] === '#' . $form_id) {
            $model->attributes = $_POST[$portAtt];
            $result['success'] = $model->validate();
            if (!$result['success']) {
                $result['errors'] = $model->errors;
                echo json_encode($result);
                Yii::app()->end();
            }
        }
    }

}
