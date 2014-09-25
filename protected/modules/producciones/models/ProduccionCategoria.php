<?php

Yii::import('producciones.models._base.BaseProduccionCategoria');

class ProduccionCategoria extends BaseProduccionCategoria
{
    /**
     * @return ProduccionCategoria
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'ProduccionCategoria|ProduccionCategorias', $n);
    }

}