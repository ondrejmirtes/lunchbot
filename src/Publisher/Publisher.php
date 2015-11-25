<?php

namespace Lunchbot\Publisher;

interface Publisher
{

	/**
	 * @param \Lunchbot\Menu\LunchMenuResult[] $results
	 */
	public function publishResults(array $results);

}
