<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Settings
    |--------------------------------------------------------------------------
    |
    | In here you can define all the settings used in your app, it will be
    | available as a settings page where user can update it if needed
    | create sections of settings with a type of input.
    */
    'logo'=> [
    	'title' => 'Logo',
        'desc' => 'Logo settings',
        'icon' => 'glyphicon glyphicon-education',

        'elements'=> [
        	[
        		'type'=>'checkbox',
        		'data'=>'boolean',
        		'name'=>'logo',
        		'label'=>'Logo',
        		'rules'=>'required|boolean',
        		'value'=>1,
        		'checked'=>'checked',
        	]
        ],
    ],
    'title'=>[
    	'title' => 'Title',
        'desc' => 'Title settings',
        'icon' => 'glyphicon glyphicon-education',


        'elements'=> [
        	[
        		'type'=>'checkbox',
        		'data'=>'boolean',
        		'name'=>'title',
        		'label'=>'Title',
        		'rules'=>'required|boolean',
        		'value'=>1,
        		'checked'=>'checked',
        	]
        ],
    ],
];