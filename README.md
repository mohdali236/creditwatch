# creditwatch <br />
 <br />
Files: <br />
 <br />
contact.php: User support page with form that submits to "contactus" table in CW DB <br />
dashboard.php: Dashboard page with menu and fraud detail cards from USER DB. <br />
login.php: Main page. Checks credentials against CW DB <br />
logout.php: Destroys login session and redirects to login <br />
notifications.php: Notifications page. Will pull from notification table on USER DB. <br />
payments.php: Payment portal for logged in users. Pulls total due and due date. CC only. <br />
profile.php: User can update profile details; updates "contact" table in USER DB. <br />
register.php: Registration inserts new records into "users" and "contact" table for user creation. Password is hashed. <br />
reset-password.php: Updates password in "users" table in MySQL DB. Checks login and security question. <br />
welcome.php: Post-login redirect page. Used for product activation at this time.<br />
upload-data.php: Upload page that puts files in the data folder. File type (CSV only) and size (>20MB) are checked.<br />
eventdrilldown.php: Detailed fraud results with export to CSV option.<br /><br />

fraudDetect/src - C++ binary application for processing transaction data for fraud<br />
&nbsp;&nbsp;To build fraudDetect<br />
&nbsp;&nbsp;&nbsp;&nbsp;make fraudDetect/src<br />
&nbsp;&nbsp;&nbsp;&nbsp;make --build fraudDetect/src

Running it needs a server. Server currently hosted on 
https://ohmydar.win/creditwatch/login.php
