<?php

Yii::import('escenarios.models._base.BaseEscenarioTaquillaSeccion');

class EscenarioTaquillaSeccion extends BaseEscenarioTaquillaSeccion
{
    /**
     * @return EscenarioTaquillaSeccion
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EscenarioTaquillaSeccion|EscenarioTaquillaSeccions', $n);
    }

}