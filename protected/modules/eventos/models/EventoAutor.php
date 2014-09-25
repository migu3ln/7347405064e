<?php

Yii::import('eventos.models._base.BaseEventoAutor');

class EventoAutor extends BaseEventoAutor
{
    /**
     * @return EventoAutor
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'EventoAutor|EventoAutors', $n);
    }

}