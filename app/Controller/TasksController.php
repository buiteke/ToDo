<?php
// app/Controller/TasksController.php
class TasksController extends AppController {

	// 動作確認のためにscaffoldを使う
	//public $scaffold;

	public function index() {

		if ($this->request->is('post')) {
			//echo "data['sort_parm'] = ".$this->request->data['sort_parm'];
			switch ($this->request->data['sort_parm']) {
				case 1:
					// カテゴリ＞プライオリティの昇順
					$order_by = 'Task.category ASC, Task.priority ASC';
					break;
				case 2:
					// プライオリティ＞期限の昇順
					$order_by = 'Task.priority ASC, Task.due_date ASC';
					break;
				case 3:
					// 期限＞プライオリティの昇順
					$order_by = 'Task.due_date ASC, Task.priority ASC';
					break;
				default:
					// デフォルトは作成日の昇順
					$order_by = 'Task.created ASC';
			}			
		} else {
			$order_by = 'Task.created ASC';
		}

		// データをモデルから取得してビューへ渡す
		$options = array(
			'conditions' => array(
				'Task.status' => 0
			),
			// 作成日の昇順に表示する
			//'order' => array('Task.created ASC')
			// 指示された項目の並び順に表示する
			'order' => array($order_by)
		);

		$tasks_data = $this->Task->find('all', $options);
		$this->set('tasks_data', $tasks_data);

		// app/View/Tasks/index.ctpを表示
		$this->render('index');
	}

	public function done() {

		// URLの末尾からタスクのIDを取得してステータス更新
		$id = $this->request->pass[0];
		$this->Task->id = $id;
		$this->Task->saveField('status',1);
		//$msg = sprintf('タスク　%s　を完了しました。', $id);

		// タスク名を取得する
		$options = array('conditions' => array('Task.id' => $id));
		$task = $this->Task->find('first',$options);

		// タスクの完了をTwitterにつぶやく
		$tweet = 'タスク「' . $task['Task']['name'] . '」が終了しました。お疲れ～～(^^)/';
		$this->_tweet($tweet);

		// メッセージを編集する
		$msg = 'タスク　'. $id . '　「' . $task['Task']['name'] . '」を完了しました。';
		
		// メッセージを表示してリダイレクト
		//$this->flash($msg,'/Tasks/index');
		$this->Session->setflash($msg);
		$this->redirect('/Tasks/index');
	}

	public function create() {

		// POSTされた場合だけ処理を行う
		if ($this->request->is('post')) {
			$data = array(
				'category' => $this->request->data['Task']['category'],
				'name' => $this->request->data['Task']['name'],
				'body' => $this->request->data['Task']['body'],
				'priority' => $this->request->data['Task']['priority'],
				'due_date' => $this->request->data['Task']['due_date'],
			);
			// データを登録
			$id = $this->Task->save($data);
			if ($id === false) { // ifブロックを追加
				$this->render('create');
				return;
			}
			$msg = sprintf(
				'タスク　%s　を登録しました。',
				$this->Task->id
			);

			// メッセージを表示してリダイレクト
			//$this->flash($msg,'/Tasks/index');
			$this->Session->setflash($msg);
			$this->redirect('/Tasks/index');
			return;
		}
		$this->render('create');
	}

	public function edit() {
		// 指定されたタスクのデータを取得
		$id = $this->request->pass[0];
		$options = array(
			'conditions' => array(
				'Task.id' => $id,
				'Task.status' => 0
			)
		);
		$task = $this->Task->find('first',$options);

		// データが見つからない場合は一覧へ
		if ($task == false) {
			$this->Session->setFlash('タスクが見つかりません');
			$this->redirect('/Tasks/index');
		}

		// フォームが送信された場合は更新にトライ
		if ($this->request->is('post')) {
			$data = array(
				'id' => $id,
				'category' => $this->request->data['Task']['category'],
				'name' => $this->request->data['Task']['name'],
				'body' => $this->request->data['Task']['body'],
				'priority' => $this->request->data['Task']['priority'],
				'due_date' => $this->request->data['Task']['due_date'],
			);
			if ($this->Task->save($data)) {
				$this->Session->setFlash('更新しました');
				$this->redirect('/Tasks/index');
			}
		} else {
			// POSTされていない場合は初期データをフォームにセット
			$this->request->data = $task;
		}
	}

}
