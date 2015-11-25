<?php

namespace Lunchbot\Provider;

interface LunchMenuProvider
{

	public function getRestaurantName(): string;

	public function getRestaurantWebAddress(): string;

	/**
	 * @return \Lunchbot\Menu\LunchMenuItem[]
	 */
	public function getTodayLunchMenu(): array;

}
