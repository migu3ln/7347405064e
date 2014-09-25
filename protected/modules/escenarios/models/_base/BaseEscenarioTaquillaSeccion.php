<?php

/**
 * This is the model base class for the table "escenario_taquilla_seccion".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EscenarioTaquillaSeccion".
 *
 * Columns in table "escenario_taquilla_seccion" available as properties of the model,
 * followed by relations of table "escenario_taquilla_seccion" available as properties of the model.
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $escenario_taquilla_id
 *
 * @property EscenarioTaquilla $escenarioTaquilla
 * @property EventoPrecioTaquilla[] $eventoPrecioTaquillas
 */
abstract class BaseEscenarioTaquillaSeccion extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'escenario_taquilla_seccion';
    }

    public static function representingColumn() {
        return 'nombre';
    }

    public function rules() {
        return array(
            array('id, nombre, escenario_taquilla_id', 'required'),
            array('id, escenario_taquilla_id', 'numerical', 'integerOnly'=>true),
            array('nombre', 'length', 'max'=>45),
            array('id, nombre, escenario_taquilla_id', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'escenarioTaquilla' => array(self::BELONGS_TO, 'EscenarioTaquilla', 'escenario_taquilla_id'),
            'eventoPrecioTaquillas' => array(self::HAS_MANY, 'EventoPrecioTaquilla', 'escenario_taquilla_seccion_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'nombre' => Yii::t('app', 'Nombre'),
                'escenario_taquilla_id' => Yii::t('app', 'Escenario Taquilla'),
                'escenarioTaquilla' => null,
                'eventoPrecioTaquillas' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('escenario_taquilla_id', $this->escenario_taquilla_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}