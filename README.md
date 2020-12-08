# CMPSC 431W Movie Recommendation System 
**Make sure the code that connects to server and DB**
```
$servername = "CMPSC431-S3-G-14.vmhost.psu.edu";

$mysql_username = "431group";

$mysql_password = "password";

$db = "431group_db";
```

**Connect SSH with group server address and your own psu id**
All project files will be inside of `/var/www/html` folder

**To access MySQL in the terminal**
`mysql -u 431group -p`
enter password:  #`password`

**To run the project on a web browser**
Navigate [here](http://cmpsc431-s3-g-14.vmhost.psu.edu/homepage/homepage.php)

**If you want to manually import the tables into our group server**
1. Get the SQL file exported from phpMyAdmin which has all table information and change the file name to `431group_db.sql`
2. `mysql -u 431group -p 431group_db < 431group_db.sql`
