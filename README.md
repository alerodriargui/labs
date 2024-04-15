
## How to run the project?

#### Clone this repository

#### Have composer installed on your machine. [Download Composer](https://getcomposer.org/download/)

#### Have node and npm installed on your machine. [Download Node.js](https://nodejs.org/en/download/)

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

## Deploy instructions via FTP

#### Create a- new .env file

```bash
cp .env.deploy .env
```

#### Modify the .env file

You need to modify the following variables with the correct values for the deployment to work properly:

```bash
APP_URL=http://coopillenca.com
DB_HOST=bbdd.coopillenca.com
DB_PORT=3306
DB_DATABASE=ddb221011
DB_USERNAME=ddb221011
DB_PASSWORD=coopIllenca@2024
```

#### Generate the key

```bash
php artisan key:generate
```

#### Run vite in production mode

```bash
npm run build
```

#### Zip the files

```bash
zip -r project.zip .
```

#### Upload the files to the server subdomain folder via FTP and extract them

#### Copy all the contents from the public folder to the root folder

#### Remove the /../ from the index.php file

Example:

```php
require __DIR__.'/vendor/autoload.php';
```
