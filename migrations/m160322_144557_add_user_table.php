<?php

use yii\db\Migration;

class m160322_144557_add_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email'                => $this->string()->notNull()->unique(),
            'status'               => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at'           => $this->integer()->notNull(),
            'updated_at'           => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%profile}}', [
            'user_id'         => $this->primaryKey(),
            'firstname'       => $this->string(60),
            'lastname'        => $this->string(60),
            'middlename'      => $this->string(60),
            'phone'           => $this->string(32),
            'passport_seria'  => $this->string(6),
            'passport_number' => $this->integer(11),
            'passport_place'  => $this->string(255),
            'passport_date'   => $this->integer(),
            'location'        => $this->string(255),
            'website'         => $this->string(255),
            'bio'             => $this->text(),
        ], $tableOptions);

        $this->addForeignKey('fk_user_profile', '{{%profile}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%user}}');
    }
}
