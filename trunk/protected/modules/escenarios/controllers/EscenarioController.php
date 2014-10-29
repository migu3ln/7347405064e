<?php

class EscenarioController extends AweController
{

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
     *
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id = null)
    {
        $model = new Escenario;
        if ($id) {
            $model->id = $id;
        }
        //gestion de taquilla
        $model_taquilla = new EscenarioTaquilla('search');
        $model_taquilla->unsetAttributes();
        if (isset($_GET['EscenarioTaquilla'])) {
            $model_taquilla->attributes = $_GET['EscenarioTaquilla'];
        }
        //gestion de secciones
        $model_taquilla_seccion = new EscenarioTaquillaSeccion('search');
        $model_taquilla_seccion->unsetAttributes();
        if (isset($_GET['EscenarioTaquillaSeccion'])) {
            $model_taquilla_seccion->attributes = $_GET['EscenarioTaquillaSeccion'];
        }
        $result = array();
        $archivo = new XUploadForm;
        $this->ajaxValidation($model);
        if (isset($_POST['Escenario'])) {
            $result['success'] = $model->save();
            if ($result['success']) {
                $result['attr'] = $model->attributes;
//                var_dump($model->attributes);
//                var_dump($_POST['Escenario']['logo']);
//                die("entro");
                if ($_POST['Escenario']['logo'] != '' && $_POST['Escenario']['logo'] != 'null') {
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
                    var_dump("entro");
                }
            }
            echo CJSON::encode($result);
        } else {
            $this->render('create', array(
                'model' => $model, 'archivo' => $archivo,
                'model_taquilla' => $model_taquilla,
                'model_taquilla_seccion' => $model_taquilla_seccion
            ));
        }
    }

    /**
     * Crear proyecto mediante un popover
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAjaxCreate()
    {
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
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
            $elementos = EscenarioMultimedia::model()->count(array(
                    'condition' => 't.escenario_id = :escenario_id',
                    'params' => array(':escenario_id' => $model->id))) +
                EscenarioTaquilla::model()->count(array(
                    'condition' => 't.escenario_id = :escenario_id',
                    'params' => array(':escenario_id' => $model->id)));
            if ($elementos > 0) {
                throw new CHttpException(400, 'No se puede eliminar el elemento, ya que hay dependencias asociadas al mismo');
            } else {
                $model->estado = Escenario::ESTADO_INACTIVO;
                $model->save();
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
    public function loadModel($id, $modelClass = __CLASS__)
    {
        $model = Escenario::model()->findByPk($id);
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
    protected function ajaxValidation($model, $form_id = "escenario-form")
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

    public function actionAjaxlistEscenarios($search_value)
    {
        if (Yii::app()->request->isAjaxRequest) {
            echo CJSON::encode(Escenario::model()->getListSelect2($search_value));
        }
    }

    public function actionAjaxUploadTemp()
    {
        if (Yii::app()->request->isAjaxRequest) {
            //nombre de la carpeta
            $carpeta = 'tmp';
            $path = realpath(Yii::app()->getBasePath() . "/../uploads/" . $carpeta . "/") . "\\";
            $publicPath = Yii::app()->getBaseUrl() . "/uploads/" . $carpeta . "/";
            if (isset($_GET['_method'])) {
                if ($_GET['_method'] == 'delete') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        // borrar el archivo del path correspondiente
                        unlink($file);
                        echo CJSON::encode(array("success" => true));
                    } else {
                        echo CJSON::encode(array("success" => false));
                    }
                }
                Yii::app()->end();
            }


            //obtenemos el archivo a subir
            $file = $_FILES['file'];
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!file_exists('uploads/')) {
                if (mkdir('uploads/', 0777, true)) {
                    chmod("uploads/", 0777);
                    chdir(getcwd() . '/uploads/');
                    if (!file_exists($carpeta . '/')) {
                        mkdir($carpeta . '/', 0777, true);
                        chmod("$carpeta/", 0777);
                    }
                }
            }
            // creacion de los path para el guardado de los multiples archivos con el $id y $carpeta correspondiente
            $filename = time('U') . rand(0, time('U')) . '.' . Util::getExtensionName($file['name']);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['file']['tmp_name'], $path . $filename)) {
                echo CJSON::encode(array(
                    "success" => true,
                    "data" => array(
                        'name' => $filename,
                        'size' => $file['size'],
                        'url' => $path . $filename,
                        'src' => $publicPath . $filename,
                        'delete_url' => $this->createUrl('ajaxUploadTemp', array(
                            '_method' => "delete",
                            'file' => $filename,
                            "carpeta" => $carpeta
                        ))
                    )));
            }
        } else {
            echo CJSON::encode(array("success" => false));
        }
    }

}
