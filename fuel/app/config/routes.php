<?php
return array(
    '_root_'  => 'item/index',
    '_404_'   => 'welcome/404', // デフォルトの404ルート

    'items' => 'item/index',
    'items/lend/(:id)' => 'item/lend/$1',
    'items/return/(:id)' => 'item/return/$1',
    'history' => 'item/history',
    'items/create' => 'item/create',
);