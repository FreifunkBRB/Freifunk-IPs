<?php $this->assign('title', __('User Administration')) ?>
<?php $this->assign('description', __('Maintain user settings here.')) ?>
<nav class="navbar" id="actions-sidebar">
    <ul class="nav nav-pills">
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
            	<th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= $this->Paginator->sort('role') ?></th>
                <th><?= $this->Paginator->sort('max_ips') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
            	<td><?= h($user->name) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->role) ?></td>
                <td><?= h($user->max_ips) ?></td>
                <td class="actions">
                	<?= $this->Html->link(__('Reset password'), ['action' => 'reset_password', $user->id], ['class' => 'btn btn-xs btn-primary']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-xs btn-primary']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['class' => 'btn btn-xs btn-danger', 'confirm' => __('Are you sure you want to delete {0}?', $user->username)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
