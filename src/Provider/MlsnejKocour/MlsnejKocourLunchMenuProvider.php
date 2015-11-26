<?php

namespace Lunchbot\Provider\MlsnejKocour;

use GuzzleHttp\Client;
use Lunchbot\Provider\LunchMenuProvider;

class MlsnejKocourLunchMenuProvider implements LunchMenuProvider
{

	/** @var \GuzzleHttp\Client */
	private $httpClient;

	/** @var \Lunchbot\Provider\MlsnejKocour\MlsnejKocourLunchMenuParser */
	private $parser;

	public function __construct(Client $httpClient, MlsnejKocourLunchMenuParser $parser)
	{
		$this->httpClient = $httpClient;
		$this->parser = $parser;
	}

	public function getRestaurantName(): string
	{
		return 'Mlsnej Kocour';
	}

	public function getRestaurantWebAddress(): string
	{
		return 'http://www.mlsnejkocour.cz';
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
