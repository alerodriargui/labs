
## How to run the project?

#### Clone this repository

#### Have composer installed on your machine. [Download Composer](https://getcomposer.org/download/)

#### (In case PHP is installed via XAMPP) Allow zip downloads via composer

navigate to the php.ini file in the xampp installation folder and uncomment the following line:

```bash
;extension=zip
```

#### Install the dependencies

```bash
composer update
composer install

npm install
```

#### Create the database and run the migrations

Db name: `coopillenca` (empty)
```bash
php artisan migrate --seed
```

#### Run the project

```bash
npm run dev
//CTL+C to stop the process

npm run build

php artisan serve
```
