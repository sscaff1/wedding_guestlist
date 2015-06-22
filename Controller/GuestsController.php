<?php
App::uses('AppController', 'Controller');
/**
 * Guests Controller
 *
 * @property Guest $Guest
 * @property PaginatorComponent $Paginator
 */
class GuestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Guest->recursive = 0;
		$temp = $this->Guest->find('all',
			array('fields' => array('SUM(Guest.tot_maybe) as maybe ', 'SUM(Guest.tot_attending) as yes', 
			'SUM(Guest.tot_guests - Guest.tot_attending - Guest.tot_maybe) as tot_not')
		));
		$metrics = array('Maybe' => 0, 'Yes' => 0);
		foreach ($temp as $i) {
			$metrics["No"] = $i['0']['tot_not']; 
			$metrics["Yes"] = $i['0']['yes'];
			$metrics["Maybe"] = $i['0']['maybe'];
		}
		$this->set(compact('metrics'));
		$this->set('guests', $this->Paginator->paginate());
	}
	
	public function update_attending() {
		$this->set('options', array_combine(range(0,$this->request->data['Guest']['tot_guests'],1), 
				range(0,$this->request->data['Guest']['tot_guests'],1)));
		$this->layout = 'ajax';
	}
	
	public function update_maybe() {
		$guests = $this->request->data['Guest'];
		$this->set('options', array_combine(range(0,$guests['tot_guests']-$guests['tot_attending'],1),
				range(0,$guests['tot_guests']-$guests['tot_attending'],1)));
		$this->layout = 'ajax';
	}
	
	public function update_rsvp() {
		if ($this->request->is('post')) {
			$this->Guest->id = $this->request->data['Guest']['id'];
			$this->Guest->saveField('rsvp_rec',$this->request->data['Guest']['rsvp_rec']);
		}
		$this->layout = 'ajax';
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Guest->exists($id)) {
			throw new NotFoundException(__('Invalid guest'));
		}
		$options = array('conditions' => array('Guest.' . $this->Guest->primaryKey => $id));
		$this->set('guest', $this->Guest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Guest->create();
			if ($this->Guest->save($this->request->data)) {
				$this->Session->setFlash(__('The guest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The guest could not be saved. Please, try again.'));
			}
		}
		$states = $this->Guest->State->find('list');
		$this->set(compact('states'));
	}
	
	public function copy($guest_id) {
		if ($this->request->is('post')) {
			$this->Guest->create();
			if ($this->Guest->save($this->request->data)) {
				$this->Session->setFlash(__('The guest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The guest could not be saved. Please, try again.'));
			}
		}
		$guest = $this->Guest->findById($guest_id);
		$states = $this->Guest->State->find('list');
		$this->set(compact('states', 'guest'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Guest->exists($id)) {
			throw new NotFoundException(__('Invalid guest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Guest->save($this->request->data)) {
				$this->Session->setFlash(__('The guest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The guest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Guest.' . $this->Guest->primaryKey => $id));
			$this->request->data = $this->Guest->find('first', $options);
		}
		$states = $this->Guest->State->find('list');
		$this->set(compact('states'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Guest->id = $id;
		if (!$this->Guest->exists()) {
			throw new NotFoundException(__('Invalid guest'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Guest->delete()) {
			$this->Session->setFlash(__('The guest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The guest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
