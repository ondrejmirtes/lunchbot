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
					'Tomatová s těstovinami (samostatně 25,-)',
					'Menu č.1 Smažená cuketa a lilek, podávané s vařenými brambory maštěnými máslem a domácí tatarskou omáčkou 98,-',
					'Menu č.2 Grilované krůtí prso, servírované s bramborovo-mrkvovým pyré a holandskou omáčkou 105,-',
					'Menu č.3 Zapečené těstoviny Farfalle s restovanými vepřovými nudličkami, žampiony,vejcem a omáčkou Quattro formaggi se smetanou 105,-',
					'Menu č.4 Thajský zeleninový salát s filírovanou hovězí roštěnou- variace listových salátů s rukolou, chilli papričkami a pikantní asijskou zálivkou 105,-',
					'Menu č.5 Grilovaný steak z norského lososa, podávaný s restovanou-karamelizovanou kořenovou zeleninou a estragonovou omáčkou  149,-',
				],
			],
			[
				__DIR__ . '/data2.html',
				[
					'Čočková s klobásou (samostatně 25,-)',
					'Menu č.1 Tagliatelle s restovanou vepřovou panenkou, hrubozrnnou hořčicí a sušenými tomaty, sypané parmazánem 110,-',
					'Menu č.2 Pečené kuřecí paličky na zázvoru, brandy a chilli papričkách, podávané s dušenou jasmínovou rýží a zelným salátem 110,-',
					'Menu č.3 Smažený holandský mletý řízek se sýrem, podávaný s mléčnou bramborovou  kaší maštěnou máslem a kyselou okurkou 105,-',
					'Menu č.4 Variace trhaných listových salátů a čerstvé zeleniny s citrusovým vinaigrettem,smaženým hermelínem a brusinkovou omáčkou 110,-',
					'Menu č.5 Grilovaný steak z norského lososa, servírovaný s bazalkovým rizotem sypaným parmazánem, čerstvou rukolou a limetkovým olejíčkem 149,-',
					'Grilovaný hovězí Flank steak, servírovaný se smetanovým houbovým ragů, rozpečenou bylinkovou bagetou 159,-',
					'SMAŽENÝ SÝR (eidam) s bramborovými hranolky a domácí tatarskou omáčkou 115,-',
					'HOVĚZÍ CARPACCIO- MARINOVANÉ PLÁTKY HOVĚZÍ SVÍČKOVÉ, SERVÍROVANÉ S ČERSTVOU RUKOLOU, PARMAZÁNEM, BAZALKOVÝM PESTEM A TOUSTY 149,-',
				],
			],
		];
	}

}
