<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title : '貸出備品管理システム'; ?></title>
    <?php echo Asset::css('style.css'); ?> 
</head>
<body>
    <div class="wrapper">
        <header class="main-header">
            <div class="header-content">
                <h1 class="site-title"><?php echo Lang::get('common.monitor_title'); ?></h1>
                <nav class="main-nav">
                    <a href="<?php echo \Fuel\Core\Uri::base().'history'; ?>" class="nav-button history-button"><?php echo Lang::get('common.history_button'); ?></a>
                    <a href="<?php echo \Fuel\Core\Uri::base().'items/create'; ?>" class="nav-button new-item-button"><?php echo \Fuel\Core\Lang::get('common.new_item_button'); ?></a>
                </nav>
            </div>
        </header>

        <main class="main-content">
            <?php echo isset($content) ? $content : ''; ?>
        </main>

        <footer class="main-footer">
            <p>&copy; <?php echo date('Y'); ?> <?php echo \Fuel\Core\Lang::get('system_name'); ?></p>
        </footer>
    </div>

</body>
</html>