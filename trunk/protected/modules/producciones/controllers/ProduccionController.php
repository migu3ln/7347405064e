<?php

class ProduccionController extends AweController {

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
        $model = new Produccion;

        if ($id) {
            $model->id = $id;
        }
        $model->estado = Produccion::ESTADO_ACTIVO;
        $result = array();
        $modelpMultimedia = new ProduccionMultimedia('search');
        $archivo = new XUploadForm;
        $this->ajaxValidation($model);

        if (isset($_POST['Produccion'])) {
            $model->attributes = $_POST['Produccion'];
            $result['success'] = $model->save();

            if ($result['success']) {
                $result['attr'] = $model->attributes;
                if ($_POST['Produccion']['logo'] != null) {
                    $modelpMultimedia->local = 0;
                    $modelpMultimedia->tipo = Constants::MULTIMEDIA_TIPO_LOGO;
                    $modelpMultimedia->menu = 0;
                    $modelpMultimedia->encabezado = 0;
                    $modelpMultimedia->produccion_id = $model->id;
                    $src = $_POST['Produccion']['logo'];
//                    var_dump($_POST);
//                    die();
//                    die(var_dump($modelpMultimedia->attributes,$modelpMultimedia->validate(),$modelpMultimedia->errors));
                    if (!file_exists("uploads/produccion/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO)) {
                        mkdir("uploads/produccion/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO, 0777, true);
                    }
                    $path = realpath(Yii::app()->getBasePath() . "/../uploads/produccion/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO) . "/";
                    $pathorigen = realpath(Yii::app()->getBasePath() . "/../uploads/tmp/") . "/";
                    $publicPath = Yii::app()->getBaseUrl() . "/uploads/produccion/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO . '/';
                    if (rename($pathorigen . $src, $path . $src)) {
                        $modelpMultimedia->ubicacion = $publicPath . $src;
//                        die(var_dump($modelpMultimedia->attributes, $modelpMultimedia->validate(), $modelpMultimedia->errors));

                        $modelpMultimedia->save();
                    }
                }
            }
            echo CJSON::encode($result);
        } else {

            $this->render('create', array(
                'model' => $model,
                'modelpMultimedia' => $model,
                'archivo' => $archivo,
            ));
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'produccion-form');

        if (isset($_POST['Produccion'])) {
            $model->attributes = $_POST['Produccion'];
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
        $model = new Produccion('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Produccion']))
            $model->attributes = $_GET['Produccion'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__) {
        $model = Produccion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'produccion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * funcion para validaciones en jquery.ajaxValidate.js
     * @param type $model
     */
    protected function ajaxValidation($model, $form_id = "produccion-form") {
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
