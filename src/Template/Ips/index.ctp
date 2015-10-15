<?php $this->assign('title', __('IP Administration')) ?>
<?php $this->assign('description', __('Maintain IP settings here.')) ?>
<nav class="navbar" id="actions-sidebar">
    <ul class="nav nav-pills">
        <li><?= $this->Html->link(__('Add new IP range'), ['action' => 'add_range']) ?></li>
    </ul>
</nav>
<div class="ips index large-9 medium-8 columns content">
    <h3><?= __('IPs') ?></h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ip') ?></th>
                <th><?= $this->Paginator->sort('username') ?></th>
                <th><?= __('Description') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ips as $ip): ?>
            <tr>
                <td><?= h($ip->ip) ?></td>
                <td><?= $ip->has('user') ? $this->Html->link($ip->user->name . ' (' . $ip->user->username . ')', ['controller' => 'Users', 'action' => 'edit', $ip->user->id]) : __('not assigned yet') ?></td>
                <td><?= $ip->description ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ip->id], ['class' => 'btn btn-primary btn-xs']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ip->id], ['class' => 'btn btn-primary btn-xs', 'confirm' => __('Are you sure you want to delete # {0}?', $ip->ip)]) ?>
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
