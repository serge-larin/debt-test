<?php

/**
 * Migration for m151209_100446_create_table_debt
 *
 * @author Serge Larin <serge.larin@gmail.com>
 */

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Expression;

/**
 * Class m151209_100446_create_table_debt
 *
 * @author Serge Larin <serge.larin@gmail.com>
 */

class m151209_100446_create_table_debt extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%debt}}', [
            'debt_id' => $this->primaryKey() . ' COMMENT "Идентификатор"',
            'debt_sum' => $this->money()->notNull() . ' COMMENT "Сумма долга"',
            'debt_comment' => $this->string()->notNull() . ' COMMENT "Примечание"',
            'debt_person' => $this->integer()->notNull() . ' COMMENT "Персона"',
            'debt_created_at' => $this->timestamp()->notNull() . ' COMMENT "Дата создания"',
        ], $tableOptions . ' COMMENT "Долг"');

        $this->createIndex('idx_debt_person', '{{%debt}}', 'debt_person');

        $this->addForeignKey(
            'fk_debt_person', '{{%debt}}', 'debt_person', '{{%person}}', 'person_id'
        );
    }

    public function down()
    {
        $this->dropTable('{{%debt}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
