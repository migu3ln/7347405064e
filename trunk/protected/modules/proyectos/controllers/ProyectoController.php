<?php

class ProyectoController extends AweController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';
    public $admin = false;
    public $defaultAction = 'admin';

    public function filters()
    {
        return array(
            array('CrugeAccessControlFilter'),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id = null)
    {
        $model = new Proyecto;
        if ($id) {
            $model->id = $id;
        }
        $model->estado = Proyecto::ESTADO_ACTIVO;
        $result = array();
        $modelpMultimedia = new ProyectoMultimedia('search');
        $archivo = new XUploadForm;
        $this->ajaxValidation($model);

        if (isset($_POST['Proyecto'])) {
            $model->attributes = $_POST['Proyecto'];
            $result['success'] = $model->save();

            if ($result['success']) {
                $result['attr'] = $model->attributes;
                if ($_POST['Proyecto']['logo'] != null) {
                    $modelpMultimedia->local = 0;
                    $modelpMultimedia->tipo = Constants::MULTIMEDIA_TIPO_LOGO;
                    $modelpMultimedia->menu = 0;
                    $modelpMultimedia->encabezado = 0;
                    $modelpMultimedia->proyecto_id = $model->id;
                    $src = $_POST['Proyecto']['logo'];
//                    die(var_dump($modelpMultimedia->attributes,$modelpMultimedia->validate(),$modelpMultimedia->errors));
                    if (!file_exists("uploads/proyecto/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO)) {
                        mkdir("uploads/proyecto/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO, 0777, true);
                    }
                    $path = realpath(Yii::app()->getBasePath() . "/../uploads/proyecto/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO) . "/";
                    $pathorigen = realpath(Yii::app()->getBasePath() . "/../uploads/tmp/") . "/";
                    $publicPath = Yii::app()->getBaseUrl() . "/uploads/proyecto/$model->id/" . Constants::MULTIMEDIA_TIPO_LOGO . '/';
                    if (rename($pathorigen . $src, $path . $src)) {
                        $modelpMultimedia->ubicacion = $publicPath . $src;
//                        die(var_dump($modelpMultimedia->attributes, $modelpMultimedia->validate(), $modelpMultimedia->errors));

                        $modelpMultimedia->save();
                    }
                }
            }
            echo CJSON::encode($result);
        } else {
            $this->render('create', array('model' => $model, 'modelpMultimedia' => $modelpMultimedia, 'archivo' => $archivo));
        }
    }

    /**
     * Crear proyecto mediante un popover
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAjaxCreate()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = new Proyecto;
            $model->estado = Proyecto::ESTADO_ACTIVO;
            $this->ajaxValidation($model);
            $result = array();
            if (isset($_POST['Proyecto'])) {
                $model->attributes = $_POST['Proyecto'];
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
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model, 'proyecto-form');

        if (isset($_POST['Proyecto'])) {
            $model->attributes = $_POST['Proyecto'];
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
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
//            die(var_dump($model->proyectoMultimedias));
            if (empty($model->proyectoMultimedias)) {
                echo '<div class = "alert alert-success"><button data-dismiss = "alert" class = "close" type = "button">×</button>Borrado Exitosamente.</div>';
            } else {
                echo '<div class = "alert alert-error"><button data-dismiss = "alert" class = "close" type = "button">×</button>Imposible eliminar el Proyecto, existen contenido multimedia que dependen de éste.</div>';
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Proyecto('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Proyecto']))
            $model->attributes = $_GET['Proyecto'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__)
    {
        $model = Proyecto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'proyecto-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * funcion para validaciones en jquery.ajaxValidate.js
     * @param type $model
     */
    protected function ajaxValidation($model, $form_id = "proyecto-form")
    {
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
