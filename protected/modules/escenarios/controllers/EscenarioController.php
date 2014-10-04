<?php

class EscenarioController extends AweController {

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
    public function actionCreate() {
        $model = new Escenario;
        $model_taquilla = new EscenarioTaquilla('search');
        $model_taquilla->unsetAttributes();
        if (isset($_GET['EscenarioTaquilla'])) {
            $model_taquilla->attributes = $_GET['EscenarioTaquilla'];
        }
        $result = array();
        $archivo = new XUploadForm;
        $this->ajaxValidation($model);
        if (isset($_POST['Escenario'])) {
            $result['success'] = $model->save();
            if ($result['success']) {
                $result['attr'] = $model->attributes;
                if ($_POST['Escenario']['logo'] != null) {
                    $modelpMultimedia = new EscenarioMultimedia;
                    $modelpMultimedia->local = 1;
                    $modelpMultimedia->tipo = Constants::MULTIMEDIA_TIPO_LOGO;
                    $modelpMultimedia->escenario_id = $model->id;
                    $src = $_POST['Escenario']['logo'];
//                    die(var_dump($modelpMultimedia->attributes,$modelpMultimedia->validate(),$modelpMultimedia->errors));
                    if (!file_exists("uploads/escenario/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO)) {
                        mkdir("uploads/escenario/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO, 0777, true);
                    }
                    $path = realpath(Yii::app()->getBasePath() . "/../uploads/escenario/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO) . "/";
                    $pathorigen = realpath(Yii::app()->getBasePath() . "/../uploads/tmp/") . "/";
                    $publicPath = Yii::app()->getBaseUrl() . "/uploads/escenario/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO . '/';
                    if (rename($pathorigen . $src, $path . $src)) {
                        $modelpMultimedia->ubicacion = $publicPath . $src;
                        $modelpMultimedia->save();
                    }
                }
            }
            echo CJSON::encode($result);
        } else {
            $this->render('create', array(
                'model' => $model, 'archivo' => $archivo, 'model_taquilla' => $model_taquilla
            ));
        }
    }

    /**
     * Crear proyecto mediante un popover
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAjaxCreate() {
        if (Yii::app()->request->isAjaxRequest) {
            $model = new Escenario;
            $model->estado = Escenario::ESTADO_ACTIVO;
            $this->ajaxValidation($model);
            $result = array();
            if (isset($_POST['Escenario'])) {
                $model->attributes = $_POST['Escenario'];
                $result['success'] = $model->save();
                echo CJSON::encode($result);
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'escenario-form');

        if (isset($_POST['Escenario'])) {
            $model->attributes = $_POST['Escenario'];
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
        $model = new Escenario('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Escenario']))
            $model->attributes = $_GET['Escenario'];

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
        $model = Escenario::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'escenario-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * funcion de validacion por ajax
     * @param type $model
     * @param type $form_id
     */
    protected function ajaxValidation($model, $form_id = "escenario-form") {
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

    public function actionAjaxlistEscenarios($search_value) {
        if (Yii::app()->request->isAjaxRequest) {
            echo CJSON::encode(Escenario::model()->getListSelect2($search_value));
        }
    }

}
