<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $fullname
 * @property string|null $surname
 * @property string|null $photo
 * @property string|null $comment
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    public $eventImage;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'fullname', 'surname'], 'string', 'max' => 25],
            [['comment'], 'string', 'max' => 150],
            [['eventImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'fullname' => 'Fullname',
            'surname' => 'Surname',
            'photo' => 'Photo',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function upload()
    {
        $name = rand(1000, 9999) . strtotime(date("now"));
        $path = 'upload/profile/' . $name . "." . $this->eventImage->extension;
        if ($this->eventImage->saveAs($path) and file_exists('upload/profile/'.$this->photo)) {
            if (file_exists('upload/profile/'.$this->photo))
            {
                unlink('upload/profile/'.$this->photo);
            }
            $this->photo = $name . "." . $this->eventImage->extension;
            $this->eventImage = null;
            return true;
        } else {
            $this->photo = $name . "." . $this->eventImage->extension;
            $this->eventImage = null;
            return true;
        }
    }

    public function uploadPath()
    {
        return Url::to('web/uploads/profile');
    }
}
