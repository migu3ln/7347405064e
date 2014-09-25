<?php

Yii::import('eventos.models._base.BaseEventoCategoria');

class EventoCategoria extends BaseEventoCategoria
{
    /**
     * @return EventoCategoria
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EventoCategoria|EventoCategorias', $n);
    }

}