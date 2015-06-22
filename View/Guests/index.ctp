<style>h4 { display: inline-block; margin-right: 5px; }
.metric { margin-right:50px; }</style>
<div class="guests index">
	<h2><?php echo __('Guests'); ?></h2>
	<span class="metric"><h4>Attending: </h4><?php echo $metrics['Yes']?></span>
	<span class="metric"><h4>Not Attending: </h4><?php echo $metrics['No']?></span>
	<span class="metric"><h4>Maybe: </h4><?php echo $metrics['Maybe']?></span>
	<br />
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>	
			<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('tot_guests', 'Total Guests');?>
			<th><?php echo $this->Paginator->sort('tot_attending', 'Attending');?>
			<th><?php echo $this->Paginator->sort('tot_maybe', 'Maybe Attending'); ?></th>
			<th><?php echo 'RSVP Received'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($guests as $guest): ?>
	<tr>
		<td><?php echo $guest['Guest']['id']; ?></td>
		<td><?php echo h($guest['Guest']['name']); ?>&nbsp;</td>
		<td><?php echo $guest['Guest']['address']."<br />".
		$guest['Guest']['city'].', '.$guest['State']['short_name'].' '.$guest['Guest']['zip_code']; ?>&nbsp;</td>
		<td><?php echo $guest['Guest']['tot_guests'];?></td>
		<td><?php echo $guest['Guest']['tot_attending'];?></td>
		<td><?php echo $guest['Guest']['tot_maybe']?></td>
		<td><?php echo $this->Form->create('Guest', array('id' => 'GuestIndexForm'.$guest['Guest']['id']));
			echo $this->Form->input('id', array('value' => $guest['Guest']['id']));
			echo $this->Form->input('rsvp_rec', array('label' => false,
					'type' => 'checkbox',
					'default' => $guest['Guest']['rsvp_rec'],
					'id' => 'GuestRsvpRec'.$guest['Guest']['id'])); ?></td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $guest['Guest']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $guest['Guest']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $guest['Guest']['id']), array(), __('Are you sure you want to delete # %s?', $guest['Guest']['id'])); ?>
			<?php //echo $this->Html->link('Copy', array('action' => 'copy', $guest['Guest']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<?php
	foreach ($guests as $g) { 
		$data = $this->Js->get('#GuestIndexForm'.$g['Guest']['id'])->serializeForm(array('isForm' => true, 'inline' => true));
		$this->Js->get('#GuestRsvpRec'.$g['Guest']['id'])->event('change',
				$this->Js->request(array(
					'controller'=>'guests',
					'action'=>'update_rsvp'
				), array(
					'async' => true,
					'method' => 'post',
					'dataExpression'=>true,
					'data'=> $data
				))
			);
	}
?>