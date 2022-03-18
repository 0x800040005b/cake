<?= $this->Form->create(null, [

    'type' => 'post',
    'url' => 'main/recovery',

]) ?>
<div class="row mb-3">
    <div class="col d-grid gap-2">
        <?= $this->Form->control('password', [

            'class' => 'form-control',
            'type' => 'password',
            'id' => 'password',
            'label' => [
                'class' => 'form-label',
                'id' => 'password-label',
                'for' => 'password',
            ]
        ]) ?>
    </div>
</div>
<div class="row  mb-3">
    <div class="message-error"><?=$this->Flash->render('password_change')?></div>
</div>

<div class="row mb-3">
    <div class="col d-grid gap-2">
        <?=$this->Form->button(__('Change password'),['class' => 'btn btn-success btn-lg'])?>
    </div>
</div>




<?= $this->Form->end() ?>