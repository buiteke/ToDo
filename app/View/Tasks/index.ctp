<!-- app/View/Tasks/index.ctp -->
<?php echo $this->Html->css('task'); // CSSを読み込み ?>
<table>
<tr>
<td align="left">
<?php echo $this->Html->link('新規タスク','/Tasks/create',array('class' => 'button'));?>
</td>
<td align="right">
<?php echo $this->Html->link('ログアウト','/Users/logout',array('class' => 'button'));?>
</td>
</tr>
</table>
<div class="round1">

<span class="sorth3">ソート</span>

<ul class="menu">
<li>
<?php echo $this->Form->postButton('　カテゴリ > プライオリティ 順　',array('action' => 'index'),
				array('data' => array('sort_parm' => '1')));?>
</li>
<li>
<?php echo $this->Form->postButton('　プライオリティ > 期限 順　',array('action' => 'index'),
				array('data' => array('sort_parm' => '2')));?>
</li>
<li>
<?php echo $this->Form->postButton('　期限 > プライオリティ 順　',array('action' => 'index'),
				array('data' => array('sort_parm' => '3')));?>
</li>
</ul>
</div>

<div class="round2">
<h3><?php echo count($tasks_data);?>件のタスクが未完了です</h3>
<?php foreach ($tasks_data as $row): ?>
<?php echo $this->element('task',array('task' => $row))?>
<?php endforeach; ?>
</div>
