<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008, 2011 Filip Procházka (filip.prochazka@kdyby.org)
 *
 * @license http://www.kdyby.org/license
 */

namespace Kdyby\Security\RBAC;

use Kdyby;
use Nette;



/**
 * @author Filip Procházka
 *
 * @Entity @Table(name="rbac_actions")
 */
class Action extends Nette\Object
{

	/** @Id @Column(type="integer") @GeneratedValue @var integer */
	private $id;

	/** @Column(type="string", unique=TRUE) @var string */
	private $name;

	/** @Column(type="string") @var string */
	private $description;



	/**
	 * @param string $name
	 */
	public function __construct($name)
	{
		if (!is_string($name)) {
			throw new Nette\InvalidArgumentException("Given name is not string, " . gettype($name) . " given.");
		}

		$this->name = $name;
	}



	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}



	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}



	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}



	/**
	 * @param string $description
	 * @return Action
	 */
	public function setDescription($description)
	{
		$this->description = $description;
		return $this;
	}

}