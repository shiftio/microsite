# Microsite Template
This project uses the MediaSilo API and creates a basic screener application. Users are presented with a list of projects and assets that can be viewed in the browser. This project is intended as a starting-off point for a developer who wishes to build any variety of applications using MediaSilo as the media management platform. 

For more information on the api, please see our official [API Documentation](https://docs.mediasilo.com). 


### 1. Install Composer
```
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```
### 2. Change the default account name
Open settings.php inside the /src directory. Update the 'hostname' variable with your account/host name. All logins will automatically go against your own MediaSilo account.
```
// MediaSilo Settings
  'ms_settings' => [
      'hostname' => 'microsite',
      'apiurl'  => 'https://api.mediasilo.com/v3/'
  ]
```
### 3. Customize the css or pages
Since this is a standalone app using the API, the sky is the limit. Create your own templates with all the goodness that is CSS and JavaScript.

### About the SLIM Framework
This project uses the lightweight [Slim Framework](www.slimframework.com) for basic routing in PHP. You can use your mini-framework of choice; we like Slim because of its simplicity.

### Twig for Templating
This project also uses [Twig](http://twig.sensiolabs.org/) as a lightweight templating language. There are only two pages in the templates directory: home.html and login.html. 

