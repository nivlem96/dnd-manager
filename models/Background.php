<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "background".
 *
 * @property int                   $id
 * @property string|null           $name
 * @property string|null           $description
 * @property int|null              $language_choices
 * @property string|null           $created_at
 * @property string|null           $updated_at
 *
 * @property DefaultLanguages[]    $defaultLanguages
 * @property DefaultSkill[]        $defaultSkills
 * @property ProficiencyRelation[] $proficiencyRelations
 */
class Background extends \yii\db\ActiveRecord {
    public $skills_to_choose;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'background';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['description'], 'string'],
            [['language_choices'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'language_choices' => 'Language Choices',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DefaultLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultLanguages() {
        return $this->hasMany(DefaultLanguages::className(), ['background_id' => 'id']);
    }

    /**
     * Gets query for [[DefaultSkills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultSkills() {
        return $this->hasMany(DefaultSkill::className(), ['background_id' => 'id']);
    }

    /**
     * Gets query for [[ProficiencyRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProficiencyRelations() {
        return $this->hasMany(ProficiencyRelation::className(), ['background_id' => 'id']);
    }

    /**
     * Gets query for [[Choices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChoices() {
        return Choice::find()->where(['relation_class' => Background::className()])->andWhere(['relation_id' => $this->id]);
    }
}