<?php

namespace Lunchbot\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{

	public function dataIsWorkDay()
	{
		return [
			[
				new \DateTimeImmutable('2015-11-25'),
				true,
			],
			[
				new \DateTimeImmutable('2015-04-06'), // easter Monday
				false,
			],
			[
				new \DateTimeImmutable('2015-11-17'), // state holiday
				false,
			],
			[
				new \DateTimeImmutable('2015-11-28'), // weekend - saturday
				false,
			],
			[
				new \DateTimeImmutable('2015-11-29'), // weekend - sunday
				false,
			],
		];
	}

	/**
	 * @dataProvider dataIsWorkDay
	 * @param \DateTimeImmutable $now
	 * @param bool $expectedResult
	 */
	public function testIsWorkDay(\DateTimeImmutable $now, bool $expectedResult)
	{
		$calendar = new Calendar();
		$this->assertSame($expectedResult, $calendar->isWorkDay($now));
	}

}
