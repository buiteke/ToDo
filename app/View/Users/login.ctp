<?php echo $this->Html->css('task'); // CSSを読み込み ?>
<div class="roundBox">
<?php
echo $this->Form->create('User');
echo $this->Form->input('User.username',array('label' => 'ユーザ名'));
echo $this->Form->input('User.password',array('label' => 'パスワード'));
echo $this->Form->end('ログイン');
?>
</div>
