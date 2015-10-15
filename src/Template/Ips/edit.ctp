<?php $this->assign('title', __('Edit description for') . ' ' . $ip['ip']) ?>
<?php $this->assign('description', __('Maintain your account settings here.')) ?>
<div class="ips form large-9 medium-8 columns content">
    <?= $this->Form->create($ip) ?>
    <div class="form-group">
    	<?= $this->Form->input('description', ['class' => 'form-control', 'placeholder' => __('Enter a description to identify the IP (e.g. Device name)')]); ?>
    </div>
    <div class="form-group">
    	<?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
