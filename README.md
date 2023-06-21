## Visitor Management System - using Laravel, Bootstrap and MySQL
Deployed to AWS EC2 http://52.221.183.219/

## Features
    - Deployed to AWS EC2 http://52.221.183.219/
    - Visitor registration page to fill name, email, contact, transport, purpose and supporting doc upload(optional)  
    - Visitor registration page added Google ReCaptcha and upload supporting document(if any) (AWS-S3)
    - Contact us form - send email to admin
    - Admin login  
    - Admin Dashboard - track today's visitors count, monthly count
    - Admin page to view list of all visitors, with filter, search feature and download list in pdf or Excel 
    - Admin page to checkout visitor  

## Page routes
**Visitor registration page - no auth** \
    - /visitor/register
    - e.g http://visitor-app.test/visitor/register

**Admin route - auth - login required** \
    - admin login (see point #5 below - u need to seed a admin user) \
    - /admin/login \
    - e.g http://visitor-app.test/admin/login

**admin dashboard** \
    - /admin/dashboard
    - e.g http://visitor-app.test/admin/dashboard

**admin view visitors list** \
    - /admin/visitor
    - e.g http://visitor-app.test/admin/visitor

**visitor details** \
    - /admin/visitor/{id}
    - e.g http://visitor-app.test/admin/visitor/2

**admin checkout visitor** \
    - e.g http://visitor-app.test/admin/visitor/2 -> click checkout button 

**Contact page - no auth** \
    send email - contact form
    - /contact
    - e.g http://visitor-app.test/contact

## Steps to setup

1. git clone from \
    **a. git clone https://github.com/PwtanSG/visitor-app.git**

        if using laragon, clone to \laragon\www folder \
        if using xampp clone to htdoc folder

    **b. install packages**
        command : composer install

**2. Create .env file in root folder & copy .env.example content to .env**

**3. setup database** \
    a.  Create Database visitordb in mySQL \
    .env specified DB_DATABASE=visitordb \

    Create DB via artisan CLI \
    with DB started : \
    command : php artisan db:create

    For manually create
    if use laragon, click Database button and use HeidiSQL to create new database with name visitordb \
    if using xampp, use myphp admin \ 

    b. DB visitors table
    start your db in laragon or xampp \
    run laravel visitor migration file \
    command : php artisan migrate 

**4. generate APP_KEY for .env** \
    - start your app in laragon or xampp \
    - command : php artisan key:generate 

**5. seed AdminSeeder - for admin user login** \
    - command : php artisan db:seed --class=AdminSeeder

**6. demo screen recording** \
    https://youtu.be/U5fXBeXYsGw
