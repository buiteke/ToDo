<?php
// app/Controller/NoteController.php
class NotesController extends AppController {

	//public $scaffold;

	// scaffoldでは統一感がないので、TasksControllerを参考に作り直してみる

        public function create() {

                // POSTされた場合だけ処理を行う
                if ($this->request->is('post')) {
                        $data = array(
                                //'task_id' => $this->request->data['task_id'],
                                'task_id' => $this->request->data['Note']['task_id'],
                                //'body'    => $this->request->data['body']
                                'body'    => $this->request->data['Note']['body']
                        );
                        // データを登録
                        $id = $this->Note->save($data);
                        if ($id === false) { // ifブロックを追加
                                $this->render('create');
                                return;
                        }
                        $msg = sprintf(
                                //'Note　%s　を登録しました。',
                                //$this->Note->id
				// コメント追加時のメッセージを修正
				'タスク %s にコメントを追加しました。',
				$this->request->data['task_id']
                        );

                        // メッセージを表示してリダイレクト
                        $this->Session->setflash($msg);
                        $this->redirect('/Tasks/index');
                        return;
                }
                $this->render('create');
        }

        public function delete() {

		$id = $this->request->pass[0];
		$this->Note->delete($id);

		$msg = sprintf('コメント %s を削除しました。',$id);

		// メッセージを表示してリダイレクト
		$this->Session->setflash($msg);
		$this->redirect('/Tasks/index');
		return;
	}
}

