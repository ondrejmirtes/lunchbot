<?php

namespace Lunchbot\Publisher;

use GuzzleHttp\Client;
use Lunchbot\Menu\LunchMenuItem;
use Lunchbot\Menu\LunchMenuResult;

class SlackPublisher implements Publisher
{

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var string */
	private $channel;

	/** @var string */
	private $url;

	public function __construct(Client $httpClient, string $channel, string $url)
	{
		$this->httpClient = $httpClient;
		$this->channel = $channel;
		$this->url = $url;
	}

	/**
	 * @param \Lunchbot\Menu\LunchMenuResult[] $results
	 */
	public function publishResults(array $results)
	{
		$this->httpClient->post($this->url, [
			\GuzzleHttp\RequestOptions::BODY => json_encode([
				'channel' => $this->channel,
				'username' => 'Lunchbot',
				'icon_url' => 'https://cdn2.iconfinder.com/data/icons/life-concepts-lifestyles/128/eating-512.png',
				'text' => implode("\n\n", array_map(function (LunchMenuResult $result) {
					return sprintf(
						"*<%s|%s>*\n%s",
						$result->getRestaurantWebAddress(),
						$result->getRestaurantName(),
						implode("\n", array_map(function (LunchMenuItem $item) {
							return $item->getDescription();
						}, $result->getTodayLunchMenu()))
					);
				}, $results)),
			]),
			\GuzzleHttp\RequestOptions::VERIFY => \Composer\CaBundle\CaBundle::getBundledCaBundlePath()
		]);
	}

}
