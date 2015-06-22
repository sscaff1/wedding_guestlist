<div class="guests form">
<?php echo $this->Form->create('Guest'); ?>
	<fieldset>
		<legend><?php echo __('Add Guest'); ?></legend>
	<?php
		echo $this->Form->input('first_name',
			array('value' => $guest['Guest']['first_name']));
		echo $this->Form->input('last_name',
			array('value' => $guest['Guest']['last_name']));
		echo $this->Form->input('address',
			array('value' => $guest['Guest']['address']));
		echo $this->Form->input('city',
			array('value' => $guest['Guest']['city']));
		echo $this->Form->input('state_id',
			array('empty' => '--',
			'value' => $guest['Guest']['state_id']));
		echo $this->Form->input('zip_code',
			array('value' => $guest['Guest']['zip_code']));
		echo $this->Form->input('attending',
				array('empty' => '--',
					'options' => array('Yes' => 'Yes', 'No' => 'No', 'Maybe' => 'Maybe')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Guests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
	</ul>
</div>
