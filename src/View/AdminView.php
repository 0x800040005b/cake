<?php

namespace App\View;

use App\View\AppView;

class AdminView extends AppView
{
    public $layout = 'admin/main';

    public function initialize(): void
    {
        parent::initialize();

        $this->loadHelper('Html');
        $this->loadHelper('Form');
        $this->loadHelper('Flash');

        
        
    }

    



   
}