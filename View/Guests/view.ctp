<div class="guests view">
<h2><?php echo __('Guest'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($guest['State']['name'], array('controller' => 'states', 'action' => 'view', $guest['State']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip Code'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['zip_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attending'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['attending']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($guest['Guest']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Guest'), array('action' => 'edit', $guest['Guest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Guest'), array('action' => 'delete', $guest['Guest']['id']), array(), __('Are you sure you want to delete # %s?', $guest['Guest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Guests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Guest'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
	</ul>
</div>
