# Blogs

# Clone the Repository

git clone <repository_url>
cd <project_directory>

# Client (Frontend)

Update the conf.js file as follows:

```
 export default Object.freeze({
    appName : 'Blogs',
    server:{
        host: "http://blogs.test",
        redirectUri: "http://localhost:8080"
    }
})
```
cd client
npm install
npm run serve

# Server (Backend)

Update the .env file as follows:

```

DB_CONNECTION=mysql
DB_HOST=example.com
DB_PORT=3306
DB_DATABASE=mydatabase
DB_USERNAME=myuser
DB_PASSWORD=mypassword

```

composer install
php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan serve




