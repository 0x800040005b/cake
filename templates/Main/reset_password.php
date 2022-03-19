
<?= $this->Form->create(null,[
    'type' => 'post',
    'url' => 'main/resetPassword'
]) ?>

<div class="row mb-3">
    <div class="col">
        <?=$this->Form->control('email', [

            'type' => 'text',
            'name' => 'email',
            'id' => 'email',
            'placeholder' => 'Enter your email',
            'class' => 'form-control',
            'label' => [
                'class' => ['form-label'],
                'for' => 'email'
            ]
        ])?>

       <h4><?=$this->Flash->render();?></h4>
    </div>
</div>

<div class="row mb-3">
    <div class="d-grid gap-2">
        <?=$this->Form->button(__('Reset password'),['class' => 'btn btn-lg btn-success'])?>
    </div>
</div>

<?=$this->Form->end()?>