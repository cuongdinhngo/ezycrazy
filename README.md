# ezycrazy
Powered by Atom Framework

### The Application Structure
- app: contains logic folders including Controllers, Models, Routes
- public: contains unrestricted files such as photos, css, js
- config: contains config files : env.inc, app.php, ...
- resources: contains all view files.
- storage: likes local storage to contain log, ...

### Single Point Entry
#### index.php
<pre>
require __DIR__ . '/../vendor/autoload.php';

use Atom\Http\Server;

try {
    $server = new Server(['env']);
    $server->handle();
} catch (Exception $e) {
    echo $e->getMessage();
}
</pre>

### Installing/Configuration
- After cloned, you come to `docker` folder and run command:
<pre>
docker-compose up -d
</pre>
- Create `env.ini` file by:
<pre>
cp env.ini.sample config/env.ini
</pre>
- Obtain IPAddress and Update Database host in `env.ini`
<pre>
docker inspect docker_ezy_mysql_1 | grep IPAddress
</pre>
- Set up database by importing [`users.sql`](https://github.com/cuongnd88/ezycrazy/blob/master/storage/sql/users.sql) at [`storage/sql`](https://github.com/cuongnd88/ezycrazy/tree/master/storage) folder
- Install Atom and related packages
<pre>
composer install
</pre>
- Go to browser with below url and Enjoy it
<pre>
http://127.0.0.1:8010/admin
</pre>

MEMO
====
#### New Route
* Based on your works, you can add new route into [`api`](app/Routes/api.php) or [`web`](https://github.com/cuongnd88/ezycrazy/blob/master/app/Routes/web.php) file at [`Routes` folder](https://github.com/cuongnd88/ezycrazy/tree/master/app/Routes).
Atom framework verifies api by prefix url (ex: http://127.0.0.1:8010/api/users) or header value (ex: Content-Type:application/json)

#### New Controller
* New Controller class must be extended [BaseController class](app/Controllers/User/UserController.php)

#### New Model
* New Model class must be extended [BaseModel class](app/Models/User.php)

#### New Middleware
* New Middleware must be created in [Middlewares folders(app/Middlewares) and has primary method `handle()`. Please refer to [PhpToJs](app/Middlewares/PhpToJs.php)
* New Middleware has to declare at [`config/middleware.php`](config/middleware.php)

#### PHP to JS
* Atom provides PhpToJs to transform PHP variables to Js variables [more detail](app/Middlewares/PhpToJs.php)

#### Template Provider
* Set templates at [`config/templates.php`](config/templates.php). Item has `null` value which will be replaced
* With `template()` function, please refer to `app/Controllers/User/UserController@list()`
* With `Template` class, please refer to `app/Controllers/User/UserController@updateForm()`
