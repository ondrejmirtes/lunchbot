<?php

namespace Lunchbot\Provider\Putica;

class PuticaLunchMenuParserTest extends \PHPUnit\Framework\TestCase
{

	public function testParseHtmlMonday()
	{
		$html = file_get_contents(__DIR__ . '/data.html');
		$parser = new PuticaLunchMenuParser(new \DateTimeImmutable('2017-09-04'));
		$result = $parser->parseHtml($html);
		$this->assertCount(6, $result);
		$this->assertSame('Polévka:', $result[0]->getDescription());
		$this->assertSame('Cibulačka se sýrem   40 Kč', $result[1]->getDescription());
		$this->assertSame('Hotová jídla:', $result[2]->getDescription());
		$this->assertSame('1. VEPŘOVÁ PANENKA, smetanové brambory, karotka a omáčka z uzeného tymiánu    150 Kč', $result[3]->getDescription());
		$this->assertSame('2.  KUŘECÍ WOK se zeleninou, koriandrem, sojovými klíčky a jasmínovou rýží 130 Kč', $result[4]->getDescription());
		$this->assertSame('3.  KUS-KUS SALÁT s kuřecím masem, grilovanou zeleninou, omáčkou pisto, Mozzarellou a rukolou  130 Kč', $result[5]->getDescription());
	}

	public function testParseHtmlFriday()
	{
		$html = file_get_contents(__DIR__ . '/data.html');
		$parser = new PuticaLunchMenuParser(new \DateTimeImmutable('2017-09-08'));
		$result = $parser->parseHtml($html);
		$this->assertCount(5, $result);
		$this->assertSame('Polévka:', $result[0]->getDescription());
		$this->assertSame('Kulajda s houbami   40 Kč', $result[1]->getDescription());
		$this->assertSame('Hotová jídla:', $result[2]->getDescription());
		$this->assertSame('1.    *MEXIČAN BEEF BURGER – vyzrálé hovězí maso z české stračeny, uzená slanina, čedar, guacamole, koriandrové pesto, papričky Jalapeňos a hranolky        140 Kč', $result[3]->getDescription());
		$this->assertSame('2.   LASAGNE S KRŮTÍM RAGŮ, Parmazánem a polníčkem    120 Kč', $result[4]->getDescription());
	}

}
