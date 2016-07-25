<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personalizacion".
 *
 * @property integer $idPersonalizacion
 * @property string $Color
 * @property string $tamaÃ±o
 * @property string $Fuente
 * @property integer $id_Usuario
 * @property integer $id_Empresa
 *
 * @property Empresa $empresa
 * @property Empresa $empresa0
 */
class Personalizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personalizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Color', 'tamano', 'Fuente', 'id_Usuario', 'id_Empresa'], 'required'],
            [['id_Usuario', 'id_Empresa'], 'integer'],
            [['Color', 'tamano', 'Fuente'], 'string', 'max' => 20],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPersonalizacion' => Yii::t('app', 'Id Personalizacion'),
            'Color' => Yii::t('app', 'Color'),
            'tamano' => Yii::t('app', 'Tamaño'),
            'Fuente' => Yii::t('app', 'Fuente'),
            'id_Usuario' => Yii::t('app', 'Id  Usuario'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['idEmpresa' => 'id_Empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa0()
    {
        return $this->hasOne(Empresa::className(), ['idEmpresa' => 'id_Empresa']);
    }
}
