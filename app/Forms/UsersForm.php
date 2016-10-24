<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UsersForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('username','text')
            ->add('name','text')
            ->add('email','text')
            ->add('password','password')
            ->add('password_confirmation','password')

            ->add('photo','file',[
                'attr' => [
                    'id' => 'file',
                    'onchange' => 'readUrl(this)'
                ]
            ]);

        $this->add('group_id', 'select', [
                    'attr' => ['class' => 'frm-e form-control', 'id' => 'groupInput'],
                    'choices' => \App\Models\Groups::pluck("group_name", "group_id")
                                    ->toArray(),
                    'empty_value' => '- Pilih Grup -',
                    'label' => 'Pengguna Untuk Grup'
                ]);

    }
}