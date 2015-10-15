<?php $this->assign('title', __('Edit user') . ' ' . $user['username']) ?>
<?php $this->assign('description', __('Maintain account settings here.')) ?>
<nav class="navbar" id="actions-sidebar">
    <ul class="nav nav-pills">
        <li><?= $this->Html->link(__('Back to index'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ips form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <div class="form-group">
    	<?= $this->Form->input('username', ['label' => __('Email address'), 'class' => 'form-control']); ?>
    	<?= $this->Form->input('name', ['class' => 'form-control']); ?>
    	<?= $this->Form->input('role', ['type' => 'select', 'options' => ['admin' => 'Admin', 'user' => 'User'], 'class' => 'form-control']) ?>
    	<?= $this->Form->input('max_ips', ['class' => 'form-control']); ?>
    </div>
    <div class="form-group">
    	<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?= $this->Form->end() ?>
    <?php if (!empty($user->ips)): ?>
        <table class="table table-bordered table-striped">
            <tr>
                <th><?= __('Freifunk IP') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->ips as $ips): ?>
            <tr>
                <td><?= h($ips->ip) ?></td>
                <td><?= h($ips->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit Description'), ['controller' => 'Ips', 'action' => 'edit', $ips->id], ['class' => 'btn btn-xs btn-primary']) ?>
                    <?= $this->Form->postLink(__('Release IP'), ['controller' => 'Ips', 'action' => 'release', $ips->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => __('Are you sure you want to release {0}?', $ips->ip)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
   	<?php endif; ?>
</div>