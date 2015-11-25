<?php

namespace Lunchbot\Menu;

class LunchMenuResult
{

	/**
	 * @var string
	 */
	private $restaurantName;

	/**
	 * @var string
	 */
	private $restaurantWebAddress;

	/**
	 * @var \Lunchbot\Menu\LunchMenuItem[]
	 */
	private $todayLunchMenu;

	/**
	 * @param string $restaurantName
	 * @param string $restaurantWebAddress
	 * @param \Lunchbot\Menu\LunchMenuItem[] $todayLunchMenu
	 */
	public function __construct(string $restaurantName, string $restaurantWebAddress, array $todayLunchMenu)
	{
		$this->restaurantName = $restaurantName;
		$this->restaurantWebAddress = $restaurantWebAddress;
		$this->todayLunchMenu = $todayLunchMenu;
	}

	public function getRestaurantName(): string
	{
		return $this->restaurantName;
	}

	public function getRestaurantWebAddress(): string
	{
		return $this->restaurantWebAddress;
	}

	/**
	 * @return \Lunchbot\Menu\LunchMenuItem[]
	 */
	public function getTodayLunchMenu(): array
	{
		return $this->todayLunchMenu;
	}

}
