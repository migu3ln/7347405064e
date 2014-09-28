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

}
