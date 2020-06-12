<?php

namespace App\Console\Commands;

use App\Console\Command;
use App\Controllers\ProductsController;

class Import implements Command
{
    public function start($args)
    {
        $path = $args[0];
        if( file_exists( $path ) && count(scandir($path)) > 2)
        {
            if ( $handle = opendir($path) ) {
                
                echo "\033[36mImport started.\033[37m \n";
                echo "\033[36mImporting...\033[37m \n";

                $import_files = [];
                $only_xml = true;

                while (false !== ($file = readdir($handle))) {
                    
                    if ($file != "." && $file != ".."){
                        
                        $only_xml = !$this->onlyXml($file) ? false : $only_xml;

                        if ( $this->onlyXml($file) )
                        {
                            $xml = simplexml_load_file($path."/".$file);

                            ProductsController::import($xml);
                        }
                    }
                }
            
                closedir($handle); 

                if ($only_xml) echo "\033[32mDone.\033[37m";
                else echo "\033[33mSome files not read.\033[37m";
            }

        }
        else{
            echo "\033[31mThe directory does not exist or is empty.\033[37m";
        }
    }

    protected function getFileExtension($filename) {
        $file_info = pathinfo($filename);
        return $file_info['extension'];
    }

    protected function onlyXml($filename) {
        return $this->getFileExtension($filename) == 'xml' ? true : false;
    }
}
