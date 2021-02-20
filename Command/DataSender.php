<?php


namespace App\Sociaqui\DataSenderBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DataSender extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'sociaqui:send-data';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Sends data to Google Sheets.')

            // the full command description shown when running the command with the "--help" option
            ->setHelp('Sends all the data contained in any .json files found in the configurable input location to
            a Google Sheet determined by the sheetId parameter. The data is also saved to the local DB. The files are 
            then moved to a temporary archive or deleted.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $error = false;

        //TODO: configurable file location -> make config
        //TODO: iterate over all files - only load .json files
        //TODO: parse data from file -> separate helper
        //TODO: send data to google -> separate helper
        //TODO: save data to DB -> use Symfony ORM? or own separate helper
        //TODO: copy file to configurable temporary file archive location (or delete file) -> make config
        //TODO: Track Memory Usage and Runtime of Command

        if ($error) {
            //TODO: output and log any problems found
            $io->error($error);
            return Command::FAILURE;
        } else {
            //TODO: output duration, memory used, operation status, number of processed lines
            $io->success('Done');
            return Command::SUCCESS;
        }
    }
}