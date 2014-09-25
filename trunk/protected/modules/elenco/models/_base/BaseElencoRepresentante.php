<?php

/**
 * This is the model base class for the table "elenco_representante".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ElencoRepresentante".
 *
 * Columns in table "elenco_representante" available as properties of the model,
 * followed by relations of table "elenco_representante" available as properties of the model.
 *
 * @property integer $id
 * @property string $titulo
 * @property string $nombre
 *
 * @property Elenco[] $elencos
 */
abstract class BaseElencoRepresentante extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'elenco_representante';
    }

    public static function representingColumn() {
        return 'nombre';
    }

    public function rules() {
        return array(
            array('nombre', 'required'),
            array('titulo', 'length', 'max'=>45),
            array('nombre', 'length', 'max'=>150),
            array('titulo', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, titulo, nombre', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'elencos' => array(self::HAS_MANY, 'Elenco', 'elenco_representante_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'titulo' => Yii::t('app', 'Titulo'),
                'nombre' => Yii::t('app', 'Nombre'),
                'elencos' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('titulo', $this->titulo, true);
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