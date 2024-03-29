<?php

Yii::import('elencos.models._base.BaseElenco');

class Elenco extends BaseElenco {

    /**
     * @return Elenco
     */
    const ESTADO_ACTIVO = 'ACTIVO';
    const ESTADO_INACTVO = 'INACTIVO';

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Elenco|Elencos', $n);
    }
    
    

}
