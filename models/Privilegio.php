<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "privilegio".
 *
 * @property integer $idPrivilegio
 * @property string $nombre
 * @property integer $idPadre
 *
 * @property Grupoprivilegio[] $grupoprivilegios
 * @property Grupousuario[] $grupos
 * @property Privilegio $padre
 * @property Privilegio[] $privilegios
 */
class Privilegio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'privilegio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPrivilegio', 'nombre'], 'required'],
            [['idPrivilegio', 'idPadre'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            ['nombre', 'match', 'pattern' => "/^[a-z ]+$/i", 'message' => 'Sólo se aceptan letras'],
            [['idPadre'], 'exist', 'skipOnError' => true, 'targetClass' => Privilegio::className(), 'targetAttribute' => ['idPadre' => 'idPrivilegio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrivilegio' => Yii::t('app', 'Id Privilegio'),
            'nombre' => Yii::t('app', 'Nombre'),
            'idPadre' => Yii::t('app', 'Id Padre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoprivilegios()
    {
        return $this->hasMany(Grupoprivilegio::className(), ['id_Privilegio' => 'idPrivilegio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupousuario::className(), ['idGrupo' => 'id_Grupo'])->viaTable('grupoprivilegio', ['id_Privilegio' => 'idPrivilegio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(Privilegio::className(), ['idPrivilegio' => 'idPadre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivilegios()
    {
        return $this->hasMany(Privilegio::className(), ['idPadre' => 'idPrivilegio']);
    }

    /**
     * @inheritdoc
     * @return PrivilegioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PrivilegioQuery(get_called_class());
    }
}
