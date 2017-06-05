<?php

namespace Lunchbot\Provider\Kravin;

class KravinLunchMenuParserTest extends \PHPUnit\Framework\TestCase
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
			[
				__DIR__ . '/data3.html',
				[
					'Květáková s vejcem (samostatně 25,-)',
					'Menu č.1 Bramborové noky s restovaným vepřovým masem, žampiony, listovým špenátem s česnekem a bešamelovou omáčkou, sypané parmazánem 110,-',
					'Menu č.2 Kentucky Wings- smažená pikantní kuřecí křídla v kukuřičném těstíčku, podávaná s mléčnou bramborovou kaší s máslem a malým salátem coleslaw 110,-',
					'Menu č.3 Mexické Burritos s restovanými kuřecími nudličkami, paprikou, červenou cibulí,tomatovou salsou a sýrem, podávané s malou porcí bramborových hranolek a zakysanou smetanou 110,-',
					'Menu č.4 Těstovinový salát s tuňákem ve vlastní šťávě, variací míchané čerstvé zeleniny, olivami, vejcem a olivovým olejem 110,-',
					'Menu č.5 300g Velký šťavnatý grilovaný steak z vepřové krkovičky, podávaný s restovanými fazolkami se slaninou a česnekovým dipem 139,-',
				],
			],
			[
				__DIR__ . '/data4.html',
				[
					'Žampionový krém (samostatně 25,-)',
					'Menu č.1 Těstoviny Rigatoni Bolognese- s masovým ragů s tomaty, česnekem, cibulkou a oreganem, sypané strouhaným eidamským sýrem 115,-',
					'Menu č.2 Pečené kuřecí paličky, marinované v indickém koření Tandoori, podávané s dušenou dlouhozrnnou rýží, šťavou z výpeku a salátkem coleslaw 115,-',
					'Menu č.3 Pečený vepřový záhorácký závitek, plněný zelím a slaninou, podávaný se šťouchanými brambory s jarní cibulkou a máslem, šťáva z výpeku 115,-',
					'Menu č.4 Salát se šlehaným kozím sýrem s créme fraiche, červenou řepou, variací trhaných listových salátů, fazolkami a rukolou 115,-',
					'Menu č.5 Grilovaný steak z hovězí roštěné, servírovaný s gratinovanými brambory se smetanou a parmazánem, konfitovaným česnekem a silnou omáčkou demi glace 145,-',
					'Menu č.6 200g Grilované kuřecí prso Supreme s kostí a kůží, servírované s jemným bramborovým pyré a pikantní švestkovou omáčkou 135,-',
					'Menu č.7  Smažený sýr (eidam) s bramborovými hranolky a domácí tatarskou omáčkou 115,-',
					'Menu č.8 Hovězí Carpaccio- marinované plátky hovězí svíčkové, servírované s čerstvou rukolou, parmazánem, bazalkovým pestem a tousty 159,-',
				],
			],
			[
				__DIR__ . '/data5.html',
				[
					'Bramborový krém se špekem  ( samostatně 25kč/ k hlavnímu jídlu 10kč )',
					'č.1 Kynuté švestkové knedlíky se strouhaným tvarohem, rozpuštěným máslem a moučkovým cukrem 119,-',
					'č.2 Hovězí pečeně se znojemskou omáčkou s kyselou okurkou a dušenou jasmínovou rýží 119,-',
					'č.3 Grilovaný steak z vepřové krkovice, marinovaný v hrubozrnné hořčici, podávaný se šťouchanými brambory s pórkem a máslem 119,-',
					'č.4 Kuskusový salát s řeckým sýrem Feta,  sušenými tomaty, okurkou, cuketou, červenou cibulkou a olivovým olejem 119,-',
					'č.5 Pečený pstruh v kouři,  podávaný s restovanou zeleninou s bramborovými grenaillemi a bazalkovým pestem 145,-',
					'č.6 Grilované kachní prso, servírované se švestkovou omáčkou a šťouchanými brambory se smetanou a máslem 149,-',
					'č.7  Smažený sýr (eidam) s bramborovými hranolky a domácí tatarskou omáčkou 119,-',
					'č.8 Hovězí Carpaccio- marinované plátky hovězí svíčkové, servírované s čerstvou rukolou, parmazánem, bazalkovým pestem a tousty 159,-',
				],
			],
		];
	}

}
