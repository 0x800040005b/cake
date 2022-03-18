<div class="row">
    <div class="col">
        <?php
        echo $this->Form->create($user,[

            'method' => 'post',
            'url' => 'users/registration'

        ]);?>

        <div class="row mb-3">
            <div class="col">
                <?=$this->Form->control('first_name',[
                  'placeholder' => 'Enter First name',
                  'class' => 'form-control',  
                  
                ])?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <?=$this->Form->control('last_name',[
                  'placeholder' => 'Enter Last name',
                  'class' => 'form-control',  
                ])?>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <?=$this->Form->control('email',[
                  'placeholder' => 'Enter email',
                  'class' => 'form-control',  
                ])?>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <?=$this->Form->control('password',[
                  'placeholder' => 'Enter password',
                  'class' => 'form-control',  
                  'label' => [
                      'text' => 'Password',
                  ]
                ])?>

            </div>
        </div>

        <div class="row mb-3">
            <div class="d-grid gap-2">
                <?=$this->Form->button('Register',[
                  'class' => 'btn btn-success btn-lg',  
                ])?>
            </div>
        </div>


        <?php

        echo $this->Form->end();

        ?>
    </div>
</div>