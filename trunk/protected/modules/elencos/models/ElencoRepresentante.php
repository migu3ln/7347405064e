<?php

Yii::import('elencos.models._base.BaseElencoRepresentante');

class ElencoRepresentante extends BaseElencoRepresentante {

    /**
     * @return ElencoRepresentante
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Elenco Representante|Elenco Representantes', $n);
    }

    public function getListSelect2($search_value) {
        $command = Yii::app()->db->createCommand()
                ->select('er.id, er.nombre as text')
                ->from('elenco_representante er')
                ->where("er.nombre like '$search_value%'")
                ->limit(10);
        return $command->queryAll();
    }

}
