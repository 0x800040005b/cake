<?php

use Cake\Routing\Router;
?>
<div class="row">
    <div class="col"><?=$this->Flash->render()?></div>
</div>
<div class="row">
    <div class="col">

    <?=$this->Form->create(null,[
        'type' => 'post',
        'method' => 'post',
        'url' => Router::url([
            'controller' => 'Main',
            'action' => 'login',
        ]),
    ]);?>

    <div class="row mb-3">
        <div class="col">
            <?=$this->Form->control('email',[
                'class' => 'form-control',
                'id' => 'email',
                'name' => 'email',
                'required' => true,
                'placeholder' => 'Enter email',
                'label' => [
                    'class' => [
                        'form-label'
                    ],
                ]
            ]);?>
            
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <?=$this->Form->control('password',[
                'class' => 'form-control',
                'id' => 'password',
                'name' => 'password',
                'required' => true,
                'placeholder' => 'Enter password',
                'label' => [
                    'class' => [
                        'form-label'
                    ],
                ]
            ]);?>
            
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <?=$this->Form->button('Login',[
                'class' => 'btn btn-lg btn-success',
            ]);?>
            
        </div>
    </div>

    <?=$this->Form->end()?>

    </div>
</div>