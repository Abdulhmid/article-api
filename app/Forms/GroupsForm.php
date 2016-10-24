<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class GroupsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('description', 'textarea',
                [
                    'attr' => ['class' => 'wysihtml52 form-control']
                ]
            );
    }
}
