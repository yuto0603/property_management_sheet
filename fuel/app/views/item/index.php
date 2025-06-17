<div class="container my-4">
    <div class="row five-column-grid">
        <?php foreach ($monitors as $monitor): ?>
            <div class="col-five-grid"> 
                <div class="card h-100 shadow-sm border-0 rounded-lg">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-3">
                        <?php if ($monitor['status'] === '貸出中'): ?>
                            <h4 class="card-title mb-0">
                                <a href="<?php echo \Fuel\Core\Uri::base().'items/return/'.$monitor['id']; ?>" class="item-label text-danger">
                                    <?= htmlspecialchars($monitor['current_user']) ?><br><?php echo \Fuel\Core\Lang::get('common.in_use'); ?>
                                </a>
                            </h4>
                            <p class="mt-2 mb-0 text-muted">
                                (<?= htmlspecialchars($monitor['label']) ?>)
                            </p>
                        <?php else: ?>
                            <h4 class="card-title mb-0">
                                <a href="<?php echo \Fuel\Core\Uri::base().'items/lend/'.$monitor['id']; ?>" class="item-label text-primary">
                                    <?= htmlspecialchars($monitor['label']) ?>
                                </a>
                            </h4>
                            <p class="mt-2 mb-0 text-muted">
                                **<?php echo \Fuel\Core\Lang::get('available', array(), '空き', 'ja'); ?> / <?php echo \Fuel\Core\Lang::get('available', array(), 'Available', 'en'); ?>**
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>