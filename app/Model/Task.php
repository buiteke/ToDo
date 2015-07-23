<?php
// app/Model/Task.php
class Task extends AppModel {

	//public $hasMany = array('Note');
	// コメントを作成日の昇順に表示する
	public $hasMany = array(
			'Note' => array('order' => array('Note.created ASC'))
			);

	public $validate = array(
		'name' => array(
			'rule' => array('maxlength',60),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'タスク名を入力してください'
		),
		'body' => array(
			'rule' => array('maxlength',255),
			'required' => true,
			'allowEmpty' => false,
			'message' => '詳細を入力してください'
		)
	);
}

