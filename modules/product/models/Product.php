<?php

namespace app\modules\product\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\User;

use app\modules\product\models\product as Product;


/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property float|null $price
 * @property string|null $type
 * @property bool|null $status
 */
class Product extends \yii\db\ActiveRecord
{
    
	
	 public $personName;
	
	/**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['price'], 'number'],
            [['type'], 'string'],
            [['status'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 255],
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
            'name' => 'Product Name',
            'description' => 'Product description',
            'price' => 'Price',
            'type' => 'Type',
            'status' => 'Status',

        ];
    }
	
	
	 public function getPerson()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
	
	/**
	public function beforeSave($insert)
    {
        if ($insert) {
            $this->user_id = Yii::$app->user->id;
            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->user->identity->email)
                ->setSubject('New Product Added')
                ->setTextBody('New product ' . $this->name . ' has been added.')
                ->send();
        }
        return parent::beforeSave($insert);
    }
	
	**/
}
