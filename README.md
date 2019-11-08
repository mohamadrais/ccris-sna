# ccris-sna

### Prerequisites:
* [XAMPP](https://www.apachefriends.org/download.html) - Installation directory: `C:`. Example path to `htdocs`: `C:\xampp\htdocs`
* [Git](https://git-scm.com/downloads) (optionally [TortoiseGit](https://tortoisegit.org/download/) / [TortoiseSVN](https://tortoisesvn.net/downloads.html))
* Editor (such as [Visual Studio Code](https://code.visualstudio.com/download))
* Complete localhost MySQL setup by following "Setting up MySQL server" section below

### Local github repo setup: 
1. Once you have gained access as a contributor repository owner, clone to your local using below steps (or use client such as TortoiseGit or TortoiseSVN). Open Command Prompt:
```
cd C:\xampp\htdocs
git clone https://github.com/newhill/ccris-sna.git
```
2. Ensure you have XAMPP MySQL and Apache servers running and know the username and password for localhost MySQL db account
3. Open ccris-sna folder in Visual Studio Code and search for (`Ctrl+P`) `config.php` files. About 6 different config.php files should appear. You will need to change the `$dbUsername`, `$dbPassword` and `$dbDatabase` name according to your localhost setup in each of the `config.php` files. For `$adminConfig` array's `adminUsername` and `adminPassword` refer "Setting up MySQL server" section below for more info.
```php
<?php
	$dbServer = 'localhost';
	$dbUsername = 'root';           <-------- example
	$dbPassword = '';               <-------- example
	$dbDatabase = 'puffergr_pgs66'; <-------- example

	$adminConfig = array(
		'adminUsername' => "admin",                             <-------- refer below section "Setting up MySQL server"
		'adminPassword' => "21232f297a57a5a743894a0e4a801fc3",  <-------- refer below section "Setting up MySQL server"
```
4. Once correctly setup, you should be able to visit one any of the company login pages via http://localhost/ccris-sna/<company_short_name>. Example: For `pgs66`: it will be http://localhost/ccris-sna/pgs66 

### Instructions for setting up privileged user for localhost MySQL in Macbook
1. Go to http://localhost/phpmyadmin > click on `User accounts` tab > `Add user account`
2. Fill in your username and password. In this example we put `test` for both. Put `localhost` for hostname. In `Global privileges`: select `Check all`
3. Click `Go`.
4. You should now see the new account created in `User account` tab. Click on `Edit privileges`.
5. Click on `Database` tab > Press and hold `Shift` and select all the databases > Click `Go`.
6. In `Database-specific privileges` > select `Check all` > Click `Go`.
7. Back on `User accounts` tab > Click on `reload the privileges` in the bottom of the page.
8. Now finally update the config file `$dbUsername` and `$dbDatabase` according to the user created in step 2. 
9. Now you can visit one of the login pages such as for company `pgs66`: http://localhost/ccris-sna/pgs66 
10. Note: In Macbook, the `.htaccess` file in the `ccris-sna` folder may cause problem and cause step 9 to download `index.php` instead of displaying the login page. 
11. If this happens, replace the contents of `.htaccess` with below:
```php
# php -- BEGIN cPanel-generated handler, do not edit
# Set the “ea-php56” package as the default “PHP” programming language.
<IfModule mime_module>
    AddType application/x-httpd-php .php
    <FilesMatch \.php$>
        SetHandler application/x-httpd-php
    </FilesMatch>
    AddType application/x-httpd-php-source .phps
    <IfModule dir_module>
        DirectoryIndex index.php index.html
    </IfModule>
</IfModule>
# php -- END cPanel-generated handler, do not edit
```

### Setting up MySQL server
1. From this github project, download the `mysql-backup-10-27-2019-priggm80.zip` from `Backups` folder
2. Unzip the contents in your local which should give SQL files containing testing data with db structure from `priggm80` as of `10-27-2019`.
3. Open `C:\xampp\xampp-control.exe` > Start `Apache` and `MySQL` modules/ services
4. Go to http://localhost/phpmyadmin/ > click on `Databases` tab > `Create database` > Create the following databases:
```php
puffergr_arw04
puffergr_bsm01
puffergr_mio02
puffergr_pgs66
puffergr_pjd05
puffergr_sna00
```
5. After the databases are created, go to each `Database` tab > `Privileges` and assign `ALL PRIVILEGES` to your localhost MySQL user.
6. Go to http://localhost/phpmyadmin > click on `User accounts` tab > Click on `reload the privileges` in the bottom of the page.
7. Once done, go to each `Database` tab > `Import` and select the corresponding `.sql` file from `mysql-backup-10-27-2019-priggm80.zip` and click Go at the bottom of the page. Wait for each to finish running before continuing to next one.
8. Note: If you are unsure what is the admin password for a given company, you can manually update it here:
9. Go to respective `Database` from http://localhost/phpmyadmin > Select `membership_users` group > Search for `memberID` where `groupID` is 2 (`Admins`), take note of the `memberID` and change the `passMD5` to MD5 encrypted hash of your desired password.
10. For example, you can use an online tool such as [md5online](https://www.md5online.org/) to generate the hash.
11. Then, you will need to update the `adminConfig` in the corresponding `config.php` file for the given database (see section "Local github repo setup" point 3.) accordingly:
```php
$adminConfig = array(
		'adminUsername' => "admin",                              <-------- example (refer step 9 above)
		'adminPassword' => "21232f297a57a5a743894a0e4a801fc3",   <-------- example (given here is md5 hash for the word "admin")
```
