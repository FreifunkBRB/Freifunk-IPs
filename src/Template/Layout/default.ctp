<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!--<?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<!-- Fixed navbar -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">freifunk-brb.de</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          	<?php if ($authUser): ?>
          		
          	<li><?= $this->Html->link(__('Your profile'), ['controller' => 'Users', 'action' => 'profile']) ?></li>
          	<?php if ($authUser['role'] == 'admin'): ?> 
          		<li><?= $this->Html->link('IP addresses', ['controller' => 'Ips', 'action' => 'index']) ?></li>
          		<li><?= $this->Html->link('Users', ['controller' => 'Users', 'action' => 'index']) ?></li>
          	<?php endif; ?>
            
            <li><?= $this->Html->link('logout', ['controller' => 'Users', 'action' => 'logout']) ?></li>
            <?php endif ?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    <div class="container theme-showcase">
    	<?= $this->Flash->render() ?>
    	<div class="jumbotron">
        <h1><?= $this->fetch('title') ?></h1>
        <p><?= $this->fetch('description') ?></p>
      </div>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
