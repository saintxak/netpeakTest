<?php
namespace test\commands;

use saintxak\commands\ICommand;
use saintxak\commands\CommandException;

use saintxak\filters\ImageFilter;
use saintxak\WalkerBuilder;
use saintxak\request\http\CURL;

use test\elements\ImageElement;

class Parser implements ICommand{

    public function getName(){
        return 'parse';
    }

    public function run(array $args=[]){
        $walker = WalkerBuilder::buildHttpWalker($args[0]);
        
        $curl = new CURL();
        $walker->getRequest()->setDriver($curl);

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