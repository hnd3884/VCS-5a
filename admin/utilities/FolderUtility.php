<?php

class FolderUtility{
    public static function DeleteDir($dir){
        if(is_dir($dir)){
            $objects = scandir($dir);
            foreach ($objects as $object){
                if($object != "." && $object != ".."){
                    if(is_dir($dir.DIRECTORY_SEPARATOR.$object) && !is_link($dir."/".$object)){
                        rmdir($dir.DIRECTORY_SEPARATOR.$object);
                    }
                    else{
                        unlink($dir.DIRECTORY_SEPARATOR.$object);
                    }
                }
            }
            rmdir($dir);
        }
    }
}