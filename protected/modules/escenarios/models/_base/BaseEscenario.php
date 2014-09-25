<?php

/**
 * This is the model base class for the table "escenario".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Escenario".
 *
 * Columns in table "escenario" available as properties of the model,
 * followed by relations of table "escenario" available as properties of the model.
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $teatro_sucre
 * @property string $ubicacion
 * @property string $descripcion
 * @property string $estado
 *
 * @property EscenarioMultimedia[] $escenarioMultimedias
 * @property EscenarioTaquilla[] $escenarioTaquillas
 * @property EventoFecha[] $eventoFechas
 * @property Produccion[] $produccions
 */
abstract class BaseEscenario extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'escenario';
    }

    public static function representingColumn() {
        return 'nombre';
    }

    public function rules() {
        return array(
            array('nombre', 'required'),
            array('teatro_sucre', 'numerical', 'integerOnly'=>true),
            array('nombre', 'length', 'max'=>150),
            array('ubicacion', 'length', 'max'=>100),
            array('estado', 'length', 'max'=>8),
            array('descripcion', 'safe'),
            array('estado', 'in', 'range' => array('ACTIVO','INACTIVO')), // enum,
            array('teatro_sucre, ubicacion, descripcion, estado', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, nombre, teatro_sucre, ubicacion, descripcion, estado', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'escenarioMultimedias' => array(self::HAS_MANY, 'EscenarioMultimedia', 'escenario_id'),
            'escenarioTaquillas' => array(self::HAS_MANY, 'EscenarioTaquilla', 'escenario_id'),
            'eventoFechas' => array(self::HAS_MANY, 'EventoFecha', 'escenario_id'),
            'produccions' => array(self::HAS_MANY, 'Produccion', 'escenario_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'nombre' => Yii::t('app', 'Nombre'),
                'teatro_sucre' => Yii::t('app', 'Teatro Sucre'),
                'ubicacion' => Yii::t('app', 'Ubicacion'),
                'descripcion' => Yii::t('app', 'Descripcion'),
                'estado' => Yii::t('app', 'Estado'),
                'escenarioMultimedias' => null,
                'escenarioTaquillas' => null,
                'eventoFechas' => null,
                'produccions' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('teatro_sucre', $this->teatro_sucre);
        $criteria->compare('ubicacion', $this->ubicacion, true);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('estado', $this->estado, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}