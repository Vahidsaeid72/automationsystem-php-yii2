<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{


    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //        foreach (self::$users as $user) {
        //            if ($user['accessToken'] === $token) {
        //                return new static($user);
        //            }
        //        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username, $password)
    {
        $FindUsers = static::findOne(['UsersUserName' => $username, 'UsersPassword' => $password, 'UsersActivity' => 1]);

        if ($FindUsers) {
            $session = \Yii::$app->session;
            $session->set('UsersID', $FindUsers->UsersID);
            $session->set('UserSignature', $FindUsers->UsersSignature);

            // $FindJobLevel = \Yii::$app->db->createCommand('CALL 	SP_FindUserJob(' . $FindUsers->UsersID . ')')->queryOne();

            // $FindShowUsersForLevel = \Yii::$app->db->createCommand('CALL SP_ShowUsersForLevel(' . $FindJobLevel['JobsLevel'] . ',' . $FindUsers->UsersID . ')')->queryAll();

            // $UsersForSendingShow = array();

            // foreach ($FindShowUsersForLevel as $key => $value) {
            //     $UsersForSendingShow[$value['UsersID']] = $value['FullName'];
            // }

            // $session->set('UsersForSendingShow', $UsersForSendingShow);


            $FindUsersAccess = \Yii::$app->db->createCommand('CALL SP_FindUsersAccess(' . $FindUsers->UsersID . ')')->queryOne();

            $session->set('UsersAccess1', $FindUsersAccess['UsersAccess1']);
            $session->set('UsersAccess2', $FindUsersAccess['UsersAccess2']);
            $session->set('UsersAccess3', $FindUsersAccess['UsersAccess3']);
            $session->set('UsersAccess4', $FindUsersAccess['UsersAccess4']);
            $session->set('UsersAccess5', $FindUsersAccess['UsersAccess5']);
            $session->set('UsersAccess6', $FindUsersAccess['UsersAccess6']);
            $session->set('UsersAccess7', $FindUsersAccess['UsersAccess7']);
            $session->set('UsersAccess8', $FindUsersAccess['UsersAccess8']);
            $session->set('UsersAccess9', $FindUsersAccess['UsersAccess9']);
            $session->set('UsersAccess10', $FindUsersAccess['UsersAccess10']);
            $session->set('UsersAccess11', $FindUsersAccess['UsersAccess11']);
            $session->set('UsersAccess12', $FindUsersAccess['UsersAccess12']);
            $session->set('UsersAccess13', $FindUsersAccess['UsersAccess13']);
            $session->set('UsersAccess14', $FindUsersAccess['UsersAccess14']);


            return $FindUsers;
        } {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->UsersID;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $FindUsers = Users::findOne(['UsersPassword' => $password]);

        if ($FindUsers) {
            return true;
        } else {
            return null;
        }
    }
}