# myDataSender
A very simplistic Symfony 3+ Bundle that sends data from a .json file to a Google Spreadsheet

### Requirements
This is mostly a self-contained Bundle. It just requires that you have a working Symfony 3+ installation. With a configured MySQL 5.7+ ([JSON Data Type](https://dev.mysql.com/doc/refman/5.7/en/json.html) support) database.

### Installation

Make sure Composer is installed globally, as explained in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

Just clone / download / copy the project into your Symfony installation. Remember to create a new, empty folder named Sociaqui if you haven't added any of my other Bundles before. You should end up with the following structure:
```
[Symfony project root]/src/Sociaqui/DataSenderBundle/
```

Remember to enable the new Bundle by adding the following line:
```
App\Sociaqui\DataSenderBundle\SociaquiDataSenderBundle::class => ['all' => true],
```
to the `config/bundles.php` file

##### Installing the dependencies
Since this pet project is not yet officially listed in the Packagist you will have to add this snippet to your composer.json file before running `composer require sociaqui/data-sender-bundle:*@dev` form your Symfony project root location.
```
"repositories": [
    {
        "type": "path",
        "url": "src/Sociaqui/DataSenderBundle"
    }
]
```

##### Configuring local environment variables
<!---
TODO: make an install script instead
--> 
Copy the contents of the `Resources/config/.env.local.php.dist` file to your `.env.local.php` file located at the Symfony project root (if you don't have one yet generate it using the `composer dump-env prod` command) and fill in the proper values for all the required environment variables.
<!---
TODO: database section
--> 

### Usage
from your Symfony project root simply run the command:
```
php bin\console sociaqui:send-data
```

### Licence
This project was created under a [MIT Licence](Resources/meta/LICENSE)