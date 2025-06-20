<div class="lend-form-wrapper">
    <div class="lend-form-container">
        <h2 class="form-title"><?php echo \Fuel\Core\Lang::get('common.lend_item_title'); ?></h2>
        <p class="form-description"><?php echo \Fuel\Core\Lang::get('common.lend_item_description', array('label' => $monitor['label'])); ?></p>

        <?php if (\Session::get_flash('error')): ?>
            <div class="message-box error-message">
                <?php echo \Session::get_flash('error'); ?>
            </div>
        <?php endif; ?>

        <?php if (\Session::get_flash('success')): ?>
            <div class="message-box success-message">
                <?php echo \Session::get_flash('success'); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo \Fuel\Core\Uri::base().'items/process_lend'; ?>" method="post" class="lend-form">
            <div class="form-group">
                <label for="user_name" class="form-label"><?php echo \Fuel\Core\Lang::get('common.your_name'); ?></label>
                <input type="text" class="form-input" id="user_name" name="user_name" required autofocus>
            </div>
            <input type="hidden" name="monitor_id" value="<?php echo $monitor['id']; ?>">
            <div class="form-actions">
                <button type="submit" class="button primary-button lend-button"><?php echo \Fuel\Core\Lang::get('common.lend_button'); ?></button>
                <a href="<?php echo \Fuel\Core\Uri::base().'items'; ?>" class="button secondary-button cancel-button"><?php echo \Fuel\Core\Lang::get('common.cancel_button'); ?></a>
            </div>
        </form>
    </div>
</div>