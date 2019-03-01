<?php
namespace test\commands;

use saintxak\commands\ICommand;
use saintxak\commands\CommandException;

use saintxak\ReportBuilder;

class Report implements ICommand{
    
    public function getName(){
        return 'report';
    }

    public function run(array $args=[]){
        $ser_data = file_get_contents("last_search.dat");
        $el = unserialize($ser_data);

        echo __DIR__.DIRECTORY_SEPARATOR.ReportBuilder::createReport($el,'csv','images.csv')."\n";
    }
}