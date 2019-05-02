# Newsletter System

Installing the script:
1) Unzip and upload all files in a folder on your website. For example the name of the folder could be "SCRIPTFOLDER", so the URL to the script folder will be http://www.YOURDOMAIN.com/SCRIPTFOLDER/, where www.YOURDOMAIN.com is the domain name of your website;
2) Open http://www.YOURDOMAIN.com/SCRIPTFOLDER/installation.php. Installation wizard will ask you to complete the form with:
  a. Database connection details(MySQL server name, Database username and password, Database name);
  b. Server path, Full URL and Script directory name - these details are written into the form automatically, so you should only check if they are not correct
  c. Admin Username and Password
Then hit "Install Script" button. The wizard will create the database tables into the provided database and will save all the details from the form into allinfo.php file in the script folder.
3) Delete "installation.php" file
4) Login at http://www.YOURDOMAIN.com/script/admin.php


How to put the script on your webpage:
  a. Go to 'Put on WebPage' page and choose one of two ways(codes) to put the script on your website;
  b. Copy the code, go to your page and paste between <body> code </body> tags. If you choose second install option(php include) you should put this line of code <?php session_start(); ?> at the very top of the php page (first line of code);
Changing admin username and/or password. Changing database connection:
All the admin login details(username and password) and database connection details are stored in $CONFIG array into allinfo.php file on your website.

If, you want to change the admin username or password on a later stage you should:
  a. Download allinfo.php from the installed script folder on your website and open it;
  b. Find the two variables $CONFIG["admin_user"]='username'; and $CONFIG["admin_pass"]='password'; and change username and/or password ans save;
  c. Upload the modified allinfo.php to the script folder on your website;

