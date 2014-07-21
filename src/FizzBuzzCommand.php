<?php
namespace Hnw\FizzBuzz;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Hnw\SingleSubcommandConsole\Command\Command;

class FizzBuzzCommand extends Command
{
    protected function configure()
    {   
        $this->setName('fizzbuzz')
            ->setDescription("Display fizz or buzz or number")
            ->setDefinition(array(
                    new InputOption('limit', null, InputOption::VALUE_REQUIRED, 'Maximum number for fizzbuzz', 100),
                ));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $limit = intval($input->getOption('limit'));
        if ($limit <= 0) {
            throw new \InvalidArgumentException('"limit" number must be positive');
        }
        foreach ($this->numberGenerator($limit) as $i) {
            if ($output->isVerbose()) {
                $output->write("$i: ");
            }
            if ($i % 3 === 0) {
                if ($i % 5 === 0) {
                    $this->showFizzBuzz($output);
                } else {
                    $this->showFizz($output);
                }
            } else { 
                if ($i % 5 === 0) {
                    $this->showBuzz($output);
                } else {
                    $this->showNumber($output, $i);
                }
            }
        }
    }

    protected function showFizz(OutputInterface $output)
    {
        $output->writeln('<info>Fizz</info>');
    }
    protected function showBuzz(OutputInterface $output)
    {
        $output->writeln('<info>Buzz</info>');
    }
    protected function showFizzBuzz(OutputInterface $output)
    {
        $output->writeln('<info>Fizz Buzz</info>');
    }
    protected function showNumber(OutputInterface $output, $number)
    {
        $output->writeln($number);
    }
    protected function numberGenerator($limit)
    {
        for ($i = 1; $i <= $limit; $i++) {
            yield $i;
        }
    }
}
