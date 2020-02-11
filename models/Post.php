<?php

namespace evolun\post\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $updatedBy
 * @property User $createdBy
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        return [
            BlameableBehavior::className(),
            ['class' => TimestampBehavior::className(), 'value' => new \yii\db\Expression('NOW()')]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['lead'], 'string', 'max' => 300],
            [['role'], 'string', 'max' => 64],
            [['role'], 'roleValidation', 'skipOnEmpty' => true],
            [['role'], 'default', 'value' => null],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Yii::$app->user->identityClass, 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Yii::$app->user->identityClass, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * Ezzel validaljuk, hogy a beallitott role letezo legyen
     * @return void
     */
    public function roleValidation($attribute, $params)
    {
        if (Yii::$app->authManager->getRole($this->role) === null) {
            $this->addError($attribute, Yii::t('post', 'There are no rule with this name'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('post', 'Title'),
            'lead' => Yii::t('post', 'Lead'),
            'content' => Yii::t('post', 'Content'),
            'created_at' => Yii::t('post', 'Created at'),
            'updated_at' => Yii::t('post', 'Updated at'),
            'created_by' => Yii::t('post', 'Created by'),
            'updated_by' => Yii::t('post', 'Updated by'),
            'role' => Yii::t('post', 'Role'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'created_by']);
    }
}
