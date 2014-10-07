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
    
     public function rules() {
        return array_merge(parent::rules(), array(
            array('ubicacion, local, tipo, produccion_id', 'required', 'on' => 'video'),
            array('local, menu, encabezado, produccion_id', 'numerical', 'integerOnly' => true, 'on' => 'video'),
            array('tipo', 'length', 'max' => 45, 'on' => 'video'),
            array('menu, encabezado', 'default', 'setOnEmpty' => true, 'value' => null, 'on' => 'video'),
            array('ubicacion', 'ext.Validators.UrlValidator', 'on' => 'video'),
                )
        );
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
    
     public function logo_de_produccion($id) {
        
        $logo= ProduccionMultimedia::model()->findByAttributes(array("tipo"=>'LOGO','produccion_id'=>$id));
        
        return $logo;
    }

}