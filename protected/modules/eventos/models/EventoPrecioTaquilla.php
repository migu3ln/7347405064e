<?php

Yii::import('eventos.models._base.BaseEventoPrecioTaquilla');

class EventoPrecioTaquilla extends BaseEventoPrecioTaquilla
{
    /**
     * @return EventoPrecioTaquilla
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EventoPrecioTaquilla|EventoPrecioTaquillas', $n);
    }

}