<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ip'), ['action' => 'edit', $ip->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ip'), ['action' => 'delete', $ip->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ip->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ips'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ip'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ips view large-9 medium-8 columns content">
    <h3><?= h($ip->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $ip->has('user') ? $this->Html->link($ip->user->id, ['controller' => 'Users', 'action' => 'view', $ip->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($ip->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Net A') ?></th>
            <td><?= $this->Number->format($ip->net_a) ?></td>
        </tr>
        <tr>
            <th><?= __('Net B') ?></th>
            <td><?= $this->Number->format($ip->net_b) ?></td>
        </tr>
        <tr>
            <th><?= __('Net C') ?></th>
            <td><?= $this->Number->format($ip->net_c) ?></td>
        </tr>
        <tr>
            <th><?= __('Net D') ?></th>
            <td><?= $this->Number->format($ip->net_d) ?></td>
        </tr>
    </table>
</div>
