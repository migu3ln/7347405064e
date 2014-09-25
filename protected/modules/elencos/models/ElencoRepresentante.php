<?php

Yii::import('elencos.models._base.BaseElencoRepresentante');

class ElencoRepresentante extends BaseElencoRepresentante
{
    /**
     * @return ElencoRepresentante
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'ElencoRepresentante|ElencoRepresentantes', $n);
    }

}