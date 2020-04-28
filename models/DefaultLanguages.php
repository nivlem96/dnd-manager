<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "default_languages".
 *
 * @property int $id
 * @property int $language_id
 * @property int|null $race_id
 * @property int|null $background_id
 *
 * @property Background $background
 * @property Language $language
 */
class DefaultLanguages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'default_languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_id'], 'required'],
            [['language_id', 'race_id', 'background_id'], 'integer'],
            [['background_id'], 'exist', 'skipOnError' => true, 'targetClass' => Background::className(), 'targetAttribute' => ['background_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language_id' => 'Language ID',
            'race_id' => 'Race ID',
            'background_id' => 'Background ID',
        ];
    }

    /**
     * Gets query for [[Background]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBackground()
    {
        return $this->hasOne(Background::className(), ['id' => 'background_id']);
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
