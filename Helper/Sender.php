<?php


namespace App\Sociaqui\DataSenderBundle\Helper;


class Sender
{
    /**
     * Sends data to Google Sheets.
     *
     * @param array $data an array containing data to be sent.
     *
     * @return int the number of rows processed
     *
     */
    public static final function loadDataFromFile(array $data){
        $rows = 0;
        foreach($data as $row){
            //TODO: implement the actual sending
            $rows++;
        }
        return $rows;
    }
}