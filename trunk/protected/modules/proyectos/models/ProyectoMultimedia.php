<?php

Yii::import('proyectos.models._base.BaseProyectoMultimedia');

class ProyectoMultimedia extends BaseProyectoMultimedia {

    /**
     * @return ProyectoMultimedia
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function label($n = 1) {
        return Yii::t('app', 'ProyectoMultimedia|ProyectoMultimedias', $n);
    }

    public function rules() {
        return array_merge(parent::rules(), array(
            array('ubicacion, local, tipo, proyecto_id', 'required', 'on' => 'video'),
            array('local, menu, encabezado, proyecto_id', 'numerical', 'integerOnly' => true, 'on' => 'video'),
            array('tipo', 'length', 'max' => 45, 'on' => 'video'),
            array('menu, encabezado', 'default', 'setOnEmpty' => true, 'value' => null, 'on' => 'video'),
            array('ubicacion', 'ext.Validators.UrlValidator', 'on' => 'video'),
                )
        );
    }

    public function de_proyecto($proyecto_id) {
        $this->getDbCriteria()->mergeWith(
                array(
                    'condition' => 'proyecto_id = :proyecto_id',
                    'params' => array(
                        ':proyecto_id' => $proyecto_id
                    ),
                )
        );
        return $this;
    }

    public function de_tipo($tipo) {
        $this->getDbCriteria()->mergeWith(
                array(
                    'condition' => 'tipo = :tipo',
                    'params' => array(
                        ':tipo' => $tipo
                    ),
                )
        );
        return $this;
    }

}
