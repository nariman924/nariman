<?php

use yii\db\Migration;

/**
 * Handles the creation of table `file`.
 */
class m171109_094840_create_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function saveUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('xml_file', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200),
            'upload_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ], $tableOptions);

        $this->createTable('xml_file_tags', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer(),
            'tag_name' => $this->string(200),
            'entries' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_file_tags',
            'xml_file_tags',
            'file_id',
            'xml_file',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function saveDown()
    {
        $this->dropForeignKey('fk_file_tags', 'xml_file_tags');
        $this->dropTable('xml_file_tags');
        $this->dropTable('xml_file');
    }
}
