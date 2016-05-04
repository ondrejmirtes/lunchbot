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

		$soupText = '';
		if (count($crawler->filter('.entry-content table td')) > 0) {
			$soupText = trim(preg_replace('~\x{00a0}~siu', ' ', $crawler->filter('.entry-content table td')->text()));
		} else {
			$nextLineIsSoup = false;
			foreach ($crawler->filter('.entry-content p') as $soupCandidate) {
				if (\Nette\Utils\Strings::lower(\Nette\Utils\Strings::trim($soupCandidate->textContent)) === 'polévka') {
					$nextLineIsSoup = true;
				} elseif ($nextLineIsSoup) {
					$soupText = trim(preg_replace('~\x{00a0}~siu', ' ', $soupCandidate->textContent));
					break;
				}
			}
		}

		$result = [
			new LunchMenuItem($soupText),
		];

		foreach ($crawler->filter('.entry-content ul:first-of-type li strong') as $node) {
			$result[] = new LunchMenuItem(trim($node->nodeValue));
		}

		return $result;
	}

}
