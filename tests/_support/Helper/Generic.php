<?php
namespace Helper;

use Codeception\TestInterface;

class Generic extends \Codeception\Module
{
    public function _before(TestInterface $test)
    {
        $symfony = $this->getModule('Symfony');

        $symfony->runSymfonyConsoleCommand('doctrine:database:drop',['--if-exists'=>true, '--force'=>true]);
        $symfony->runSymfonyConsoleCommand('doctrine:database:create');
        $symfony->runSymfonyConsoleCommand('doctrine:migrations:migrate', ['--no-interaction'=>true]);

        parent::_before($test);
    }
}