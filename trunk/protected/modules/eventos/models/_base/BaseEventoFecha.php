<?php

/**
 * This is the model base class for the table "evento_fecha".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EventoFecha".
 *
 * Columns in table "evento_fecha" available as properties of the model,
 * followed by relations of table "evento_fecha" available as properties of the model.
 *
 * @property integer $id
 * @property string $fecha
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property integer $evento_id
 * @property integer $escenario_id
 * @property integer $mostrar_ubicacion
 * @property string $estado
 *
 * @property Evento $evento
 * @property Escenario $escenario
 * @property EventoPrecioTaquilla[] $eventoPrecioTaquillas
 */
abstract class BaseEventoFecha extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'evento_fecha';
    }

    public static function representingColumn() {
        return 'fecha';
    }

    public function rules() {
        return array(
            array('fecha, hora_inicio, hora_fin, evento_id, escenario_id', 'required'),
            array('evento_id, escenario_id, mostrar_ubicacion', 'numerical', 'integerOnly'=>true),
            array('estado', 'length', 'max'=>8),
            array('estado', 'in', 'range' => array('ACTIVO','INACTIVO')), // enum,
            array('mostrar_ubicacion, estado', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, fecha, hora_inicio, hora_fin, evento_id, escenario_id, mostrar_ubicacion, estado', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'evento' => array(self::BELONGS_TO, 'Evento', 'evento_id'),
            'escenario' => array(self::BELONGS_TO, 'Escenario', 'escenario_id'),
            'eventoPrecioTaquillas' => array(self::HAS_MANY, 'EventoPrecioTaquilla', 'evento_fecha_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'fecha' => Yii::t('app', 'Fecha'),
                'hora_inicio' => Yii::t('app', 'Hora Inicio'),
                'hora_fin' => Yii::t('app', 'Hora Fin'),
                'evento_id' => Yii::t('app', 'Evento'),
                'escenario_id' => Yii::t('app', 'Escenario'),
                'mostrar_ubicacion' => Yii::t('app', 'Mostrar Ubicacion'),
                'estado' => Yii::t('app', 'Estado'),
                'evento' => null,
                'escenario' => null,
                'eventoPrecioTaquillas' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fecha', $this->fecha, true);
        $criteria->compare('hora_inicio', $this->hora_inicio, true);
        $criteria->compare('hora_fin', $this->hora_fin, true);
        $criteria->compare('evento_id', $this->evento_id);
        $criteria->compare('escenario_id', $this->escenario_id);
        $criteria->compare('mostrar_ubicacion', $this->mostrar_ubicacion);
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