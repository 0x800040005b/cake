<div class="row">

    <div class="col">

        <?= $this->Form->create(null, [
            'type' => 'post',
            'method' => 'post',
            'url' => 'main/login'
        ]); ?>

        <div class="row mb-3">

            <div class="col">

                <?= $this->Form->control('email', [

                    'class' => 'form-control',
                    'id' => 'email',
                    'name' => 'email',
                    'required' => true,
                    'placeholder' => 'Enter email',
                    'label' => [

                        'class' => [

                            'form-label'
                        ],

                        'for' => 'email',
                    ]

                ]); ?>

            </div>
        </div>

        <div class="row mb-3">

            <div class="col">

                <?= $this->Form->control('password', [

                    'class' => 'form-control',
                    'id' => 'password',
                    'name' => 'password',
                    'required' => true,
                    'placeholder' => 'Enter password',
                    'label' => [

                        'class' => [

                            'form-label'
                        ],

                        'for' => 'password',

                    ]

                ]); ?>

            </div>
        </div>

        <div class="row  mb-3">
            <div class="message-error"><?= $this->Flash->render('password_change') ?></div>
        </div>



        <div class="row mb-3">
            <div class="d-grid gap-2">
                <?= $this->Form->button('Login', [
                    'class' => 'btn btn-lg btn-success',
                ]); ?>

            </div>
        </div>

        <div class="row mb-3">
            <div class="d-grid gap-2">
                <?= $this->Html->link(__('Reset password'), 'main/resetPassword', [
                    'class' => 'btn btn-outline-secondary btn-lg'
                ]) ?>

            </div>
        </div>


        <?= $this->Form->end() ?>

    </div>
</div>