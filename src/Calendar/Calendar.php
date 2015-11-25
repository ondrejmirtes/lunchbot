<?php

namespace Lunchbot\Calendar;

class Calendar
{

	public function isWorkDay(\DateTimeImmutable $now): bool
	{
		$day = (int) $now->format('w');
		if (in_array($day, [0, 6], true)) {
			return false;
		}

		foreach ($this->getHoliday($now) as $holidayDate) {
			if ($now->format('Ymd') === $holidayDate->format('Ymd')) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @param \DateTimeImmutable $now
	 * @return \DateTimeImmutable[]
	 */
	private function getHoliday(\DateTimeImmutable $now): array
	{
		$year = (int) $now->format('Y');

		return [
			new \DateTimeImmutable(sprintf('%s-01-01', $year)),
			\DateTimeImmutable::createFromFormat('U', easter_date($year))->modify('+2 days'),
			new \DateTimeImmutable(sprintf('%s-05-01', $year)),
			new \DateTimeImmutable(sprintf('%s-05-08', $year)),
			new \DateTimeImmutable(sprintf('%s-07-05', $year)),
			new \DateTimeImmutable(sprintf('%s-07-06', $year)),
			new \DateTimeImmutable(sprintf('%s-09-28', $year)),
			new \DateTimeImmutable(sprintf('%s-10-28', $year)),
			new \DateTimeImmutable(sprintf('%s-11-17', $year)),
			new \DateTimeImmutable(sprintf('%s-12-24', $year)),
			new \DateTimeImmutable(sprintf('%s-12-25', $year)),
			new \DateTimeImmutable(sprintf('%s-12-26', $year)),
		];
	}

}
