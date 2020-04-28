<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string|null $language
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property DefaultLanguages[] $defaultLanguages
 * @property LanguageRelation[] $languageRelations
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['language'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DefaultLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultLanguages()
    {
        return $this->hasMany(DefaultLanguages::className(), ['language_id' => 'id']);
    }

    /**
     * Gets query for [[LanguageRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguageRelations()
    {
        return $this->hasMany(LanguageRelation::className(), ['language_id' => 'id']);
    }
}
