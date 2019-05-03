# Docker Nginx & PHP FPM Example

This repo is an example on how to configure Nginx alongside a PHP FPM service.
It contains the default Laravel 5.8 boilerplate with no additions.

## How it works

If the Nginx service receives a PHP request, it asks the PHP FPM service to load that request. If it's a static file it just serves it.

## Features

### PHP FPM service

It uses multi-stage for downloading dependencies and then copies the result into the `php:7.3-fpm-alpine` image.

### Nginx service

It uses multi-stage for downloading Node dependencies and building the assets. Then copies the result into the `/var/www/html/public` directory in Nginx.

### Results

The [`renderer` image](https://microbadger.com/images/danielramosacosta/renderer-example) it's 38.5Mb, and the [`site` image](https://microbadger.com/images/danielramosacosta/site-example) 8.2Mb which is a total of **46,7Mb for the whole deployment**
