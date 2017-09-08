<?php

namespace Lunchbot\Command;

use Lunchbot\Calendar\Calendar;
use Lunchbot\Menu\LunchMenuResult;
use Lunchbot\Publisher\Publisher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PostLunchMenusCommand extends Command
{

	const NAME = "lunchbot:post";

	/** @var \Lunchbot\Calendar\Calendar */
	private $calendar;

	/** @var \Lunchbot\Provider\LunchMenuProvider[] */
	private $providers;

	/** @var \Lunchbot\Publisher\Publisher */
	private $publisher;

	public function __construct(Calendar $calendar, array $providers, Publisher $publisher)
	{
		parent::__construct();
		$this->calendar = $calendar;
		$this->providers = $providers;
		$this->publisher = $publisher;
	}

	protected function configure()
	{
		$this->setName(self::NAME);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$shouldOutput = $output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE;
		if (!$this->calendar->isWorkDay(new \DateTimeImmutable())) {
			if ($shouldOutput) {
				$output->writeln('Not running today');
			}
			return;
		}
		$results = [];
		foreach ($this->providers as $provider) {
			$lunchMenu = $provider->getTodayLunchMenu();
			if (count($lunchMenu) > 0) {
				$results[] = new LunchMenuResult(
					$provider->getRestaurantName(),
					$provider->getRestaurantWebAddress(),
					$provider->getTodayLunchMenu()
				);
			}
		}

		if (count($results) > 0) {
			$this->publisher->publishResults($results);
		}

		if ($shouldOutput) {
			$output->writeln('Posted!');
		}
	}

}
