<?php

namespace Lunchbot\Provider\Klempirna;

use Lunchbot\Menu\LunchMenuItem;
use Symfony\Component\DomCrawler\Crawler;

class KlempirnaLunchMenuParser
{

	private static $DAYS = [
		'PONDĚLÍ' => 1,
		'ÚTERÝ' => 2,
		'STŘEDA' => 3,
		'ČTVRTEK' => 4,
		'PÁTEK' => 5,
	];

	/** @var \DateTimeImmutable */
	private $today;

	public function __construct(\DateTimeImmutable $today)
	{
		$this->today = $today;
	}

	/**
	 * @param string $html
	 * @return \Lunchbot\Menu\LunchMenuItem[]
	 */
	public function parseHtml(string $html): array
	{
		$crawler = new Crawler();
		$crawler->addContent($html);

		$rows = $crawler->filter('div.entry-content table tr')->each(function (Crawler $node) {
			return $node;
		});

		$todayDayOfWeek = (int) $this->today->format('N');
		$currentDayBlock = false;
		/** @var Crawler $item */
		$result = [];
		foreach ($rows as $item) {
			$headlineTag = $item->children();
			$headline = $headlineTag->text();

			$dayOfWeek = \Nette\Utils\Strings::match($headline, '~^(\w+)\s~u')[1] ?? null;
			if (isset(self::$DAYS[$dayOfWeek]) && self::$DAYS[$dayOfWeek] === $todayDayOfWeek) {
				$currentDayBlock = true;
			} elseif ($currentDayBlock) {
				if (trim($headline) === 'Dezert') {
					break;
				}
				$result[] = new LunchMenuItem($headlineTag->siblings()->text());
			}
		}

		return $result;
	}

}
