# Laravel Admin Kit

### Feature
1) User Management
2) Supplier Management
3) Customer Management
4) Unit Management
5) Category Management
3) Products Management
3) Product Purchase Management
### Heroku Setup 
<pre>
create Procfile web: vendor/bin/heroku-php-apache2 public/
git add . & commit 
heroku login
heroku create 
git remote -v 
 git push heroku master
 heroku config:add APP_DEBUG=true
 heroku config:add APP_ENV=production
 heroku pg:credentials:url  //for database
 heroku run php artisan migrate --seed
after every change >  git push heroku master
</pre>
