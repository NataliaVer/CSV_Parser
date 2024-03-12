<p align="center">CSV Parser</p>

<p align="center">
With it you can import csv file and export from database
</p>

<p>
It use Laravel 10 and Bootstrap 5
for SQL server I use MAMP 6
</p>

## About

After clone repository you need use command:
1. composer install
2. npm install
   
and change .env file

3. php artisan migrate

For big file I change php.ini file:
1) post_max_size = 2G
2) upload_max_filesize = 1G
3) memory_limit = 3G
4) max_execution_time = 300
