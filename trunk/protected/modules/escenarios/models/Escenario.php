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
