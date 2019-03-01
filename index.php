#!/usr/bin/env php
<?php
define('DS',DIRECTORY_SEPARATOR);
require_once __DIR__.DS.'vendor/autoload.php';

$cmd = new saintxak\commands\CommandDispatcher();

$cmd->add(new test\commands\Parser())
    ->add(new test\commands\Report())
    ->add(new test\commands\Help());

if (!$cmd->dispatch()){
    $cmd->call('help');
}