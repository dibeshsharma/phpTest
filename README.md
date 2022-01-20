/*
* This Project is written by
* Programmer/Web Developer 
* Dibesh Sharma <https://github.com/dibeshsharma>
* for the test purpose
*/

Scope:
The project is written in php. 
The project is capable of executing php scripts from the command line.

To run the commands, move to the root directory of the project and run the command. For example:
phpTest> php console.php create_table

where phpTest> is the root folder.

The registered commands and functionalities are below:

1) php console.php printNumbers

The command outputs the numbers from 1 to 100 like

1, 2, foo, 4, bar, foo, 7, 8, foo, bar, 11, foo, 13, 14, foobar, 16, 17, foo, 19, bar, foo, 22, 23, foo, bar, 26, foo, 28, 29, foobar, 31, 32, foo, 34, bar, foo, 37, 38, foo, bar, 41, foo, 43, 44, foobar, 46, 47, foo, 49, bar, foo,
52, 53, foo, bar, 56, foo, 58, 59, foobar, 61, 62, foo, 64, bar, foo, 67, 68, foo, bar, 71, foo, 73, 74, foobar, 76, 77, foo, 79, bar, foo, 82, 83, foo, bar, 86, foo, 88, 89, foobar, 91, 92, foo, 94, bar, foo, 97, 98, foo, and bar.

where the number divisible by three (3) is “foo”
where the number divisible by five (5) is “bar”
where the number divisible by three (3) and five (5) is foobar

2) php console.php create_table

The command creates the MySQL users table, 
if success, it displays the message - Users table created successfully
On error, it displays the error message (for example : Error creating users table: Table 'users' already exists) 

3) php console.php app:parse-file --file users.csv -u root -p password --host localhost

In above command, 
users.csv is the csv file name that needs to be parsed ( csv file needs to be inside the uploads directory)
root is the MySQL username
password is the MySQL password, use " " for blank password
localhost is MySQL host

For successful credentials, the command parse the csv file, iterate through the CSV rows and insert each record into the users table in the database.
For invalid credential, it displays the error message.

Name and surname field are capitalized e.g. from “john” to “John” before being inserted into DB.
Emails are validated and set to lower case before being inserted into DB.
data are sanitized before being inserted into DB.
Sql injections - attack are being taken care of.
for each row insert, success or error messages are being displayed on command console.

4) php console.php app:parse-file --file users.csv --dry_run

In above command,
users.csv is the csv file name that needs to be parsed ( csv file needs to be inside the uploads directory)
--dry_run is the option that parses the csv file, iterate through the CSV rows and print each record to the command console.

Environment and dependencies:

The project uses the following dependencies :
1) "phpoffice/phpspreadsheet": "^1.21",
2) "symfony/console": "^6.0",
3) "ext-mysqli": "*"

The namespace conventions are psr-4 standard.
The dependencies can be found in composer.json file. 

The vendor directory is ignored. 
Run composer.json to get the dependencies (vendor directory)

uploads directory is the directory where the csv file that needs to be parsed are placed.
Executable permissions for uploads directory needs to be set prior to run the project.

How to run the project:
1) Clone the directory
2) Run the composer.json to get the vendor directory
3) Set the uploads directory permission (read, write and executable)
4) put the csv file (users.csv in this case) inside the uploads directory
5) update your database credentials in 2 files
   
a) phpTest > src > Database > DbHandler.php

Change the code with your MySQL credentials : (line 15-18)

`   protected $db_host = 'localhost';
   protected $db_username = 'root';
   protected $db_password = '';
   protected $db_name = 'php-test';`
      
b) phpTest > src > Command > ParseCsvFile.php

Change the "php-test" with your "database_name"  : (line 123)

`if(mysqli_connect($host, $username, $password, "php-test")){`

6) Go to the root directory of the project (i.e. phpTest>) and run the commands from the scope section above.























