# README #

# INSTALLATION

### Get source code

#### Clone repository manually
```
$ git clone git@bitbucket.org:aurocraft/bkw-group.git
```

## Manual installation

### REQUIREMENTS
The minimum requirement by this application template that your Web server supports PHP 7.1+
Required PHP extensions:

- mcrypt
- pdo_mysql
- curl
- dom
- mbstring
- gd
- exif
- intl

### Setup application

1. Go to the project root folder 
```
$ cd bkw-group
```
2. Install composer dependencies
```
$ php composer.phar install
```
3. Copy environment file
```
$ cp .env.dist .env
```
3.1. Adjust settings in `.env` file

- Set debug mode and your current environment
```
YII_DEBUG   = false
YII_ENV     = prod
```

- Set DB configuration
```
DB_DSN           = mysql:host=127.0.0.1;port=3306;dbname=bkw-group
DB_USERNAME      = user
DB_PASSWORD      = password
```

- Set application canonical urls(for prod)
```
FRONTEND_HOST_INFO    = http://bkw-group.com.ua
BACKEND_HOST_INFO     = http://admin.bkw-group.com.ua
STORAGE_HOST_INFP     = http://storage.bkw-group.com.ua
API_HOST_INFO         = http://api.bkw-group.com.ua
```
4. Run
```
$ php console/yii app/setup
```
5. Import db dump file or, if you don't have db dump, run
```
$ php console/yii migrate/up --interactive=0
$ php console/yii rbac-migrate/up --interactive=0
```
 
6. Extract(if you have) storage.tar.gz to project `storage` folder

### Nginx virtual hosts setup
    - root path to main domain(bkw-group.com.ua) - frontend/web
    - root path to admin domain(admin.bkw-group.com.ua) - backend/web
    - root path to storage domain(storage.bkw-group.com.ua) - storage/web
    - root path to storage domain(api.bkw-group.com.ua) - api/web


## Console commands

#### Install composer dependencies
```
$ php composer.phar install
```

#### Apply new migrations
```
$ php console/yii migrate/up --interactive=0
```

#### Update translations
```
$ php console/yii message @common/config/messages/db.php
```