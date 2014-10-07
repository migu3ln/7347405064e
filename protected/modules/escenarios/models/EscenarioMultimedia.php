<?php

Yii::import('escenarios.models._base.BaseEscenarioMultimedia');

class EscenarioMultimedia extends BaseEscenarioMultimedia {

    /**
     * @return EscenarioMultimedia
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function label($n = 1) {
        return Yii::t('app', 'EscenarioMultimedia|EscenarioMultimedias', $n);
    }

    public function rules() {
        return array_merge(parent::rules(), array(
            array('ubicacion, local, tipo, escenario_id', 'required', 'on' => 'video'),
            array('local, escenario_id', 'numerical', 'integerOnly' => true, 'on' => 'video'),
            array('tipo', 'length', 'max' => 45, 'on' => 'video'),
            array('ubicacion', 'ext.Validators.UrlValidator', 'on' => 'video'),
                )
        );
    }

    public function de_tipo($tipo) {
        $this->getDbCriteria()->mergeWith(
                array(
                    'condition' => 't.tipo = :tipo',
                    'params' => array(
                        ':tipo' => $tipo
                    ),
                )
        );
        return $this;
    }

    public function logo_de_escenario($escenario_id) {
//        die(var_dump($elenco_id));
        $logo = EscenarioMultimedia::model()->findByAttributes(array("tipo" => 'LOGO', 'escenario_id' => $escenario_id));

        return $logo;
    }

}
