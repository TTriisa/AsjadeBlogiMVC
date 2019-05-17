<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blogLines".
 *
 * @property int $id
 * @property int $blogID
 * @property string $title
 * @property string $text
 * @property string $img
 */
class BlogLines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blogLines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blogID'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['text'], 'string', 'max' => 1024],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blogID' => 'Blog ID',
            'title' => 'Title',
            'text' => 'Text',
            'img' => 'Img',
        ];
    }
}
