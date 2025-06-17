<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title : \Fuel\Core\Lang::get('system_name'); ?></title>
    <?php echo \Fuel\Core\Asset::css('bootstrap.min.css'); ?>
    <?php echo Asset::css('style.css'); ?> 
</head>
<body>
    <div class="container">
        <header class="mb-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-lg shadow-sm">
                <a class="navbar-brand" href="<?php echo \Fuel\Core\Uri::base(); ?>"><?php echo \Fuel\Core\Lang::get('system_name'); ?></a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav nav nav-pills mr-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (\Fuel\Core\Uri::segment(1) === 'item' || \Fuel\Core\Uri::segment(1) === null || \Fuel\Core\Uri::segment(1) === 'items') ? 'active' : ''; ?>" href="<?php echo \Fuel\Core\Uri::base().'items'; ?>">
                                <?php echo \Fuel\Core\Lang::get('menu.item_list'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (\Fuel\Core\Uri::segment(1) === 'history') ? 'active' : ''; ?>" href="<?php echo \Fuel\Core\Uri::base().'history'; ?>">
                                <?php echo \Fuel\Core\Lang::get('menu.history'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (\Fuel\Core\Uri::segment(1) === 'admin') ? 'active' : ''; ?>" href="<?php echo \Fuel\Core\Uri::base().'admin'; ?>">
                                <?php echo \Fuel\Core\Lang::get('menu.admin_panel'); ?>
                            </a>
                        </li>
                    </ul>
                    
                    <?php if (\Fuel\Core\Session::get('user_name')): ?>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <span class="navbar-text ml-3">
                                    <?php echo \Fuel\Core\Lang::get('logged_in_as'); ?>: <?php echo htmlspecialchars(\Fuel\Core\Session::get('user_name')); ?>
                                </span>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                <h1><?php echo Lang::get('common.monitor_title'); ?></h1>
                <div class="action-buttons">
                    <a href="<?php echo \Fuel\Core\Uri::base().'history'; ?>" class="btn btn-primary mr-2"><?php echo Lang::get('common.history_button'); ?></a>
                    <a href="<?php echo \Fuel\Core\Uri::base().'items/create'; ?>" class="btn btn-success"><?php echo \Fuel\Core\Lang::get('common.new_item_button'); ?></a>
                </div>
            </div>
        </header>

        <main>
            <?php echo isset($content) ? $content : ''; ?>
        </main>

        <footer class="mt-5 text-center text-muted">
            <p>&copy; <?php echo date('Y'); ?> <?php echo \Fuel\Core\Lang::get('system_name'); ?></p>
        </footer>
    </div>

    <?php echo \Fuel\Core\Asset::js('jquery.min.js'); ?>
    <?php echo \Fuel\Core\Asset::js('bootstrap.bundle.min.js'); ?>
</body>
</html>