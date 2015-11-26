<?php

namespace Lunchbot\Provider\MlsnejKocour;

use Lunchbot\Menu\LunchMenuItem;
use Symfony\Component\DomCrawler\Crawler;

class MlsnejKocourLunchMenuParser
{

	/**
	 * @param string $html
	 * @return \Lunchbot\Menu\LunchMenuItem[]
	 */
	public function parseHtml(string $html): array
	{
		$crawler = new Crawler();
		$crawler->addContent($html);

		$rows = $crawler->filter('table.dailyMenuTable tr')->each(function (Crawler $node) {
			return $node->children();
		});

		$menus = [];
		$currentKey = null;
		foreach ($rows as $item) {
			$headline = $item->text();
			if (in_array($headline, [
				'POLÉVKY',
				'HLAVNÍ  JÍDLO',
				'MENU 1',
				'MENU 2',
			], true)) {
				$currentKey = ucfirst(mb_strtolower(preg_replace('~(\s+)~', ' ', $headline), 'UTF-8'));
				$menus[$currentKey] = [];
				continue;
			}

			if ($headline === '') {
				$title = null;
				$price = null;
				foreach ($item as $child) {
					if ($child->nodeValue === '') {
						continue;
					}
					if ($title === null) {
						$title = trim($child->nodeValue);
					} elseif ($price === null) {
						$price = trim($child->nodeValue);
					}
				}
				$menus[$currentKey][] = new LunchMenuItem(sprintf('%s %s', $title, $price));
			} else {
				break;
			}
		}

		$result = [];

		foreach ($menus as $headline => $items) {
			if (count($items) > 0) {
				$result[] = new LunchMenuItem($headline);
				$result = array_merge($result, $items);
			}
		}

		return $result;
	}

}
