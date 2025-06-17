<?php

class Controller_Item extends \Controller_Template
{
    public function before()
    {
            parent::before();

        // デバッグ用: $this->template の型を確認
        if (!is_object($this->template)) {
            \Fuel\Core\Log::error('DEBUG: $this->template is not an object. Type: ' . gettype($this->template));
            // 致命的なエラーとして表示し、処理を停止
            die('Fatal: $this->template is not an object. Please check template initialization.');
        }

        // セッションからのユーザー名取得
        $username = \Fuel\Core\Session::get('user_name', \Fuel\Core\Lang::get('guest_user'));
        \Fuel\Core\View::set_global('current_username', $username);

        // FuelPHPに現在の言語設定を強制（常に日本語をデフォルトにする）
        \Config::set('language', 'ja'); 
        
        // common言語ファイルを読み込む
        \Lang::load('common', true); 
    }

    public function action_index()
    {
        $monitors = \Fuel\Core\DB::select('*')
                                 ->from('monitor_box')
                                 ->order_by('id', 'asc')
                                 ->execute()
                                 ->as_array();

        $this->template->title = \Fuel\Core\Lang::get('system_name');
        $this->template->content = \Fuel\Core\View::forge('item/index', array(
            'monitors' => $monitors,
        ));
    }

    public function action_history()
    {
        $this->template->title = \Lang::get('common.history_button');
        $this->template->content = \View::forge('item/history');
    }

    public function action_create()
    {
        $this->template->title = \Lang::get('common.new_item_button');
        $this->template->content = \View::forge('item/create');
    }
}