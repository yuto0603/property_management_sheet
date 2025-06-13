<?php
namespace Fuel\App;

use Fuel\Core\Migration;
use Fuel\Core\DBUtil; // DBUtil を追加
use Fuel\Core\DB;     // DB を追加
use Fuel\Core\Date;   // Date を追加

class Migration_Create_monitor_logs extends Migration
{
    public function up()
    {
        DBUtil::create_table('monitor_log', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'monitor_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
            'user_name' => array('constraint' => 50, 'type' => 'varchar'),
            // 'user_email' の定義は含めない
            'action' => array('type' => 'enum', 'constraint' => "'貸出','返却'"),
            'timestamp' => array('type' => 'datetime', 'default' => \Fuel\Core\DB::expr('CURRENT_TIMESTAMP')),
        ), array('id'));

        // monitor_id に外部キー制約を追加 (任意だが、データベースの整合性維持に推奨)
        // この外部キー制約は、monitor_box テーブルが先に作成されていることを前提とします。
        DBUtil::create_foreign_key(
            'monitor_log',
            array(
                'key' => 'monitor_id',
                'reference' => array(
                    'table' => 'monitor_box',
                    'column' => 'id',
                ),
                'on_update' => 'CASCADE',
                'on_delete' => 'RESTRICT' // 貸出ログがある備品は削除できないように
            )
        );
    }

    public function down()
    {
        DBUtil::drop_table('monitor_log');
    }
}
