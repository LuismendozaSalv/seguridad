<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bitacora".
 *
 * @property integer $idBitacora
 * @property string $fechaHora
 * @property string $actividad
 * @property string $userName
 * @property integer $id_Empresa
 *
 * @property Empresa $empresa
 */
class Bitacora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bitacora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaHora'], 'safe'],
            [['actividad', 'userName', 'id_Empresa'], 'required'],
            [['id_Empresa'], 'integer'],
            [['actividad'], 'string', 'max' => 50],
            [['userName'], 'string', 'max' => 100],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idBitacora' => Yii::t('app', 'Id Bitacora'),
            'fechaHora' => Yii::t('app', 'Fecha Hora'),
            'actividad' => Yii::t('app', 'Actividad'),
            'userName' => Yii::t('app', 'User Name'),
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
}
