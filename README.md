Visitor Registration System

## page routes
Visitor registration page - no auth\
/visitor/register \
e.g http://visitor-app.test/visitor/register

Admin route - auth - login required

admin login (see point #5 below - need to seed a admin user) \
/admin/login \
e.g http://visitor-app.test/admin/login

- admin dashboard \
/admin/dashboard \
e.g http://visitor-app.test/admin/dashboard

- admin view visitors list \
/admin/visitor \
e.g http://visitor-app.test/admin/visitor

- visitor details
/admin/visitor/{id}
e.g http://visitor-app.test/admin/visitor/2

- admin checkout visitor 
e.g http://visitor-app.test/admin/visitor/2 -> click checkout button


## Steps to setup

1. git clone from \
git clone https://github.com/PwtanSG/visitor-app.git

2. duplicate .env.example to .env

3. setup mySQL with \
DB_DATABASE=visitordb

4. generate APP_KEY for .env \
php artisan key:generate

5. seed AdminSeeder - for admin user login \
php artisan make:seeder AdminSeeder