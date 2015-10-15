<?php $this->assign('title', __('Edit your profile')) ?>
<?php $this->assign('description', __('Maintain your account settings here.')) ?>
<nav class="navbar" id="actions-sidebar">
    <ul class="nav nav-pills">
        <li><?= $this->Html->link(__('Back to profile'), ['action' => 'profile']) ?></li>
    </ul>
</nav>
<div class="ips form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
    	<?= $this->Form->input('name', ['class' => 'form-control']); ?>
    </div>
    <div class="form-group">
    	<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>