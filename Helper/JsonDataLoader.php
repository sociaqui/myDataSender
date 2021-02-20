<?php


namespace App\Sociaqui\DataSenderBundle\Helper;


class JsonDataLoader implements DataLoader
{
    /**
     * @inheritDoc
     */
    public static final function loadDataFromFile($name){
        $contents = file_get_contents($name);
        $data = json_decode($contents, true);
        return $data;
    }
}