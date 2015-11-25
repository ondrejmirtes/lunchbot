<?php

namespace Lunchbot\Provider\Kravin;

class KravinLunchMenuParserTest extends \PHPUnit_Framework_TestCase
{

	public function testParseHtml()
	{
		$html = file_get_contents(__DIR__ . '/data.html');
		$parser = new KravinLunchMenuParser();
		$result = $parser->parseHtml($html);
		$this->assertCount(6, $result);
		$this->assertSame('Tomatová s těstovinami (samostatně 25,-)', $result[0]->getDescription());
		$this->assertSame('Menu č.1 Smažená cuketa a lilek, podávané s vařenými brambory maštěnými máslem a domácí tatarskou omáčkou 98,-', $result[1]->getDescription());
		$this->assertSame('Menu č.2 Grilované krůtí prso, servírované s bramborovo-mrkvovým pyré a holandskou omáčkou 105,-', $result[2]->getDescription());
		$this->assertSame('Menu č.3 Zapečené těstoviny Farfalle s restovanými vepřovými nudličkami, žampiony,vejcem a omáčkou Quattro formaggi se smetanou 105,-', $result[3]->getDescription());
		$this->assertSame('Menu č.4 Thajský zeleninový salát s filírovanou hovězí roštěnou- variace listových salátů s rukolou, chilli papričkami a pikantní asijskou zálivkou 105,-', $result[4]->getDescription());
		$this->assertSame('Menu č.5 Grilovaný steak z norského lososa, podávaný s restovanou-karamelizovanou kořenovou zeleninou a estragonovou omáčkou  149,-', $result[5]->getDescription());
	}

}
