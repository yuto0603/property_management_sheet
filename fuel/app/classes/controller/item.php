<?php

//namespace Fuel\App;

class Controller_Item extends \Controller_Template
{
    public function before()
    {
        parent::before();

        // F-005: 共通処理（セッションからのユーザー名取得）
        // F-002: ログインユーザー名セッション管理
        // 今後の多言語対応のためLangクラスも使用
        $username = \Fuel\Core\Session::get('user_name', \Fuel\Core\Lang::get('guest_user'));
        \Fuel\Core\View::set_global('current_username', $username);

        // F-003: nav-pills のアクティブ状態切り替えのための言語設定
        // ユーザーが ?lang=ja または ?lang=en で言語を切り替える
        if (\Fuel\Core\Input::get('lang')) {
            $lang = \Fuel\Core\Input::get('lang');
            if (in_array($lang, ['ja', 'en'])) {
                \Fuel\Core\Config::set('language', $lang);
                \Fuel\Core\Session::set('language', $lang); // セッションに保存
            }
        } else {
            // セッションに保存された言語があればそれを使用
            $session_lang = \Fuel\Core\Session::get('language');
            if ($session_lang) {
                \Fuel\Core\Config::set('language', $session_lang);
            }
        }
    }

    public function action_index()
    {
        // F-007: DBクラスを使ってmonitor_boxテーブルから全備品を取得
        // F-012: 備品一覧表示
        $items = \Fuel\Core\DB::select('*')
                                ->from('monitor_box')
                                ->order_by('id', 'asc') // ID順にソート
                                ->execute()
                                ->as_array();

        // ビューにデータを渡す
        $this->template->title = \Fuel\Core\Lang::get('system_name'); // ページのタイトル
        $this->template->content = \Fuel\Core\View::forge('item/index', array(
            'items' => $items,
        ));
    }

    // 後で貸出/返却フォームや処理のメソッドを追加します (action_lend, action_return など)
}