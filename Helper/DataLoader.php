<?php


namespace App\Sociaqui\DataSenderBundle\Helper;


interface DataLoader
{
    /**
     * Loads data from a file
     *
     * @param string $name The file name (complete with relative path from project root).
     *
     */
    public static function loadDataFromFile(string $name);
}