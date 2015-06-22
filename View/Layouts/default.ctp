
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Wedding Guests List
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom_wedding');
		echo $this->Html->script('jquery');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Christie & Steven Guest List</h1>
		</div>
		<div id="content">
			<div class="main-menu">
				<?php echo $this->Html->link('View Guest List', array('controller' => 'guests', 'action' => 'index')); ?>
				<?php echo $this->Html->link('Add Guest', array('controller' => 'guests', 'action' => 'add')); ?>
			</div>
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			Developed by Tela Edge, LLC
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
<?php echo $this->Js->writeBuffer(); ?>
</html>
