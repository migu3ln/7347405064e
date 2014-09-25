<?php

Yii::import('eventos.models._base.BaseEvento');

class Evento extends BaseEvento
{
    /**
     * @return Evento
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Evento|Eventos', $n);
    }

}