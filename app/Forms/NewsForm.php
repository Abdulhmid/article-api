<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NewsForm extends Form
{
    public function buildForm()
    {
    	$this
    		->add('title','text')
            ->add('tagline', 'textarea',
                [
                    'attr' => ['class' => 'form-control wysihtml5 wysihtml5-min','id'=>"summernote"],
                    'label' => 'Tagline'
                ]
            )
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
            ->add('photo','file',[
                'attr' => [
                    'id' => 'file',
                    'onchange' => 'readUrl(this)'
                ]
            ]);
    }
}
