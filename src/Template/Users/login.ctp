<!-- File: src/Template/Users/login.ctp -->
<?php $this->assign('title', __('Welcome')) ?>
<?php $this->assign('description', __('Please log in.')) ?>
<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email address and password') ?></legend>
        <div class="form-group">
        	<?= $this->Form->input('username', ['label' => __('Email address'),  'class' => 'form-control']) ?>
        </div>
        <div class="form-group">
        	<?= $this->Form->input('password', ['class' => 'form-control']) ?>
        </div>
 		 <div class="form-group">
    	<?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary']); ?>	
		</div>
		<?= __("You don't have an account yet?") ?> <?= $this->Html->link(__('Register here'), ['action' => 'register']) ?>
<?= $this->Form->end() ?>
</div>