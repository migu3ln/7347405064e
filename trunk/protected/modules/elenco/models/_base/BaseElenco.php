<?php

/**
 * This is the model base class for the table "elenco".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Elenco".
 *
 * Columns in table "elenco" available as properties of the model,
 * followed by relations of table "elenco" available as properties of the model.
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $estado
 * @property integer $elenco_representante_id
 *
 * @property ElencoRepresentante $elencoRepresentante
 * @property ElencoMultimedia[] $elencoMultimedias
 */
abstract class BaseElenco extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'elenco';
    }

    public static function representingColumn() {
        return 'nombre';
    }

    public function rules() {
        return array(
            array('nombre, elenco_representante_id', 'required'),
            array('elenco_representante_id', 'numerical', 'integerOnly'=>true),
            array('nombre', 'length', 'max'=>150),
            array('estado', 'length', 'max'=>8),
            array('descripcion', 'safe'),
            array('estado', 'in', 'range' => array('ACTIVO','INACTIVO')), // enum,
            array('descripcion, estado', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, nombre, descripcion, estado, elenco_representante_id', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'elencoRepresentante' => array(self::BELONGS_TO, 'ElencoRepresentante', 'elenco_representante_id'),
            'elencoMultimedias' => array(self::HAS_MANY, 'ElencoMultimedia', 'elenco_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'nombre' => Yii::t('app', 'Nombre'),
                'descripcion' => Yii::t('app', 'Descripcion'),
                'estado' => Yii::t('app', 'Estado'),
                'elenco_representante_id' => Yii::t('app', 'Elenco Representante'),
                'elencoRepresentante' => null,
                'elencoMultimedias' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('estado', $this->estado, true);
        $criteria->compare('elenco_representante_id', $this->elenco_representante_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}