<?php

class ElencoRepresentanteController extends AweController {

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
    public function actionCreate() {
        $model = new ElencoRepresentante;


        if (isset($_POST['ElencoRepresentante'])) {
            $model->attributes = $_POST['ElencoRepresentante'];
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);


        if (isset($_POST['ElencoRepresentante'])) {
            $model->attributes = $_POST['ElencoRepresentante'];
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
        $model = new ElencoRepresentante('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['ElencoRepresentante']))
            $model->attributes = $_GET['ElencoRepresentante'];

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
        $model = ElencoRepresentante::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'elenco-representante-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxlistRepresentante($search_value) {
        if (Yii::app()->request->isAjaxRequest) {
            echo CJSON::encode(ElencoRepresentante::model()->getListSelect2($search_value));
        }
    }

    public function actionAjaxCreate() {
        if (Yii::app()->request->isAjaxRequest) {
            $model = new ElencoRepresentante;
//            $model->estado = Escenario::ESTADO_ACTIVO;
            $this->ajaxValidation($model);
            $result = array();
            if (isset($_POST['ElencoRepresentante'])) {
                $model->attributes = $_POST['ElencoRepresentante'];
                $result['success'] = $model->save();
                echo CJSON::encode($result);
            }
        }
    }

    protected function ajaxValidation($model, $form_id = "elenco-representante-form") {
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
