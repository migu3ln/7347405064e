<?php

Yii::import('eventos.models._base.BaseEventoMultimedia');

class EventoMultimedia extends BaseEventoMultimedia
{
    /**
     * @return EventoMultimedia
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EventoMultimedia|EventoMultimedias', $n);
    }

}