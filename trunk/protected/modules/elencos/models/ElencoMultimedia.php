<?php

Yii::import('elencos.models._base.BaseElencoMultimedia');

class ElencoMultimedia extends BaseElencoMultimedia {

    /**
     * @return ElencoMultimedia
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Elenco Multimedia|Elenco Multimedias', $n);
    }

    public function scopes() {

        return array(
            'logo' => array(
                'condition' => 't.tipo = :tipo'),
            'params' =>
            array(
                ':tipo' => "LOGO",
            ),
        );
    }

    public function de_elenco($elenco_id) {
        $this->getDbCriteria()->mergeWith(
                array(
                    'condition' => 'elenco_id = :elenco_id',
                    'params' => array(
                        ':elenco_id' => $elenco_id
                    ),
                )
        );
        return $this;
    }

    public function logo_de_elenco($elenco_id) {
//        die(var_dump($elenco_id));
        $logo = ElencoMultimedia::model()->findByAttributes(array("tipo" => 'LOGO', 'elenco_id' => $elenco_id));

        return $logo;
    }

    public function imagenes_de_elenco($elenco_id, $tipo, $menu = null, $encabezado = null) {
        $command = Yii::app()->db->createCommand()
                ->select('*')
                ->from('elenco_multimedia em')
//                ->where('em.elenco_id=:elenco_id AND em.tipo=:tipo');
                ->where('em.elenco_id=:elenco_id AND em.tipo=:tipo',array(':elenco_id' => $elenco_id, ':tipo' => $tipo));
//        $command->params(array(':elenco_id' => $elenco_id, ':tipo' => $tipo));
        if($menu){
            $command->andWhere('em.menu=1');
        }
        if($encabezado){
            $command->andWhere('em.encabezado=1');
        }

//        var_dump($command->queryRow());
//        die();
        return $command->queryRow();
    }

    public function rules() {
        return array_merge(parent::rules(), array(
//            array('ubicacion, local, tipo, proyecto_id', 'required', 'on' => 'video'),
//            array('local, menu, encabezado, proyecto_id', 'numerical', 'integerOnly' => true, 'on' => 'video'),
//            array('tipo', 'length', 'max' => 45, 'on' => 'video'),
//            array('menu, encabezado', 'default', 'setOnEmpty' => true, 'value' => null, 'on' => 'video'),
            array('ubicacion', 'ext.Validators.UrlValidator', 'on' => 'video'),
                )
        );
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
