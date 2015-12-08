<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name */

echo "<?php\n";
?>

/**
 * Migration for <?= $className."\n" ?>
 *
 * @author Serge Larin <serge.larin@gmail.com>
 */

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Expression;

/**
 * Class <?= $className."\n" ?>
 *
 * @author Serge Larin <serge.larin@gmail.com>
 */

class <?= $className ?> extends Migration
{
    public function up()
    {
        /*

        // Пример создания таблиц, индексов и внешних ключей в миграции

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey() . ' COMMENT "Идентификатор"',
            'title' => $this->string()->notNull() . ' COMMENT "Название"',
        ], $tableOptions . ' COMMENT "Категория"');

        $this->createIndex('idx_category_title', '{{%category}}', 'title');

        // Пример заполнения словарной таблицы
        $this->BatchInsert('{{%category}}', ['title'], [
            [ 'Оптимизация', ],
            [ 'Рефакторинг', ],
            [ 'Composer', ],
        ]);

        // Пример одиночной вставки
        $this->Insert('{{%category}}', [
            'title' => 'JavaScript',
        ]);

        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey() . ' COMMENT "Идентификатор"',
            'title' => $this->string()->notNull() . ' COMMENT "Заголовок"',
            'content' => $this->text()->notNull() . ' COMMENT "Текст статьи"',
            'category_id' => $this->integer()->notNull() . ' COMMENT "Категория"',
            'author_id' => $this->integer()->notNull() . ' COMMENT "Автор"',
            'publish_date' => $this->timestamp()->notNull() . ' DEFAULT NOW() COMMENT "Дата и время публикации"',
        ], $tableOptions . ' COMMENT "Статья"');

        $this->createIndex('idx_post_category', '{{%post}}', 'category_id');
        $this->addForeignKey(
            'fk_post_category', '{{%post}}', 'category_id', '{{%category}}', 'id'
        );
        */
    }

    public function down()
    {
        echo "<?= $className ?> cannot be reverted.\n";
        return false;

        /*
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%category}}');
        */

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
