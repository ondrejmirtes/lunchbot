<?php

namespace Lunchbot\Provider\Putica;

use Lunchbot\Menu\LunchMenuItem;
use Symfony\Component\DomCrawler\Crawler;

class PuticaLunchMenuParser
{

	const DAYS = [
		'Pondělí' => 1,
		'Úterý' => 2,
		'Středa' => 3,
		'Čtvrtek' => 4,
		'Pátek' => 5,
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

		$rows = $crawler->filter('div#daily_offer div.newboxeswine')->each(function (Crawler $node) {
			return $node->children();
		});

		$todayDayOfWeek = (int) $this->today->format('N');
		$items = [];
		foreach ($rows as $row) {
			$headlineTag = $row->filter('h3');
			$day = $headlineTag->text();
			if (!isset(self::DAYS[$day]) || self::DAYS[$day] !== $todayDayOfWeek) {
				continue;
			}

			foreach ($row->siblings() as $item) {
				$text = \Nette\Utils\Strings::trim($item->textContent);
				if ($text === '') {
					continue;
				}

				$items[] = new LunchMenuItem($text);
			}
		}

		return $items;
	}

}
