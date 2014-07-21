<?php

namespace Hnw\FizzBuzz\Tests;

use Hnw\SingleSubcommandConsole\Application;
use Hnw\FizzBuzz\FizzBuzzCommand;
use Symfony\Component\Console\Tester\ApplicationTester;

class FizzBuzzTest extends \PHPUnit_Framework_TestCase
{
    public function testNoLimit()
    {
        $app = new Application();
        $app->add(new FizzBuzzCommand());
        $app->setAutoExit(false); // For testing

        $tester = new ApplicationTester($app);
        $tester->run(array(), array('decorated' => false));
        $this->assertContains("16", $tester->getDisplay(true));
        $this->assertNotContains("101", $tester->getDisplay(true));
    }

    public function testLimit()
    {
        $app = new Application();
        $app->add(new FizzBuzzCommand());
        $app->setAutoExit(false); // For testing
        
        $tester = new ApplicationTester($app);
        $tester->run(array('--limit' => '15'), array('decorated' => false));
        $this->assertContains("14", $tester->getDisplay(true));
        $this->assertContains("Fizz Buzz", $tester->getDisplay(true));
        $this->assertNotContains("16", $tester->getDisplay(true));
    }
}