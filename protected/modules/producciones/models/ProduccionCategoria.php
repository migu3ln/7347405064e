<?php

Yii::import('producciones.models._base.BaseProduccionCategoria');

class ProduccionCategoria extends BaseProduccionCategoria {

//    const ESTADO_ACTIVO = 'ACTIVO';
//    const ESTADO_INACTIVO = 'INACTIVO';

    /**
     * @return ProduccionCategoria
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Categoria|Categorias', $n);
    }
    
     public function getListSelect2($search_value) {
        $command = Yii::app()->db->createCommand()
                ->select('pc.id, pc.nombre as text')
                ->from('produccion_categoria pc')
                ->where("pc.nombre like '$search_value%'")
//                ->andWhere('pc.estado = :estado', array(':estado' => ProduccionCategoria::ESTADO_ACTIVO))
                ->limit(10);
        return $command->queryAll();
    }

}
