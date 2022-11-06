# creditwatch <br />
 <br />
Files: <br />
 <br />
config.php: Used to connect to the MySQL database <br />
contact.php: Contact Us page with form that submits to "contactus" table in MySQL DB <br />
dashboard.php: Dashboard page with menu and fraud detail cards. Checks login. <br />
fetch.php: Test page for fetching data from the MySQL DB <br />
index.html: Home page. More to be done <br />
login.php: Login checks credentials against "users" table in MySQL DB <br />
logout.php: Destroys login session and redirects to login page <br />
notifications.php: Notifications page. More to be done. Checks login. <br />
payments.php: Payment portal for logged in customers. Pulls total due and due date. <br />
profile.php: Customer can update profile details; updates "contact" table in MySQL DB. Checks login. <br />
register.php: Registration inserts new records into "users" and "contact" table for user creation. Password is hashed. <br />
reset-password.php: Updates password in "users" table in MySQL DB. Checks login and security question. <br />
welcome.php: Post-login redirect page. Might end up redirecting directly to dashboard?<br />
upload-data.php: Upload page that puts files in the data folder. File type (CSV only) and size (>20MB) are checked.<br /><br />

src/fraudDetect - C++ binary application for processing transaction data for fraud<br />
To build fraudDetect:<br />
    make src/fraudDetect<br />
    make --build src/fraudDetect
