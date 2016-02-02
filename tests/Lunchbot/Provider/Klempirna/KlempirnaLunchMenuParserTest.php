<?php

namespace Lunchbot\Provider\Klempirna;

class KlempirnaLunchMenuParserTest extends \PHPUnit_Framework_TestCase
{

	public function testParseHtmlMonday()
	{
		$html = file_get_contents(__DIR__ . '/data.html');
		$parser = new KlempirnaLunchMenuParser(new \DateTimeImmutable('2016-02-01'));
		$result = $parser->parseHtml($html);
		$this->assertCount(4, $result);
		$this->assertSame('Hovězí vývar s nudlemi a játrovými knedlíčky (1, 3, 7)', $result[0]->getDescription());
		$this->assertSame('1. Jaternicový prejt s kysaným zelím a vařenými brambory (1, 9, 10)', $result[1]->getDescription());
		$this->assertSame('2. Boloňské špagety (1, 3, 7, 9)', $result[2]->getDescription());
		$this->assertSame('3. Caesar salát (1, 3, 7)', $result[3]->getDescription());
	}

	public function testParseHtmlTuesday()
	{
		$html = file_get_contents(__DIR__ . '/data.html');
		$parser = new KlempirnaLunchMenuParser(new \DateTimeImmutable('2016-02-02'));
		$result = $parser->parseHtml($html);
		$this->assertCount(4, $result);
		$this->assertSame('Bramboračka (1, 3, 7, 9)', $result[0]->getDescription());
		$this->assertSame('1. Vepřové výpečky se špenátem a bramborovými knedlíky (1, 3, 9, 10, 12)', $result[1]->getDescription());
		$this->assertSame('2. Hovězí Stroganoff se žampiony, dušená rýže (1, 3, 7, 9, 10)', $result[2]->getDescription());
		$this->assertSame('3. Zeleninový salát s chilli sojovými nudličkami (6, 9)', $result[3]->getDescription());
	}

	public function testParseHtmlFriday()
	{
		$html = file_get_contents(__DIR__ . '/data.html');
		$parser = new KlempirnaLunchMenuParser(new \DateTimeImmutable('2016-02-05'));
		$result = $parser->parseHtml($html);
		$this->assertCount(4, $result);
		$this->assertSame('Česnečka se sýrem a krutony (1, 3, 7)', $result[0]->getDescription());
		$this->assertSame('1. Indické zelené kari se zeleninou, dušená rýže (1, 5, 6, 11)', $result[1]->getDescription());
		$this->assertSame('2. Tortilla s kuřecími stripsy, čerstvou zeleninou a jogurtovým dresinkem (1, 3, 7, 10)', $result[2]->getDescription());
		$this->assertSame('3. Zapečená zelenina s brambory a sýrem (1, 3, 7)', $result[3]->getDescription());
	}

}
