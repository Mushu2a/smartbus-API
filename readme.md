# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen/v/stable)](https://packagist.org/packages/laravel/lumen)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Web API

You can now see on http://smartbus.esy.es how its working.

### List API enable
| Method    | Url                                   | Controler@method          | Information           |
|-----------|:-------------------------------------:|:-------------------------:|----------------------:|
| GET       | http://smartbus.esy.es/user           | UserController@index      | User authenticate     |
| GET       | http://smartbus.esy.es/user/{id}      | UserController@find       | Fetch User by id      |
| POST      | http://smartbus.esy.es/create         | UserController@create     | Create a new User     |
| PUT       | http://smartbus.esy.es/  or (update)  | UserController@update     | Update User auth      |
| DELETE    | http://smartbus.esy.es/  or (delete)  | UserController@delete     | Delete User auth      |

**Send HTTP request (*Before create POST*).**

> You have to pass Headers with **Content-Type** *application/json* for valid JSON to API and inside Body

```javascript
{
     "lastname": "Lastennet",
     "firstname": "Loïc",
     "email": "lastennet.l@gmail.com",
     "username": "mushu2a",
     "password": "1234"
}
```
***

**Send HTTP request (*after create POST*).**

> You have to advise API for authentication a **'Token'** or a (**email** OR **username** AND **password**) for start  
> **Token** is display on API return such as : *'api_token'* => $token  
> Now you can do everything you want who are in the list.

```javascript
var ex = "Exemple using PUT Request and what you can update";
{
    'lastname': '',
    'firstname': '',
    'email': '',
    'username': '',
    'phone': '',
    'birthday': '',
    'address1',
    'address2',
    'city',
    'zip': '',
    'country',
    'gender': '',
    'brandBus': '',
    'comfort': '',
    'number': '',
    'owner': '',
    'password': '',
}
```

Ex Headers for login  
**email**      *lastennet.l@gmail.com*  
**username**   *mushu2a*  
**password**   *1234*  

### Errors

**401** Unauthorized -> *You have give wrong 'Token' or email | username && password*  
**404** Not Found -> *You use wrong URI or use bad URL*  
**500** Internal Server Error -> *You do something wrong ? No it's good, it's not your fault !*  
