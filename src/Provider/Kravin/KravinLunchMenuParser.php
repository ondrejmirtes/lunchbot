<?php

namespace Lunchbot\Provider\Kravin;

use Lunchbot\Menu\LunchMenuItem;
use Symfony\Component\DomCrawler\Crawler;

class KravinLunchMenuParser
{

	/**
	 * @param string $html
	 * @return \Lunchbot\Menu\LunchMenuItem[]
	 */
	public function parseHtml(string $html): array
	{
		$crawler = new Crawler();
		$crawler->addContent($html);

		$soupText = trim(preg_replace('~\x{00a0}~siu', ' ', $crawler->filter('.entry-content table td')->text()));

		$result = [
			new LunchMenuItem($soupText),
		];

		foreach ($crawler->filter('.entry-content ul:first-of-type li strong') as $node) {
			$result[] = new LunchMenuItem(trim($node->nodeValue));
		}

		return $result;
	}

}
