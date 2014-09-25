<?php

Yii::import('eventos.models._base.BaseEventoFecha');

class EventoFecha extends BaseEventoFecha
{
    /**
     * @return EventoFecha
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EventoFecha|EventoFechas', $n);
    }

}