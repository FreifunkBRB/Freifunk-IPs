<?php $this->assign('title', __('Add IP ranges')) ?>
<?php $this->assign('description', __('Add new IP ranges here.')) ?>
<?php list($ip_a, $ip_b, $ip_c, $ip_d) = explode('.', $current_max->ip); ?>
<div class="ips form-inline">
    <?= $this->Form->create($ip) ?>
	<div class="row">
		<div class="col-md-12">
			<?= __('IP Adress range from') ?>
	        <?= $this->Form->input('a_from', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_a]) ?>
	        <?= $this->Form->input('b_from', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_b]) ?>
	        <?= $this->Form->input('c_from', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_c]) ?>
	        <?= $this->Form->input('d_from', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_d + 1]) ?>
        </div>
    </div>
    <div class="row">
		<div class="col-md-12">
			<?= __('to') ?>
	        <?= $this->Form->input('a_to', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_a]) ?>
	        <?= $this->Form->input('b_to', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_b]) ?>
	        <?= $this->Form->input('c_to', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_c]) ?>
	        <?= $this->Form->input('d_to', ['class' => 'form-control inline col-xs-1', 'maxlength' => 3, 'label' => false, 'value' => $ip_d + 1]) ?>
        </div>
    </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php pr($current_max); ?>
