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

		$result = [];
		/** @var \DOMNode $node */
		$filter = $crawler->filter('.pricing-box .row');
		foreach ($filter as $node) {
			$textLine = \Nette\Utils\Strings::trim($node->textContent);
			$trimmed = \Nette\Utils\Strings::replace($textLine, '~\\s{2,}~u', ' ');
			if ($trimmed === '') {
				continue;
			}
			if (in_array(\Nette\Utils\Strings::lower($trimmed), ['salát', 'dezert', 'doporučujeme'], true)) {
				break;
			}
			$result[] = new LunchMenuItem($trimmed);
		}

		return $result;
	}

}
