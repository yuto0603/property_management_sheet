<?php
namespace Fuel\App;

use Fuel\Core\Migration;
use Fuel\Core\DBUtil; // DBUtil を追加
use Fuel\Core\DB;     // DB を追加
use Fuel\Core\Date;   // Date を追加


class Migration_Insert_initial_monitors extends Migration
{
    public function up()
    {
        for ($i = 1; $i <= 15; $i++) {
            DB::insert('monitor_box')->set(array(
                'label' => 'B' . $i,
                'status' => '空き',
                'created_at' => \Fuel\Core\Date::forge()->format('mysql'),
                'updated_at' => \Fuel\Core\Date::forge()->format('mysql'),
            ))->execute();
        }
    }

    public function down()
    {
        for ($i = 1; $i <= 15; $i++) {
            DB::delete('monitor_box')->where('label', 'B' . $i)->execute();
        }
    }
}