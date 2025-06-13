<?php
namespace Fuel\App;

use Fuel\Core\Migration;
use Fuel\Core\DBUtil;



class Migration_Create_monitors extends Migration
{
    public function up()
    {
        DBUtil::create_table('monitor_box', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'label' => array('constraint' => 20, 'type' => 'varchar'),
            'status' => array('type' => 'enum', 'constraint' => "'貸出中','空き'", 'default' => '空き'),
            'current_user' => array('constraint' => 50, 'type' => 'varchar', 'null' => true),
            // 'current_email' の行を削除
            'updated_at' => array('type' => 'datetime', 'null' => true),
			'created_at' => array('type' => 'datetime', 'null' => true),
        ), array('id'));
    }

    public function down()
    {
        DBUtil::drop_table('monitor_box');
    }
}