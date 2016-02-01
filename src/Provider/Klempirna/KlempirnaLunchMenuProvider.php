<?php

namespace Lunchbot\Provider\Klempirna;

use GuzzleHttp\Client;
use Lunchbot\Provider\Klempirna\KlempirnaLunchMenuParser;
use Lunchbot\Provider\LunchMenuProvider;

class KlempirnaLunchMenuProvider implements LunchMenuProvider
{

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var \Lunchbot\Provider\Klempirna\KlempirnaLunchMenuParser */
	private $parser;

	public function __construct(Client $httpClient, KlempirnaLunchMenuParser $parser)
	{
		$this->httpClient = $httpClient;
		$this->parser = $parser;
	}

	public function getRestaurantName(): string
	{
		return 'Klempírna restaurant';
	}

	public function getRestaurantWebAddress(): string
	{
		return 'http://www.klempirna-restaurant.cz/poledni-nabidka/';
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
