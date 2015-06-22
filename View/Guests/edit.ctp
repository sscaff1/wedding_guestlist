<div class="guests form">
<?php echo $this->Form->create('Guest'); ?>
	<fieldset>
		<legend><?php echo __('Edit Guest'); ?></legend>
		<?php $g = $this->request->data['Guest'];?>
	<?php
		echo $this->Form->input('id');
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
				'options' => array_combine(range(0,$g['tot_guests'],1), range(0,$g['tot_guests'],1))));
		echo $this->Form->input('tot_maybe',
			array('label' => 'Maybe Attending',
				'options' => array_combine(range(0,$g['tot_guests']-$g['tot_attending'],1), range(0,$g['tot_guests']-$g['tot_attending'],1))));
		echo $this->Form->input('rsvp_rec', array(
			'label' => 'RSVP Received',
			'options' => array('0' => 'No', '1' => 'Yes')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php 
	$data = $this->Js->get('#GuestEditForm')->serializeForm(array('isForm' => true, 'inline' => true));
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