<?php

namespace Lunchbot\Provider\Kravin;

use GuzzleHttp\Client;
use Lunchbot\Provider\LunchMenuProvider;

class KravinLunchMenuProvider implements LunchMenuProvider
{

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var \Lunchbot\Provider\Kravin\KravinLunchMenuParser */
	private $parser;

	public function __construct(Client $httpClient, KravinLunchMenuParser $parser)
	{
		$this->httpClient = $httpClient;
		$this->parser = $parser;
	}

	public function getRestaurantName(): string
	{
		return 'Kravín';
	}

	public function getRestaurantWebAddress(): string
	{
		return 'http://www.restauracekravin.cz';
	}

	/**
	 * @return \Lunchbot\Menu\LunchMenuItem[]
	 */
	public function getTodayLunchMenu(): array
	{
		$response = $this->httpClient->get($this->getRestaurantWebAddress());
		$html = (string) $response->getBody();

		return $this->parser->parseHtml($html);
	}
}
