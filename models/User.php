<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $idUsuario;
    public $nombre;
    public $userName;
    public $passwd;
    public $id_Empresa;
    public $direccion;
    public $telefono;
    public $id_Grupo;


    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ]
        
    ];


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = Usuario::find()
            ->where("idUsuario=:idUsuario",["idUsuario" => $id])
            ->one();
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $users = Usuario::find()
            ->where("userName=:userName",["userName" => $username])
            ->all();
        foreach ($users as $user) {
            if (strcasecmp($user->userName, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
       return $this->idUsuario;
    }

    /**
     * @return mixed
     */
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
       return $this->id_Empresa;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
       
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->passwd === $password;
    }
}
