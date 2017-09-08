<?php

namespace Lunchbot\Provider\Putica;

use GuzzleHttp\Client;
use Lunchbot\Provider\LunchMenuProvider;

class PuticaLunchMenuProvider implements LunchMenuProvider
{

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var \Lunchbot\Provider\Putica\PuticaLunchMenuParser */
	private $parser;

	public function __construct(Client $httpClient, PuticaLunchMenuParser $parser)
	{
		$this->httpClient = $httpClient;
		$this->parser = $parser;
	}

	public function getRestaurantName(): string
	{
		return 'Putica';
	}

	public function getRestaurantWebAddress(): string
	{
		return 'http://www.putica.cz/#daily_offer';
	}

	/**
	 * @return \Lunchbot\Menu\LunchMenuItem[]
	 */
	public function getTodayLunchMenu(): array
	{
		$response = $this->httpClient->get('http://www.putica.cz/');
		$html = (string) $response->getBody();

		return $this->parser->parseHtml($html);
	}
}
