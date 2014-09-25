<?php

Yii::import('producciones.models._base.BaseProduccion');

class Produccion extends BaseProduccion
{
    /**
     * @return Produccion
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'Produccion|Produccions', $n);
    }

}