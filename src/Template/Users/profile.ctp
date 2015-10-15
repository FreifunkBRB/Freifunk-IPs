<?php $this->assign('title', __('Your Profile')) ?>
<?php $this->assign('description', __('Maintain your account settings here.')) ?>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name . ' (' . $user->username . ')') ?></h3>
    <nav class="navbar" id="actions-sidebar">
	    <ul class="nav nav-pills">
	        <li><?= $this->Html->link(__('Change password'), ['action' => 'reset_password']) ?></li>
	        <li><?= $this->Html->link(__('Edit your profile'), ['action' => 'edit_profile']) ?></li>
	    </ul>
	</nav>
    <div class="related">
        <h4><?= __('Your IPs') ?></h4>
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
   		<div class="actions">
   			<?= $this->Html->link(__('Get an IP'), ['controller' => 'Ips', 'action' => 'request'], ['class' => 'btn btn-primary']) ?>
   		</div>
    </div>
</div>
