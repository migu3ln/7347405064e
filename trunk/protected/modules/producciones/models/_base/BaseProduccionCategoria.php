<?php

/**
 * This is the model base class for the table "produccion_categoria".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ProduccionCategoria".
 *
 * Columns in table "produccion_categoria" available as properties of the model,
 * followed by relations of table "produccion_categoria" available as properties of the model.
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Produccion[] $produccions
 */
abstract class BaseProduccionCategoria extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'produccion_categoria';
    }

    public static function representingColumn() {
        return 'nombre';
    }

    public function rules() {
        return array(
            array('nombre', 'required'),
            array('nombre', 'length', 'max'=>45),
            array('id, nombre', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'produccions' => array(self::HAS_MANY, 'Produccion', 'produccion_categoria_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'nombre' => Yii::t('app', 'Nombre'),
                'produccions' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nombre', $this->nombre, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}