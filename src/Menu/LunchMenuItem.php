<?php

namespace Lunchbot\Menu;

class LunchMenuItem
{

	/**
	 * @var string
	 */
	private $description;

	public function __construct(string $description)
	{
		$this->description = $description;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

}
