<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NewsForm extends Form
{
    public function buildForm()
    {
    	$this
    		->add('title','text')
    		->add('tag','text',[
                    'attr' => ['class' => 'form-control tokenfield-teal']
                ])

            ->add('status', 'choice', [
                'choices' => ['1' => 'Active', '0' => 'Not Active'],
                'label'         => "Status",
                'expanded' => true,
                'multiple' => false
            ])
    		
	        /* 
			** Meta Data
	        */

    		->add('meta_title','text',[
    				'label' => false
    			])
    		->add('meta_keyword','text',[
    				'label' => false
    			])
    		->add('meta_description','textarea',[
    				'label' => false
    			])
            ->add('content','textarea',[
                    'label' => false
                ])
            ->add('photo','file',[
                'attr' => [
                    'id' => 'file',
                    'onchange' => 'readUrl(this)'
                ]
            ]);
    }
}
