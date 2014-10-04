<?php

Yii::import('producciones.models._base.BaseProduccion');

class Produccion extends BaseProduccion {

    const ESTADO_ACTIVO = 'ACTIVO';
    const ESTADO_INACTIVO = 'INACTIVO';

    /**
     * @return Produccion
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
     public function scopes() {
        return array(
            'activos' => array(
                'condition' => 't.estado = :estado',
                'params' => array(
                    ':estado' => self::ESTADO_ACTIVO,
                ),
            ),
        );
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Produccion|Producciones', $n);
    }

}
