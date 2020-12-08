# CMPSC 431W Movie Recommendation System 

### To run on localhost
Use code from branch `main` and navigate to [here](http://localhost/cmpsc431w-movie-recommendation-system/login/login.html)

### To run on PSU server
Use code from branch `server_test` and navigate to [here](http://cmpsc431-s3-g-14.vmhost.psu.edu/homepage/homepage.php)

### PSU DB and Server Details
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

### To use profile picture feature
Make sure to grant read and write access on your localhost to the file `profile/save.php` and the folder `profile/photo/`

### To manually import the database into our group server
1. Get the SQL file exported from phpMyAdmin or in [Google Drive](https://drive.google.com/drive/u/0/folders/1WYMBHZyiO05u6fxfW2Z009btc3yXLZJ0) which has all table information and make sure the file name is `431group_db.sql`

2. `mysql -u 431group -p 431group_db < 431group_db.sql`

### SERVER URL
`http://cmpsc431-s3-g-14.vmhost.psu.edu/login/login.html`
