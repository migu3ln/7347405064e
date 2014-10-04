<?php

Yii::import('producciones.models._base.BaseProduccionMultimedia');

class ProduccionMultimedia extends BaseProduccionMultimedia
{
    /**
     * @return ProduccionMultimedia
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public static function label($n = 1)
    {
        return Yii::t('app', 'ProduccionMultimedia|ProduccionMultimedias', $n);
    }
    
      public function de_produccion($produccion_id) {
        $this->getDbCriteria()->mergeWith(
                array(
                    'condition' => 'produccion_id = :produccion_id',
                    'params' => array(
                        ':produccion_id' => $produccion_id
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