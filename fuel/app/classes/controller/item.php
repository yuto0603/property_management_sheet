<?php

class Controller_Item extends \Controller_Template
{
    public function before()
    {
        parent::before();

        $username = \Fuel\Core\Session::get('user_name', \Fuel\Core\Lang::get('guest_user'));
        \Fuel\Core\View::set_global('current_username', $username);

        \Config::set('language', 'ja'); 
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

    public function action_lend($id = null)
    {
        if ($id === null) {
            throw new \HttpNotFoundException();
        }

        $monitor = \Fuel\Core\DB::select('*')
                                ->from('monitor_box')
                                ->where('id', $id)
                                ->execute()
                                ->current();

        if (!$monitor || $monitor['status'] === '貸出中') {
            \Response::redirect('items'); 
        }

        $this->template->title = \Fuel\Core\Lang::get('common.lend_item_title');
        $this->template->content = \Fuel\Core\View::forge('item/lend', array(
            'monitor' => $monitor,
        ));
    }

    public function action_process_lend()
    {
        if (\Input::method() !== 'POST') {
            throw new \HttpNotFoundException();
        }

        $id = \Input::post('monitor_id');
        $username = \Input::post('user_name');

        if (empty($id) || empty($username)) {
            \Session::set_flash('error', \Lang::get('common.lend_input_error'));
            \Response::redirect('items/lend/'.$id);
        }

        \Fuel\Core\DB::update('monitor_box')
                      ->set(array(
                          'status' => '貸出中',
                          'current_user' => $username,
                          'updated_at' => \Date::forge()->get_timestamp(),
                      ))
                      ->where('id', $id)
                      ->execute();

        \Fuel\Core\DB::insert('monitor_log')
                      ->set(array(
                          'monitor_id' => $id,
                          'user_name' => $username,
                          'action' => '貸出',
                          'timestamp' => \Date::forge()->get_timestamp(),
                      ))
                      ->execute();

        \Session::set_flash('success', \Lang::get('common.lend_success'));
        \Response::redirect('items');
    }

    // 重複を削除して、この action_history() だけを残す
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