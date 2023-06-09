<?php

namespace Lengwang\Distpicker;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Form;
use Lengwang\Distpicker\Form\Distpicker;

class DistpickerServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

        Form::extend('LwDistpicker', Distpicker::class);

        $this->publishable();
	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
