<?php

Yii::import('producciones.models._base.BaseProduccionMultimedia');

class ProduccionMultimedia extends BaseProduccionMultimedia
{
    /**
     * @return ProduccionMultimedia
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'ProduccionMultimedia|ProduccionMultimedias', $n);
    }

}