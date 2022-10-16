# creditwatch

Files:

config.xml: Used to connect to the MySQL database
contact.php: Contact Us page with form that submits to "contactus" table in MySQL DB
dashboard_frame.html: Dashboard data page loaded in an iframe to be scrollable. Will be converted to php down the road.
dashboard.php: Dashboard page with menu and iframe. Checks login.
fetch.php: Test page for fetching data from the MySQL DB
index.html: Home page. More to be done
login.php: Login checks credentials against "users" table in MySQL DB
logout.php: Destroys login session and redirects to login page
notifications.php: Notifications page. More to be done. Checks login.
profile.php: Customer can update profile details; updates "contact" table in MySQL DB. Checks login.
register.php: Registration inserts new records into "users" and "contact" table for user creation. Password is hashed.
reset-password.php: Updates password in "users" table in MySQL DB. Checks login.
welcome.php: Post-login redirect page. Might end up redirecting directly to dashboard?
