<?php

/**
 * This is the model base class for the table "escenario_multimedia".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EscenarioMultimedia".
 *
 * Columns in table "escenario_multimedia" available as properties of the model,
 * followed by relations of table "escenario_multimedia" available as properties of the model.
 *
 * @property integer $id
 * @property string $ubicacion
 * @property integer $local
 * @property string $tipo
 * @property integer $escenario_id
 *
 * @property Escenario $escenario
 */
abstract class BaseEscenarioMultimedia extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'escenario_multimedia';
    }

    public static function representingColumn() {
        return 'ubicacion';
    }

    public function rules() {
        return array(
            array('ubicacion, local, tipo, escenario_id', 'required'),
            array('local, escenario_id', 'numerical', 'integerOnly'=>true),
            array('tipo', 'length', 'max'=>45),
            array('id, ubicacion, local, tipo, escenario_id', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'escenario' => array(self::BELONGS_TO, 'Escenario', 'escenario_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'ubicacion' => Yii::t('app', 'Ubicacion'),
                'local' => Yii::t('app', 'Local'),
                'tipo' => Yii::t('app', 'Tipo'),
                'escenario_id' => Yii::t('app', 'Escenario'),
                'escenario' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('ubicacion', $this->ubicacion, true);
        $criteria->compare('local', $this->local);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('escenario_id', $this->escenario_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}