<div class="guests form">
<?php echo $this->Form->create('Guest'); ?>
	<fieldset>
		<legend><?php echo __('Add Guest'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('state_id',
			array('empty' => '--'));
		echo $this->Form->input('zip_code');
		echo $this->Form->input('tot_guests',
			array('label' => 'Total Guests',
				'empty' => '--',
				'options' => array_combine(range(1,10,1), range(1,10,1))));
		echo $this->Form->input('tot_attending',
			array('label' => 'Attending',
				'empty' => '--',
				'type' => 'select'));
		echo $this->Form->input('tot_maybe',
			array('label' => 'Maybe Attending',
				'empty' => '--',
				'type' => 'select'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php 
	$data = $this->Js->get('#GuestAddForm')->serializeForm(array('isForm' => true, 'inline' => true));
	$this->Js->get('#GuestTotGuests')->event('change',
			$this->Js->request(array(
				'controller'=>'guests',
				'action'=>'update_attending'
			), array(
				'update'=>'#GuestTotAttending',
				'async' => true,
				'method' => 'post',
				'dataExpression'=>true,
				'data'=> $data
			))
		);
	$this->Js->get('#GuestTotAttending')->event('change',
			$this->Js->request(array(
				'controller'=>'guests',
				'action'=>'update_maybe'
			), array(
				'update'=>'#GuestTotMaybe',
				'async' => true,
				'method' => 'post',
				'dataExpression'=>true,
				'data'=> $data
			))
		);
?>