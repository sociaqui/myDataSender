<?php


namespace App\Sociaqui\DataSenderBundle\Helper;


class Archiver
{
    /**
     * Saves the data to a local Database.
     *
     * @param array $data an array containing data to be sent.
     *
     */
    public static final function saveDataToDatabase(array $data){
        foreach($data as $row){
            //TODO: implement the actual saving
        }
    }

    /**
     * Moves the uploaded file to the archive.
     *
     * @param string $file      the path of the file to be transferred.
     * @param string $location  the path to the archive location.
     *
     */
    public static final function saveFileToArchive(string $file, string $location){
        //TODO: implement the actual file relocation
    }

}