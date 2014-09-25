<?php

/**
 * This is the model base class for the table "evento_multimedia".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EventoMultimedia".
 *
 * Columns in table "evento_multimedia" available as properties of the model,
 * followed by relations of table "evento_multimedia" available as properties of the model.
 *
 * @property integer $id
 * @property string $direccion
 * @property string $tipo
 * @property integer $local
 * @property integer $evento_id
 *
 * @property Evento $evento
 */
abstract class BaseEventoMultimedia extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'evento_multimedia';
    }

    public static function representingColumn() {
        return 'direccion';
    }

    public function rules() {
        return array(
            array('direccion, tipo, evento_id', 'required'),
            array('local, evento_id', 'numerical', 'integerOnly'=>true),
            array('tipo', 'length', 'max'=>45),
            array('local', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, direccion, tipo, local, evento_id', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'evento' => array(self::BELONGS_TO, 'Evento', 'evento_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'direccion' => Yii::t('app', 'Direccion'),
                'tipo' => Yii::t('app', 'Tipo'),
                'local' => Yii::t('app', 'Local'),
                'evento_id' => Yii::t('app', 'Evento'),
                'evento' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('direccion', $this->direccion, true);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('local', $this->local);
        $criteria->compare('evento_id', $this->evento_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}