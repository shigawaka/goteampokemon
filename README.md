## About

This web application is powered by Laravel 9 and VueJS 3 as the backend framework and frontend framework. 

## Pre-requisites installations

- [PHP ^8.0.2 above versions]
- [Composer]
- [npm]
- [Create database schema named 'goteampokemon' and whatever you like as long as it's newly created DB schema]
- [Download and run MailHog: ](https://github.com/mailhog/MailHog/releases)
  - [In your env file, change your MAIL_HOST to localhost]


## Instructions

If you have completed above installations follow below:

1. Download the source file: https://github.com/shigawaka/goteampokemon/archive/refs/heads/master.zip
2. Go to the downloaded file and extract the files.
3. Open CLI and locate where the extracted files is. Example: C:\Users\PC\Downloads\goteampokemon-master\goteampokemon-master
4. Enter command in CLI: ``` composer install ``` (These will install all the dependencies in composer.json)
5. Enter command in CLI: ``` npm install ``` (These will install the packages)
6. Check if laravel is installed and version is ^9.26.1 by typing in CLI: ``` php artisan --version ```
7. If installed properly, next thing is to create .env file
	* You can copy file .env.example and remove the '.example'
8. Create APP_KEY in .env by running this command in CLI:  ``` php artisan key:generate ```
9. Now, in order for the app to properly work locally we need to run these:
	* a. enter command in CLI: ``` php artisan serve ```
	* b. open another CLI with the same location and enter command: ``` npm run dev ```
	* c. run mailhog app by clicking .exe file, it should open a CLI 
	      - Open your browser and check url depending on your port. (In my case, ``` localhost:8025 ```)
10. If you have done everything correctly above, you can now try the app (In my case, ``` localhost:8000 ```)


