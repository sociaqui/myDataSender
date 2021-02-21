<?php


namespace App\Sociaqui\DataSenderBundle\Command;


use App\Sociaqui\DataSenderBundle\Helper\Archiver;
use App\Sociaqui\DataSenderBundle\Helper\JsonDataLoader as Loader;
use App\Sociaqui\DataSenderBundle\Helper\Sender;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DataSender extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'sociaqui:send-data';

    private $params;

    public function __construct(ContainerBagInterface $params)
    {
        $this->params = $params;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Sends data to Google Sheets.')

            // the full command description shown when running the command with the "--help" option
            ->setHelp('Sends all the data contained in any .json files found in the configurable input location to
            a Google Sheet determined by the sheetId parameter. The data is also saved to the local DB. The files are 
            then moved to a temporary archive or deleted.')
            ->addArgument('SheetID', InputArgument::OPTIONAL, 'Google Sheet ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $error = false;

        //get the location of the input file/files
        $basePath = $this->params->get('kernel.bundles_metadata')['SociaquiDataSenderBundle']['path'];
        //TODO: find out why environment variables didn't work as expected
//        $locationTest = getenv('INPUT_FOLDER_PATH');
        $inputLocation = $basePath . "\Resources\public\input";

        //iterate over all files found at configured location - only load .json files
        $files = scandir($inputLocation);
        foreach ($files as $filename) {
            $file = $inputLocation . DIRECTORY_SEPARATOR . $filename;
            //check file type
            $type = mime_content_type($file);
            //check file extension
            $path_parts = pathinfo($file);
            $extension = $path_parts['extension'];
            if ($type === 'text/plain' && $extension === 'json') {
                //load data from file
                $data = Loader::loadDataFromFile($file);

                //get the Sheet ID
                $sheetId = $input->getArgument('SheetID');
                if (!$sheetId) {
                    //if no argument given get deafault value - can be modified to ask user for input instead
                    //TODO: find out why environment variables didn't work as expected
//                    $sheetId = getenv('DEFAULT_SPREADSHEET_ID');
                    $sheetId = '1zQ43f8eENwOwFyUrraYHM5SNKMwrOyJnAJX66xy7p0';
                }

                //TODO: send data to google -> separate helper
                $rows = Sender::sendDataToGogle($data);

                //TODO: save data to DB -> use Symfony ORM? or own separate helper?
                Archiver::saveDataToDatabase($data);

                //do we archive the whole file?
                //TODO: find out why environment variables didn't work as expected
                //$archive = getenv('ARCHIVE_FILES');
                $archive = true;
                if ($archive) {
                    //get the location of the file archive
                    $basePath = $this->params->get('kernel.bundles_metadata')['SociaquiDataSenderBundle']['path'];
                    //TODO: find out why environment variables didn't work as expected
//                    $locationTest = getenv('ARCHIVE_FOLDER_PATH');
                    $archiveLocation = $basePath . "\Resources\public\archive";
                    Archiver::saveFileToArchive($file, $archiveLocation);
                } else {
                    unlink($file);
                }
            }
        }

        //TODO: Track Memory Usage and Runtime of Command

        if ($error) {
            //TODO: output and log any problems found
            $io->error($error);
            return Command::FAILURE;
        } else {
            //TODO: output duration, memory used, operation status, number of processed lines
            $io->title('Operation finished');
            $io->text('number of processed lines: ' . $rows);
            $io->success('Done');
            return Command::SUCCESS;
        }
    }
}