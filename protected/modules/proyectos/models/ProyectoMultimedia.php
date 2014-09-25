<?php

Yii::import('proyectos.models._base.BaseProyectoMultimedia');

class ProyectoMultimedia extends BaseProyectoMultimedia
{
    /**
     * @return ProyectoMultimedia
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'ProyectoMultimedia|ProyectoMultimedias', $n);
    }

}