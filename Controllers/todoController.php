<?php

namespace Controllers;

use RestClient\Request;
use Models\Entry;

class todoController extends Request {

	public function index(){
		return $this->view('todo/index',array(
			'entries' => Entry::all()
		));
	}

	public function add(){
		return $this->view('todo/add');
	}

	public function edit($id){
		return $this->view('todo/edit',array(
			'entry' => Entry::find($id)
		));
	}

	public function save(){
		$entry = new Entry;
		$entry->title = $this->post('title');
		$entry->status = 1;
		$entry->save();

		$this->redirect('todo');
	}

	public function update(){
		$entry = Entry::find($this->post('id'));		
		$entry->title = $this->post('title');
		$entry->save();

		$this->redirect('todo');
	}

	public function remove($id){
		$entry = Entry::find($id);
		$entry->delete();
		
		$this->redirectBack();
	}

}