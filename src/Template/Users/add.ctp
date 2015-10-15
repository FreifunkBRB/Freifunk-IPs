<?php $this->assign('title', __('Add user')) ?>
<nav class="navbar" id="actions-sidebar">
    <ul class="nav nav-pills">
        <li><?= $this->Html->link(__('Back to index'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('username', ['class' => 'form-control']);
			echo $this->Form->input('name', ['class' => 'form-control']);
            echo $this->Form->input('password', ['class' => 'form-control']);
			echo $this->Form->input('confirm_password', ['label' => __('Confirm password'), 'type' => 'password', 'class' => 'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
