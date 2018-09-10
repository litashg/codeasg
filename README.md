# README #

# INSTALLATION

### Get source code

#### Clone repository manually
```
$ git clone https://github.com/litashg/codeasg.git
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
DB_DSN           = mysql:host=127.0.0.1;port=3306;dbname=codeas
DB_USERNAME      = user
DB_PASSWORD      = password
```

- Set application canonical urls(for prod)
```
FRONTEND_HOST_INFO    = http://codeas.pro
BACKEND_HOST_INFO     = http://admin.codeas.pro
STORAGE_HOST_INFP     = http://storage.codeas.pro
API_HOST_INFO         = http://api.codeas.pro
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
    - root path to main domain(codeas.pro) - frontend/web
    - root path to admin domain(admin.codeas.pro) - backend/web
    - root path to storage domain(storage.codeas.pro) - storage/web
    - root path to storage domain(api.codeas.pro) - api/web


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