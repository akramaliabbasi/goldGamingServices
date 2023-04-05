<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_search}}`.
 */
class m230403_120149_create_product_search_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_search}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'description' => $this->string()->notNull(),
			'price' => $this->decimal(10, 2)->notNull(),
			'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
			'updated_at' => $this->timestamp()->null()->defaultExpression('NULL ON UPDATE CURRENT_TIMESTAMP'),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_search}}');
    }
}
