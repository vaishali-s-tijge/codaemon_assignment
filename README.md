# codaemon_assignment

This source code uses codeigniter framework and contains "Customer Management" module.

Steps for setup & installation:
1. Download the repository files into your web root directory
2. Create database named "codaemon_customer"
3. Import database ".sql" file from directory "db_schema"
4. Change the config settings into "application/config/config.php" & "application/config/database.php"
5. Open browser and run the application base url to execute index file.
6. Do not forget to add .htaccess file which is hidden in root directory

****************************************
Brief About the Application : 

Database: mysql

table name: customer
columns: c_id, c_name, c_email, c_address, c_zip, c_telephone, c_dob (date of birth).

****************************************
View is divided into two section

top section: has a search with the following filters
1) Name (text box)
2) Email (text box)
3) Age (drop down with options "less than 25 years", "greater than or equal to 25 years"
4) "search/submit" button

Bottom section: Shows List of all customers (all details) matching the search criterion with pagination, with 5 records in each page

********************************************

