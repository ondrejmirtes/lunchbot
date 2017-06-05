<?php

namespace Lunchbot\Provider\MlsnejKocour;

class MlsnejKocourLunchMenuParserTest extends \PHPUnit\Framework\TestCase
{

	public function testParseHtml()
	{
		$html = file_get_contents(__DIR__ . '/data.html');
		$parser = new MlsnejKocourLunchMenuParser();
		$result = $parser->parseHtml($html);
		$this->assertCount(16, $result);
		$this->assertSame('Polévky', $result[0]->getDescription());
		$this->assertSame('Krůtí vývar s masem a zeleninou 25 Kč', $result[1]->getDescription());
		$this->assertSame('Francouzská cibulačka s máslovými krutony 30 Kč', $result[2]->getDescription());
		$this->assertSame('Hlavní jídlo', $result[3]->getDescription());
		$this->assertSame("160g	Roštěná Stroganoff (hříbky, smetana, kyselé okurky), \ndušená rýže 99 Kč", $result[4]->getDescription());
		$this->assertSame('180g	2 ks Burritos – plněná mexická tortila pikantní masovou směsí se zakysanou smetanou a čerstvým koriandrem 99 Kč', $result[5]->getDescription());
		$this->assertSame('160g	Vepřová kýta na smetaně (svíčková), houskové knedlíky, brusinky, citron zakysaná smetana 99 Kč', $result[6]->getDescription());
		$this->assertSame('160g	Pečená uzená šunka na kosti, domácí bramborová kaše, zelný salátek 97 Kč', $result[7]->getDescription());
		$this->assertSame('160g	Medailonky z kuřecích prsíček v marinádě Texas, smažené bramborové hranolky 99 Kč', $result[8]->getDescription());
		$this->assertSame("Marinované krůtí nugetky na variaci listových salátů \na čerstvé zeleniny s čerstvým špenátem a sýrovým dressingem, citron 110 Kč", $result[9]->getDescription());
		$this->assertSame('Menu 1', $result[10]->getDescription());
		$this->assertSame("Krůtí vývar s masem a zeleninou                                      \n160g  Vepřová kýta na smetaně (svíčková), houskové knedlíky, brusinky, citron zakysaná smetana 105 Kč", $result[11]->getDescription());
		$this->assertSame('Menu 2', $result[12]->getDescription());
		$this->assertSame("Francouzská cibulačka s máslovými krutony                        \n160g Pečená uzená šunka na kosti, domácí bramborová kaše, zelný salátek 105 Kč", $result[13]->getDescription());
		$this->assertSame('Vegetarian', $result[14]->getDescription());
		$this->assertSame('Domácí bramborová kaše, sázené vejce, malý denní salátek 98Kč', $result[15]->getDescription());
	}

}
