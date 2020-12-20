### REQUIREMENTS FOR START PROJECT

    -COMPOSER -V >=1.9.0
    -PHP -V >=7.2

# Instructions
             
## Config

    Set in ./config.php
    
    connectionDatabaseParams
    
 ```
 Example: 
 'connectionDatabaseParams' => [
         'host' => 'localhost',
         'user' => 'root',
         'password' => 'root',
         'database' => 'qtx',
     ]
 ```
    
 ### Run on root of project
 
     1. composer install
     1. CREATE database and import file from DOCS/qttestdb.sql 
     2. php -S localhost:8080