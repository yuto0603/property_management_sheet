<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?php echo \Fuel\Core\Asset::css('bootstrap.min.css'); ?>
    <?php echo Asset::css('style.css'); ?> 
    <style>
        body { margin: 50px; }
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card a {
            color: #007bff; /* Bootstrap primary blue */
            text-decoration: underline;
            font-weight: bold;
            font-size: 1.2em;
        }
        .card p {
            margin: 0;
        }
        .navbar .nav-item .nav-link.active {
            background-color: #007bff; /* Active pill color */
            color: white !important;
            border-radius: .25rem;
        }
    </style>
    <?php echo \Fuel\Core\Asset::js('jquery.min.js'); ?>
    <?php echo \Fuel\Core\Asset::js('bootstrap.min.js'); ?>
</head>
<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <a class="navbar-brand" href="<?php echo \Fuel\Core\Uri::base(); ?>"><?php echo \Fuel\Core\Lang::get('system_name'); ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav nav nav-pills mr-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (\Fuel\Core\Uri::segment(1) === 'item' || \Fuel\Core\Uri::segment(1) === null) ? 'active' : ''; ?>" href="<?php echo \Fuel\Core\Uri::base().'items'; ?>">
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
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLang" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo (\Fuel\Core\Config::get('language') === 'ja') ? '日本語' : 'English'; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownLang">
                                <a class="dropdown-item" href="?lang=ja">日本語</a>
                                <a class="dropdown-item" href="?lang=en">English</a>
                            </div>
                        </li>
                        <?php if (\Fuel\Core\Session::get('user_name')): ?>
                            <li class="nav-item">
                                <span class="navbar-text ml-3">
                                    <?php echo \Fuel\Core\Lang::get('logged_in_as'); ?>: <?php echo htmlspecialchars(\Fuel\Core\Session::get('user_name')); ?>
                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="content">
            <?php if (isset($content)) { echo $content; } ?>
        </div>
        <footer>
            <hr>
            <p class="text-center">&copy; <?php echo date('Y'); ?> 貸出備品管理システム</p>
        </footer>
    </div>
</body>
</html>