<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008, 2011 Filip Procházka (filip.prochazka@kdyby.org)
 *
 * @license http://www.kdyby.org/license
 */

namespace Kdyby\Components\Grinder\Actions;

use Kdyby;
use Kdyby\Components\Grinder\Grid;
use Nette;
use Nette\Forms\Form;
use Nette\Forms\ISubmitterControl;



/**
 * @author Filip Procházka
 */
class FormAction extends BaseAction
{

	/** @var array */
	public $onSuccess = array();

	/** @var Nette\Forms\Controls\Button */
	private $control;



	/**
	 * @param ISubmitterControl $control
	 */
	public function __construct(ISubmitterControl $control)
	{
		parent::__construct();

		$this->control = $control;
	}



	/**
	 * @param Nette\ComponentModel\Container $obj
	 */
	protected function attached($obj)
	{
		parent::attached($obj);

		if (!$obj instanceof Grid) {
			return;
		}

		$form = $this->getGrid()->getForm();
		$toolbar = $form->getComponent('toolbar');
		$toolbar[$this->name] = $this->control;

		$form->onSuccess[] = array($this, 'fireEvents');
	}



	public function fireEvents()
	{
		$form = $this->getGrid()->getForm();
		if ($form->isSubmitted() === $this->control) {
			$this->onSuccess($this);
		}
	}



	/**
	 * @return ISubmitterControl
	 */
	public function getControl()
	{
		return $this->control;
	}

}