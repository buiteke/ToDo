<!-- app/View/Tasks/create.ctp -->
<?php echo $this->Html->css('task'); // CSSを読み込み ?>
<div class="roundBox2">
<?php echo $this->Form->create('Task',array('type' => 'post')); ?>
<?php
$options = array('ビジネス' => 'ビジネス', 'パーソナル' => 'パーソナル', 'その他' => 'その他');
echo '<div class="input text required">';
echo $this->Form->label('cat','カテゴリ');
echo '</dev>';
?>

<?php
echo $this->Form->select('Task.category',$options, array('empty' => false, 'label' => 'カテゴリ'));
echo $this->Form->input('Task.name',array('label' => 'タスク名'));
echo $this->Form->input('Task.body',array('label' => '詳細'));
$options = array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5');
echo '<div class="input text required">';
echo $this->Form->label('pri','プライオリティ');
echo $this->Form->select('Task.priority',$options, array('empty' => false, 'label' => 'プライオリティ'));
echo $this->Form->label('due','期限');
echo '</dev>';
echo $this->Form->dateTime('Task.due_date', 'YMD', 'NONE', array('empty' => false, 'minYear' => '2014', 'maxYear' => '2024'));
echo $this->Form->end('タスクを追加');
?>
</div>
