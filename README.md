## Installation

git clone git@github.com:puteprovod/homepage.git<br>
docker-compose up -d<br>
php artisan migrate<br>
npm run dev<br>
see http://localhost:8877


## .ENV file settings

DB_CONNECTION=mysql<br>
DB_HOST=db<br>
DB_PORT=3306<br>
DB_DATABASE=myblog<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>
BROADCAST_DRIVER=log<br>
CACHE_DRIVER=redis<br>
FILESYSTEM_DISK=local<br>
QUEUE_CONNECTION=database<br>
SESSION_DRIVER=file<br>
SESSION_LIFETIME=120<br>
MEMCACHED_HOST=127.0.0.1<br>
REDIS_HOST=127.0.0.1<br>
REDIS_PASSWORD=null<br>
REDIS_PORT=6379
