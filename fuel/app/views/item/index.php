<div class="monitor-grid">
    <?php foreach ($monitors as $monitor): ?>
        <div class="monitor-block">
            <div class="monitor-content">
                <?php if ($monitor['status'] === '貸出中'): ?>
                    <div class="monitor-status in-use">
                        <a href="<?php echo \Fuel\Core\Uri::base().'items/return/'.$monitor['id']; ?>" class="monitor-return-link">
                            <span class="current-user"><?= htmlspecialchars($monitor['current_user']) ?></span><br>
                            <span class="status-text"><?php echo \Fuel\Core\Lang::get('common.in_use'); ?></span>
                        </a>
                        <button type="button" class="return-button">返却</button>
                    </div>
                <?php else: ?>
                    <div class="monitor-status available">
                        <a href="<?php echo \Fuel\Core\Uri::base().'items/lend/'.$monitor['id']; ?>" class="monitor-label-link">
                            <span class="monitor-label"><?= htmlspecialchars($monitor['label']) ?></span>
                        </a>
                        <span class="status-text-available"><?php echo \Fuel\Core\Lang::get('available', array(), '空き'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>