<?php
namespace test\commands;

use saintxak\commands\ICommand;
use saintxak\commands\CommandException;

use saintxak\filters\ImageFilter;
use saintxak\WalkerBuilder;

use test\elements\ImageElement;

class Parser implements ICommand{

    public function getName(){
        return 'parse';
    }

    public function run(array $args=[]){
        $walker = WalkerBuilder::buildFromURL($args[0]);
        
        $imgFilter = new ImageFilter();

        $walker->addFilter($imgFilter);
        $elements = [];

        while (($res = $walker->getNext()) !== false){
            //create elements by res
            foreach ($res as $link=>$results){
                foreach ($results as $uris){
                    foreach ($uris as $uri){
                        if (is_array($uri)) continue;
                        
                        $img = new ImageElement();
                        $img->src = $uri;
                        $img->page = $link;
                        $elements[] = $img;
                    }
                }
            }
        }

        //serialize elements and save to hd
        file_put_contents('last_search.dat', serialize($elements));
    }

}