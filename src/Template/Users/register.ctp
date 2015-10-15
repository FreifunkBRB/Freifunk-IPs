<?php $this->assign('title', __('Create account') . ' ' . $user['username']) ?>
<?php $this->assign('description', __('Create your user profile')) ?>
<nav class="navbar" id="actions-sidebar">
    <ul class="nav nav-pills">
        <li><?= $this->Html->link(__('Back to login'), ['action' => 'login']) ?></li>
    </ul>
</nav>
<div class="ips form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
    	<?= $this->Form->input('username', ['label' => __('Email address'), 'class' => 'form-control']); ?>
    	<?= $this->Form->input('name', ['class' => 'form-control']); ?>
    	<?= $this->Form->input('password', ['class' => 'form-control']); ?>
		<?= $this->Form->input('confirm_password', ['label' => __('Confirm password'), 'type' => 'password', 'class' => 'form-control']); ?>
    </div>
    <div class="form-group">
    	<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>