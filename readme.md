# Introduction 
GBBMS is a Blood Bank Management System developed using PHP framework called Laravel.
This system consists of three main modules which are "Donor Module", "Nurse Module
and "HR Manager Module". 

It is a web application capable of registering donors, adding upcoming blood donation events, performing blood donation booking/cancellation, maintaining staffs details, view lists of informations and generating PDF reports. 

# Development Technologies
The system are developed and tested using the following technologies:
- Editor: [Visual Studio Code Version 1.22](https://code.visualstudio.com/download "VS Code")
- Laravel: [Laravel 5.6.16](https://laravel.com/ "Laravel")
- Database:  MariaDB 10.1.31 (XAMPP package)
- Server: Apache/2.4.29 (Win32) (XAMPP package)
- PHP: PHP 7.2.4 (XAMPP package)
- XAMPP: [XAMPP 7.2.4 / PHP 7.2.4](https://www.apachefriends.org/download.html "XAMPP")
- Composer: PHP Package Manager [Composer v1.6.4](https://getcomposer.org/download/ "Composer")
- Tested on browser: [Mozilla Firefox version 59.0.2 (64-bit)](https://www.mozilla.org/en-US/firefox/new/)
- Tested screen resolution: Full HD 1920x1080 60Hz and mobile resolution 414x736

It is highly recommended that user should fulfill the requirements above in order to fully deploy the application. 
In addition, user’s browser should have javascript enabled in order for certain features to fully operate.

While the tested screen resolution are 1920x1080 and 414x736, the webpages are designed to be responsive on majority
of the mobile devices. 

# Installation (Windows)
The following steps are to install all the dependencies and XAMPP server in order to fully run this web application:

## XAMPP Setup
1. Download XAMPP from the link above and install XAMPP server bundle by running the executable installer file. Click "next" until XAMPP has completely installed. Launch the XAMPP Control Panel after the installation.

    Note: XAMPP 7.2.4 already included PHP 7.2.4, MariaDB 10.1.31 and Apache/2.4.29 server.

## Composer Setup
1. Download composer from the link above and install composer by running the executable installer file for Windows. On "Choose the command-line PHP you want to use", select the "`php.exe`" found in the PHP folder inside the XAMPP directory. E.g "`C:\xampp\php\php.exe`".

## XAMPP - Virtual host configuration
1. Setup the virtual host file by going into the apache config folder inside your XAMPP directory. E.g "`C:\xampp\apache\conf\extra`". Open "`http-vhosts.conf`" with notepad or any text editor. 

    Add the following line at the end of the file and save it:
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/GBBMS/public"
    ServerName localhost
</VirtualHost>
```

2. Restart Apache from the XAMPP Control Panel by pressing "stop" and then "start".

### - Optional Steps
If you wish you change the "ServerName" to other names. E.g. "gbbms.com". You are required to change the windows hosts file.

Edit your hosts file in the "`C:\Windows\System32\drivers\etc\hosts`" directory by adding the following line at the end. After adding the line below, save and close the hosts file.
    
**NOTE: PLEASE run notepad or the text editor as administrator**, otherwise windows does not allow saving of the "hosts" file.

```
127.0.0.1   gbbms.com
```

When the domain "gbbms.com" is entered in the URL bar, it will point to the localhost address instead of lookup the domain on the public Domain Name Server (DNS). Thus, the localhost GBBMS application will be served under the URL "`http://gbbms.com`" instead of "`http://localhost`".

## GBBMS Setup
1. Open command prompt (CMD) and change directory to the `htdocs` folder inside your XAMPP directory. E.g "`cd C:\xampp\htdocs\`". This is the folder where all the web application will be served.

2. Clone this GBBMS repository by running "`git clone https://github.com/StarmanW/GBBMS.git`" or simply download as zip and then unzip the files into the htdocs folder.

3. After that, change directory to the `GBBMS` folder by executing "`cd C:\xampp\htdocs\GBBMS`" in your command prompt (CMD).

4. Install all the dependencies/packages by running "`composer install`" in the command prompt (CMD).

5. After composer has finished the installation of the required packages, copy the "`.env.example`" file and rename it to "`.env`". **It is recommended** by running this "`copy .env.example .env`" command in the command prompt (CMD).

6. Open the `.env` file in a text editor and modify the values accordingly:

```
APP_NAME="GBBMS"
APP_DEBUG=false
...
DB_DATABASE=gbbms
DB_USERNAME=root
DB_PASSWORD=
...
MAIL_DRIVER=smtp
MAIL_HOST=<your mail host here>
MAIL_PORT=<Mail port here>
MAIL_USERNAME=<email here>
MAIL_PASSWORD=<password here>
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="Support Staff"
```

7. Genrate an application key by executing "`php artisan key:generate`" in the command prompt (CMD). A success message "`Application key [base64:random strings] set successfully`" will be shown afterwards. 

    Note: The generated application key will be stored in the `.env` file under `APP_KEY=` variable.

8. Execute "`php artisan storage:link`" in the command prompt (CMD) in order to create a symbolic link to the storage folder. This is to link the "`profileImage`" folder so the profile images can be displayed on the appliation. A success message "`The [public/storage] directory has been linked.`" will be shown afterwards.

## Database setup
1. Go to XAMPP Control Panel and click on the "Admin" button for MySQL. A webpage will be launched on your browser with the URL "http://localhost/phpmyadmin".

2. Create a new database by clicking "New" on the top-left of the side bar. A create database page will be displayed. Enter "`gbbms`" for the database name field and leave the second field as "collation". Click on "Create" button and the `gbbms` database will be created.

3. After the `gbbms` database has been created, navigate to the top bar and click on "Import" (should be the 6th tab option from left) and an 'Importing into the database "gbbms"' page will be displayed. 

4. Download the dummy data **[here](https://gist.github.com/StarmanW/5fcaa8ea4fe2ca0f81485d75a082a27f)**. Select "browse" on the Import page and upload the downloaded SQL script. After that, click "Go" at the left-bottom of the page to execute the uploaded SQL script. 

# Sample Login Credentials
The table below are the sample login credentials for 3 different accounts: Donor, HR manager and Nurse.

|Position|Email|Password|
|-|-|-|
|Donor|jamesdonn@example.com|123456789|
|HR Manager|federickjohn@example.com|123456789|
|Nurse|michelle@example.com|221312312312|

Note: Password for other nurses are simple based on their ICNum

# Conclusion
Finally, you have successfully setup GBBMS web application! Now you can go to your browser and enter "`localhost`" or "`http://localhost`" in the URL bar and the index page will be displayed.

If you have any further questions or issues on installation or about this web application, feel free to contact me. Enjoy and happy donating!
