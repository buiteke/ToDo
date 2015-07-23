<!-- app/View/Notes/create.ctp -->
<?php echo $this->Html->css('task'); // CSSを読み込み ?>
<div class="roundBox">
<?php echo $this->Form->create('Note',array('type' => 'post')); ?>
<?php
echo $this->Form->hidden('task_id',array('value' => $this->request->pass[0]));
echo $this->Form->input('Note.body',array('label' => 'コメント'));
echo $this->Form->end('コメントを追加');
?>
</div>
