<?php


namespace App\Sociaqui\DataSenderBundle\Helper;


interface DataLoader
{
    /**
     * Loads data from a file
     *
     * @param string $name The file name (complete with relative path from project root).
     *
     * @internal The connection can be only instantiated by the driver manager.
     *
     */
    public static function loadDataFromFile($name);
}