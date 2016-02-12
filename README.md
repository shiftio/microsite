# Microsite Template
This project uses the MediaSilo API and creates a basic screener application. Users are presented with a list of projects and assets that can be viewed in the browser. This project is intended as a starting-off point for a developer who wishes to build any variety of applications using MediaSilo as the media management platform. 

For more information on the api, please see our official [API Documentation](https://docs.mediasilo.com). 

To see a demo of this project, go to:
[http://silo-microsite.herokuapp.com](silo-microsite.herokuapp.com)

Username: viewer
Password: MicroSite1


### Clone this project
```
git clone https://github.com/mediasilo/microsite.git
```

After you have downloaded this project, follow the instructions below:

### 1. Install Composer
```
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```

### 2. Run composer
```
composer update
```

### 3. Configure your web server or run the build in server
Point your virtual host to the /public directory or use the SLIM built-in server:
```
php -S 0.0.0.0:8080 -t public public/index.php
```

### 4. Change the default account name
Open settings.php inside the /src directory. Update the 'hostname' variable with your account/host name. All logins will automatically go against your own MediaSilo account.
```
// MediaSilo Settings
  'ms_settings' => [
      'hostname' => 'microsite'
  ]
```
### 3. Customize the css or pages
Since this is a standalone app using the API, the sky is the limit. Create your own templates with all the goodness that is CSS and JavaScript.

### About the SLIM Framework
This project uses the lightweight [Slim Framework](www.slimframework.com) for basic routing in PHP. You can use your mini-framework of choice; we like Slim because of its simplicity.

### Twig for Templating
This project also uses [Twig](http://twig.sensiolabs.org/) as a lightweight templating language. There are only two pages in the templates directory: home.html and login.html. 


# Run it on Heroku
A great way to run your microsite is to use Heroku. This project already includes the required Procfile and apache_app.conf files. Check [here](https://devcenter.heroku.com/articles/getting-started-with-php#introduction) for instructions on how to get your project deployed on Heroku in just a few steps.
