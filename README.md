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
- In virtual machine, you need to install [composer](https://getcomposer.org/download/) and then execute:
<pre>
composer install
</pre>
- Set up database by importing `users.sql` at `storage/sql` folder
- Go to browser with below url and Enjoy it
<pre>
http://127.0.0.1:9020/admin
</pre>

MEMO
====
#### New Route
* Based on your works, you can add new route into `api` or `web` file at `Routers` folder.
Atom framework verifies api by prefix url (ex: http://127.0.0.1:9020/api/users) or header value (ex: Content-Type:application/json)

#### New Controller
* New Controller class must be extended BaseController class

#### New Model
* New Model class must be extended BaseModel class
