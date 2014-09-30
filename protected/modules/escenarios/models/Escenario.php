<?php

Yii::import('escenarios.models._base.BaseEscenario');

class Escenario extends BaseEscenario {

    const ESTADO_ACTIVO = 'ACTIVO';
    const ESTADO_INACTIVO = 'INACTIVO';

    /**
     * @return Escenario
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Escenario|Escenarios', $n);
    }

    public function rules() {
        return array(
            array('nombre', 'required'),
            array('nombre', 'unique'),
            array('teatro_sucre', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 150),
            array('ubicacion', 'length', 'max' => 100),
            array('estado', 'length', 'max' => 8),
            array('descripcion', 'safe'),
            array('estado', 'in', 'range' => array('ACTIVO', 'INACTIVO')), // enum,
            array('teatro_sucre, ubicacion, descripcion, estado', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, nombre, teatro_sucre, ubicacion, descripcion, estado', 'safe', 'on' => 'search'),
        );
    }

    public function getListSelect2($search_value) {
        $command = Yii::app()->db->createCommand()
                ->select('es.id, es.nombre as text')
                ->from('escenario es')
                ->where("es.nombre like '$search_value%'")
                ->andWhere('es.estado = :estado', array(':estado' => Escenario::ESTADO_ACTIVO))
                ->limit(10);
        return $command->queryAll();
    }

}
