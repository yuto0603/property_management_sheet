<div class="container">
    <h2 class="mb-4"><?php echo \Fuel\Core\Lang::get('item_list_title'); ?></h2>
    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="col-md-2 col-sm-3 col-xs-4 mb-3">
                <div class="card text-center p-3">
                    <?php if ($item['status'] === '貸出中'): ?>
                        <p class="mb-0">
                            <a href="<?php echo \Fuel\Core\Uri::base().'items/return/'.$item['id']; ?>" style="color: red; text-decoration: underline;">
                                <?php echo htmlspecialchars($item['current_user']); ?><?php echo \Fuel\Core\Lang::get('in_use'); ?>
                            </a>
                        </p>
                    <?php else: ?>
                        <p class="mb-0">
                            <a href="<?php echo \Fuel\Core\Uri::base().'items/lend/'.$item['id']; ?>">
                                <?php echo htmlspecialchars($item['label']); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>