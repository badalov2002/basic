<?php

use yii\db\Migration;

/**
 * Class m240125_090703_create_user_tables
 */
class m240125_090703_create_user_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(11)->notNull(),
            'name' =>  $this->string(25),
            'username' => $this->string(25)->notNull(),
            'password' => $this->string(100)->notNull(),
            'authKey' => $this->string(150),
            'accessToken' => $this->string(150),
        ]);

        $this->createTable('profile', [
            'id' => $this->primaryKey(11),
            'user_id' => $this->integer(11)->notNull(),
            'name' => $this->string(25),
            'fullname' => $this->string(25),
            'surname' => $this->string(25),
            'photo' => $this->string(25),
            'comment' => $this->string(150),

        ]);
        $this->createIndex(
            'idx-profile-user_id',
            'profile',
            'user_id'
        );

        $this->addForeignKey(
            'fk-profile-user_id',
            'profile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $sql = '
                
                CREATE TRIGGER profile_trigger
                AFTER INSERT
                ON basic.user
                FOR EACH ROW
                BEGIN
                    INSERT INTO basic.profile (user_id, name)
                    VALUES (NEW.id, NEW.name);
                END;
                ';
        $this->execute($sql);
        $this->insert('user', [
            'name' => 'admin',
            'username' => 'admin',
            'password' => sha1('admin_1222'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $sql = '
            DROP TRIGGER profile_trigger
        ';
        $this->execute($sql);
        $this->dropForeignKey(
            'fk-profile-user_id',
            'profile'
        );

        $this->dropIndex(
            'idx-profile-user_id',
            'profile'
        );

        $this->dropTable('profile');
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240125_090703_create_user_tables cannot be reverted.\n";

        return false;
    }
    */
}
