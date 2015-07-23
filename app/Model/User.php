<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

	public $validate = array(
		'username' => array(
		'required' => array(
			'rule' => array('notEmpty'),
			//'message' => 'A username is required'
			'message' => 'ユーザ名を入力してください。'
			)
		),
		'password' => array(
		'required' => array(
			'rule' => array('notEmpty'),
			//'message' => 'A password is required'
			'message' => 'パスワードを入力してください。'
			)
		),
		'role' => array(
		'valid' => array(
			'rule' => array('inList', array('admin', 'author')),
			//'message' => 'Please enter a valid role',
			'message' => 'ロールを入力してください。',
			'allowEmpty' => false
			)
		)
	);

//パスワードのハッシュ化に対応する

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}

}
