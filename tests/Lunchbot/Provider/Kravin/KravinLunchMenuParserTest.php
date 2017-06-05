<?php

namespace Lunchbot\Provider\Kravin;

class KravinLunchMenuParserTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider getHtmlData
	 */
	public function testParseHtml($file, array $expected)
	{
		$html = file_get_contents($file);
		$parser = new KravinLunchMenuParser();
		$result = $parser->parseHtml($html);
		$this->assertCount(count($expected), $result);
		for ($i = 0; $i < count($expected); $i++) {
			$this->assertSame($expected[$i], $result[$i]->getDescription());
		}
	}

	public function getHtmlData()
	{
		return [
			[
				__DIR__ . '/data.html',
				[
					'Polévka',
					'Květáková s vejcem ( samostatně 25kč/ k hlavnímu jídlu 10kč )',
					'Hlavní jídlo',
					'č.1 Smažený hermelín, podávaný s vařenými bramborami maštěnými máslem a domácí tatarskou omáčkou 119 Kč',
					'č.2 Pečné hovězí maso se znojemskou omáčkou s okurkami a dušenou jasmínovou rýží 119 Kč',
					'č.3 Boloňské Lasagne- zapečené těstovinové pláty s masovým ragů s tomaty, česnekem a oreganem, bešamelovou omáčkou, gratinované sýrem 119Kč',
					'č.4 Variace trhaných listových salátů s ředkvičkami, medovo- hořčičným dresingem, pečenými kuřecími křidélky v Barbecue marinádě a sýrovým dipem 119 Kč',
					'č.5 Grilovaná hovězí roštěná, servírovaná s omáčkou z pečených paprik, pečenými brambory s cibulkou a red chard salátkem s balsamikem 145 Kč',
					'č.6 250g Grilované kuřecí prso s křídlem Supreme, servírované s kuskusem s cuketou, paprikou a červenou cibulkou, jogurtový dip s mátou a limetou 149 Kč',
					'č.7 Smažený sýr (eidam) s bramborovými hranolky a domácí tatarskou omáčkou 119 Kč',
					'č.8 Hovězí Carpaccio- marinované plátky hovězí svíčkové, servírované s čerstvou rukolou, parmazánem, bazalkovým pestem a tousty 159 Kč',
				],
			],
		];
	}

}
