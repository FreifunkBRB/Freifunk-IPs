<?php $this->assign('title', __('Reset password')) ?>
<?php $this->assign('description', __('Create a new password for {0}', $user->name)) ?>
<nav class="navbar" id="actions-sidebar">
    <ul class="nav nav-pills">
    	<?php if ($authUser['role'] == 'admin'): ?>
        <li><?= $this->Html->link(__('Back to index'), ['action' => 'index']) ?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('Back to profile'), ['action' => 'profile']) ?></li>
    </ul>
</nav>
<div class="ips form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
    	<?php
    		echo $this->Form->input('password', ['class' => 'form-control']);
			echo $this->Form->input('confirm_password', ['label' => __('Confirm password'), 'type' => 'password', 'class' => 'form-control']);
		?>
    </div>
    <div class="form-group">
    	<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>