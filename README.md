# Installation Guide

* Follow the steps below to install the application
* Make sure you have homestead and virtual box installed on your machine

1. Git clone the repository to your computer
2. In your Homestead.yaml file, add **-map: craig.medical.center to: /home/vagrant/WAF/MyLaravelProjects/CraigMedical/public** and create the database. Under databases, put **-      craig_medical**
3. Open the .env.example file and rename it to '.env'. 
4. Set the appropriate variables in the .env file:
     - **APP_NAME** = CraigMedical
     - **APP_URL** = http://CraigMedical.test
     - **DB_DATABASE** = craig_medical
     - **DB_USERNAME** = homestead
     - **DB_PASSWORD** = secret
5. Run **vagrant reload --provision**
6. In Homestead, run these commands in order:
   - **composer install**
   - **npm install** 
   - **php artisan key:generate**
   - **php artisan migrate**
