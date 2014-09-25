<?php

Yii::import('proyectos.models._base.BaseProyecto');

class Proyecto extends BaseProyecto
{
    /**
     * @return Proyecto
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Proyecto|Proyectos', $n);
    }

}