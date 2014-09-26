<?php

Yii::import('proyectos.models._base.BaseProyecto');

class Proyecto extends BaseProyecto {

    const ESTADO_ACTIVO = 'ACTIVO';
    const ESTADO_INACTIVO = 'INACTIVO';

    /**
     * @return Proyecto
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
        return Yii::t('app', 'Proyecto|Proyectos', $n);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), array(
            'descripcion' => Yii::t('app', 'Descripción'),
        ));
    }

}
