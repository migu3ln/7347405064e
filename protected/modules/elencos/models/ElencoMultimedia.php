<?php

Yii::import('elencos.models._base.BaseElencoMultimedia');

class ElencoMultimedia extends BaseElencoMultimedia
{
    /**
     * @return ElencoMultimedia
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'ElencoMultimedia|ElencoMultimedias', $n);
    }

}