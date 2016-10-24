<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class GroupsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('group_name', 'text',
                [
                    'attr' => ['class' => 'form-control'],
                    'label' => 'Nama Kelompok'
                ]
            )
            ->add('description', 'textarea',
                [
                    'attr' => ['class' => 'wysihtml52 form-control']
                ]
            );
    }
}
