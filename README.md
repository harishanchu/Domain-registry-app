domain-registry-app
====================
Test app

## To install

* cd app-root
* run command : composer install
* Copy Twitter Bootstrap JavaScript dependencies that we’ll need from the vendor folder into our asset folder by running follwing commands.
   cp vendor/twitter/bootstrap/docs/assets/js/html5shiv.js assets/js/html5shiv.js
   cp vendor/twitter/bootstrap/docs/assets/js/bootstrap.min.js assets/js/bootstrap.min.js
* cd ap-root/assets
* Run command npm install
* Compile css by running command: lessc assets/css/style.less assets/css/style.css from app-root
* Edit config.php and modify settings as required


