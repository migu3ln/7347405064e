<?php

Yii::import('escenarios.models._base.BaseEscenarioTaquilla');

class EscenarioTaquilla extends BaseEscenarioTaquilla
{
    /**
     * @return EscenarioTaquilla
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EscenarioTaquilla|EscenarioTaquillas', $n);
    }

}