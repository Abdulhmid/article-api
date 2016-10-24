<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UsersForm extends Form
{
    public function buildForm()
    {
        $typeUser = \Auth::user()->type_user;

        $this
            ->add('username','text')
            ->add('name','text')
            ->add('email','text')
            ->add('password','password')
            ->add('password_confirmation','password')
            ->add('phone','text')
            ->add('active','choice',[
            'choices'       => [1 => 'Active', 0 => 'Not Active'],
            'label'         => "Status",
            'expanded'      => true,
            'multiple'      => false,
            'choice_options' => [ 
                'wrapper' => [
                    'class' => 'choice-wrapper'
                ] 
                 ]
            ])
            ->add('address', 'textarea',
                [
                    'attr' => ['class' => 'wysihtml52 form-control']
                ]
            )
            ->add('photo','file',[
                'attr' => [
                    'id' => 'file',
                    'onchange' => 'readUrl(this)'
                ]
            ]);

        $this->add('group_id', 'select', [
                    'attr' => ['class' => 'frm-e form-control', 'id' => 'groupInput'],
                    'choices' => \App\Models\Groups::pluck("name", "id")
                                    ->toArray(),
                    'empty_value' => '- Pilih Grup -',
                    'label' => 'Pengguna Untuk Grup'
                ]);

    }
}