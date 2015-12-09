<?php

/**
 * Migration for m151208_195937_create_table_person
 *
 * @author Serge Larin <serge.larin@gmail.com>
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m151208_195937_create_table_person
 *
 * @author Serge Larin <serge.larin@gmail.com>
 */

class m151208_195937_create_table_person extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%person}}', [
            'person_id' => $this->primaryKey() . ' COMMENT \'Идентификатор\'',
            'person_first_name' => $this->string()->notNull() . ' COMMENT "Имя"',
            'person_second_name' => $this->string()->notNull() . ' COMMENT "Отчество"',
            'person_last_name' => $this->string()->notNull() . ' COMMENT "Фамилия"',
        ], $tableOptions . ' COMMENT \'Персоны\'');

        $this->createIndex('idx_person_last_name', '{{%person}}', 'person_last_name');
    }

    public function down()
    {
        $this->dropTable('{{%person}}');
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
