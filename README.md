<h1 align="center">Test Project</h1>

<p align="center">
</p>

## About



## Before Installing This Project

<p align="justify">
    You need to make sure that you're using PHP 8.1 for the minimum version, then you will need to install some other tools like, Git for cloning this project into your local server directory, Composer for managing php package and installing some others package that will be needed. Also, you should make sure that you have enabled the following php extension in php.ini configuration file, such as:
</p>

- php_zip
- php_xml
- php_gd2
- php_iconv
- php_simplexml
- php_xmlreader
- php_zlib

## Installation Instruction

1. Clone this project and `cd` into the cloned project by using this following this command:
   
   ```shell
    git clone https://github.com/viernism/aku_crud.git && cd aku_crud
   ```

2. After that, you'll need to copy `.env.example` into `.env` file and installing components from `composer` by using this following command:

    ```shell
    cp .env.example .env && composer install
    ```

3. Now, after that installing components from `composer` completed, you need to generate key by using this following command:
   
   ```bash
    php artisan key:generate
   ```

4. Now, you will need to set up your database. It's better to use database engine like PostgreSQL or MySQL. You can change it on your `.env` file, for example we are using MySQL. then, you can configure it like this, but remember to configure it based on your server settings.

    <img src="https://raw.githubusercontent.com/rhnnnn/mulmed-sheet/main/Screenshot_20230417_103526.png">


5. Before migrating the tables, you will need to set up an admin user in user seeder


6. Run this following command to migrate all needed table.
   
   ```bash
   php artisan migrate
   ```
