# CMPSC 431W Movie Recommendation System 

### Make sure the code that connects to server and DB
```
$servername = "CMPSC431-S3-G-14.vmhost.psu.edu";

$mysql_username = "431group";

$mysql_password = "password";

$db = "431group_db";
```

### Connect SSH with group server address and your own psu id
All project files will be inside of `/var/www/html` folder

### To access MySQL in the terminal
`mysql -u 431group -p`

 password:`password`

### To run the project on a web browser
Navigate [here](http://cmpsc431-s3-g-14.vmhost.psu.edu/homepage/homepage.php)

### If you want to manually import the database into our group server
1. Get the SQL file exported from phpMyAdmin or in [Google Drive](https://drive.google.com/drive/u/0/folders/1WYMBHZyiO05u6fxfW2Z009btc3yXLZJ0) which has all table information and make sure the file name is `431group_db.sql`

2. `mysql -u 431group -p 431group_db < 431group_db.sql`
