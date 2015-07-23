<!-- app/View/Elements/task.ctp -->
<?php echo $this->Html->css('task'); // CSSを読み込み ?>

<?php
	if($task['Task']['id'] % 5 == 0){ ?>
<div class="roundBox1">
	<?php }else if($task['Task']['id'] % 5 == 1){ ?>
<div class="roundBox2">
	<?php }else if($task['Task']['id'] % 5 == 2){ ?>
<div class="roundBox3">
	<?php }else if($task['Task']['id'] % 5 == 3){ ?>
<div class="roundBox4">
	<?php }else if($task['Task']['id'] % 5 == 4){ ?>
<div class="roundBox5">
	<?php } ?>

<h3><?php echo h($task['Task']['id']);?>

<?php echo h($task['Task']['name']);?></h3>
<!--作成日<?php echo h($task['Task']['created']);?>-->

<font size="3" color="red">
カテゴリ：&nbsp;<b><?php echo h($task['Task']['category']);?></b>
&nbsp;&nbsp;&nbsp;
<br>
プライオリティ：&nbsp;<b><?php echo h($task['Task']['priority']);?></b>
&nbsp;&nbsp;&nbsp;
<br>
期限：&nbsp;<b><?php echo substr(h($task['Task']['due_date']),0,10);?></b>
</font>

<p class="comment">
<ul>
<?php foreach ($task['Note'] as $note): ?>
<li><?php echo h($note['body']);?>&nbsp;
<!-- コメント削除用のアイコン追加 -->
<?php echo $this->Html->image('batu.jpg',array(
				'alt' => '削除',
				'url' => array('controller' => 'Notes', 'action' => 'delete', $note['id'])
				));?>
</li>
<?php endforeach; ?>
<li><?php echo $this->Html->link(
	'コメントを追加',
	//'/Notes/create'
	// コメント追加のために、タスクのidを渡す
	'/Notes/create/'.$task['Task']['id']
);?></li>
</ul></p>

<?php echo $this->Html->link(
	'編集',
	'/Tasks/edit/'.$task['Task']['id'],
	array('class' => 'button left')
);?>

<?php echo $this->Html->link(
	//'このタスクを完了する',
	'完了',
	'/Tasks/done/'.$task['Task']['id'],
	array('class' => 'button right')
);?>
</div>
