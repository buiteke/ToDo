<?php
// app/Model/Note.php
class Note extends AppModel {

	public $belongsTo = array('Task');

        public $validate = array(
                'body' => array(
                        'rule' => array('maxlength',255),
                        'required' => true,
                        'allowEmpty' => false,
                        'message' => 'コメントを入力してください'
                )
        );

}
