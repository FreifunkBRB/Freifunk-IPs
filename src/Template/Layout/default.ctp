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

$cakeDescription = 'freifunk-brb.de';
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
     <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
    <style>
      .map {
        height: 400px;
        width: 100%;
      }
    </style>
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
    <?= $this->Html->css('styles.min.css') ?>
    <!--<?= $this->Html->css('cake.css') ?>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
	<?= $this->Html->script('leaflet.fullscreen/Control.FullScreen'); ?>
	<?= $this->Html->css('../js/leaflet.fullscreen/Control.FullScreen.css') ?>
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
          <a class="navbar-brand" href="#">Freifunk Brandenburg an der Havel</a>
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
            <?php else: ?>
            	<li><?= $this->Html->link('login', ['controller' => 'Users', 'action' => 'login']) ?></li>
            <?php endif; ?>	
            <li><?= $this->Html->link(__('map'), ['controller' => 'Ips', 'action' => 'mapView']) ?></li>
            
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
