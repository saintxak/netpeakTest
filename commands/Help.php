<?php
namespace test\commands;

use saintxak\commands\ICommand;
use saintxak\commands\CommandException;

class Help implements ICommand{
    
    public function getName(){
        return 'help';
    }

    public function run(array $args=[]){
        echo "Usage:\n\n";

        echo "index.php parse domain name]\n";
        echo "index.php report domain name [type] - where type by default is csv\n";
        echo "index.php help - view this message\n";
    }
}