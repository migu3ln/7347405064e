<?php

class EscenarioMultimediaController extends AweController {

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
        $model = new EscenarioMultimedia;

        $this->performAjaxValidation($model, 'escenario-multimedia-form');

        if (isset($_POST['EscenarioMultimedia'])) {
            $model->attributes = $_POST['EscenarioMultimedia'];
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

        $this->performAjaxValidation($model, 'escenario-multimedia-form');

        if (isset($_POST['EscenarioMultimedia'])) {
            $model->attributes = $_POST['EscenarioMultimedia'];
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
        $model = new EscenarioMultimedia('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['EscenarioMultimedia']))
            $model->attributes = $_GET['EscenarioMultimedia'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionUploadTmp() {
        $carpeta = 'tmp';
        $id = '';
        chdir(getcwd()); //me ubico en el directorio del proyecto
//        Yii::import("ext.xupload.models.XUploadForm");
        /* creacion de la carpeta $id dentro de la $carpeta correspondiente para
         * el guardado de los multiples archivos */
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
        // Here we define the paths where the files will be stored temporarily
        // creacion de los path para el guardado de los multiples archivos con el $id y $carpeta correspondiente
        $path = realpath(Yii::app()->getBasePath() . "/../uploads/" . $carpeta . "/" . $id) . "/";
        $publicPath = Yii::app()->getBaseUrl() . "/uploads/" . $carpeta . "/" . $id;
        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT']) && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }


        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"][0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        // borrar el archivo del path correspondiente
                        unlink($file);
                    }
                }
                echo json_encode(true);
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            // We check that the file was successfully uploaded
            if ($model->file !== null) {

                // Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();

                //(optional) Generate a random name for our file
                $filename = $model->name;
                $filename = time('U') . rand(0, time('U')) . '.' . $model->file->getExtensionName();
                if ($model->validate()) {
                    // Move our file to our temporary dir
                    $model->file->saveAs($path . $filename);

                    chmod($path . $filename, 0777);
                    // here you can also generate the image versions you need 
                    // using something like PHPThumb
                    // Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState('images')) {
                        $userImages = Yii::app()->user->getState('images');
                    } else {
                        $userImages = array();
                    }
                    $userImages[] = array(
                        "path" => $path . $filename,
                        //the same file or a thumb version that you generated
                        "thumb" => $path . $filename,
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                    );
                    Yii::app()->user->setState('images', $userImages);

                    // Now we need to tell our widget that the upload was succesfull
                    // We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "filename" => $filename,
                            "url" => $publicPath . '/' . $filename,
                            "delete_url" => $this->createUrl("uploadTmp", array(
                                "_method" => "delete",
                                "file" => $filename,
                                "id" => $id,
                                "carpeta" => $carpeta
                            )),
                            "delete_type" => "POST"
                    )));
                    /*
                     * Aqui va la guardado de archivos en l base                     */
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(array("error" => $model->getErrors('file'))));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()), CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction");
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $modelClass = __CLASS__) {
        $model = EscenarioMultimedia::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model, $form = null) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'escenario-multimedia-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
