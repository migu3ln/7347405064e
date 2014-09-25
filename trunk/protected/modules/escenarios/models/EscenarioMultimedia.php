<?php

Yii::import('escenarios.models._base.BaseEscenarioMultimedia');

class EscenarioMultimedia extends BaseEscenarioMultimedia
{
    /**
     * @return EscenarioMultimedia
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EscenarioMultimedia|EscenarioMultimedias', $n);
    }

}