<?php

use yii\db\Migration;

/**
 * Миграция для создания таблицы для хранения обращений через обратную связь
 */
class m201122_120949_create_feedbacks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedbacks}}', [
            'id' => $this->primaryKey(),
            'customer' => $this->string(255),
            'phone' => $this->string(255)->notNull(),
            'status' => $this->smallInteger()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedbacks}}');
    }
}
