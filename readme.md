<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](http://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Documentation

### Create a company ###

- POST /api/company


#### Header ####

Content-Type	application/json

```php
$data = [
    'company_name' =>$request->nome,
    'company_email'=>$request->email
];
$data = json_encode($data);
```

#### Return ####

Returns 201, if existing company, return is a company and status code 200

```php
{"company_name":"Exemple","company_email":"Exemple@exemple.com","company_token":"9fcb53ebe7863d8e34c1fe8fb31d993c8dd8f3835fbf392c9c81b537605f40bdc67378bde3c6ca41ce0c8a3c8092541bcd7ef983011091302efcc58f","updated_at":"2017-11-30 02:00:35","created_at":"2017-11-30 02:00:35","_id":"5a1f66431ff06100062fa955"}
```


### Edit a company ###

- PUT api/company/{company_id}

#### Header ####

Content-Type	application/json

```php
$data = [
    'company_name' =>$request->nome,
    'company_email'=>$request->email
];
$data = json_encode($data);
```

#### Return ####

Returns the Company with updated data

```php
{"company_name":"Exemple","company_email":"Exemple@exemple.com","company_token":"9fcb53ebe7863d8e34c1fe8fb31d993c8dd8f3835fbf392c9c81b537605f40bdc67378bde3c6ca41ce0c8a3c8092541bcd7ef983011091302efcc58f","updated_at":"2017-11-30 02:00:35","created_at":"2017-11-30 02:00:35","_id":"5a1f66431ff06100062fa955"}
```
### API connection ###
Remember that you need to make an API connection through the curl, there are two types of connection

##### Curl without API Token #####
This connection is used to access the API without the API Token,it can be used to create a new company and edit a company

```php
<?php
namespace App\Helper;
class WebRequest{
   public static function postData($url, $data, $metodo){       
       $curl = curl_init();
             
       curl_setopt_array($curl, array(
         CURLOPT_URL => $url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => $metodo,
         CURLOPT_POSTFIELDS => $data,
         CURLOPT_HTTPHEADER => array(
           "cache-control: no-cache",
           "content-type: application/json",
         ),
       ));
      
       $response = curl_exec($curl);
 $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
       $err = curl_error($curl);
      
       curl_close($curl);
      
       return json_decode($response);
   }
```
##### Curl API Token #####

This connection is used to access the API with the API Token, it can be used to send emails, sms, search information about them

```php
public static function authPostData($url, $data, $metodo, $chave){       
       $curl = curl_init();
             
       curl_setopt_array($curl, array(
         CURLOPT_URL => $url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => "",
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => $metodo,
         CURLOPT_POSTFIELDS => $data,
         CURLOPT_HTTPHEADER => array(
           "cache-control: no-cache",
           "content-type: application/json",
  		"authorization: Bearer $chave",

         ),
       ));
      
       $response = curl_exec($curl);
 $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
       $err = curl_error($curl);
      
       curl_close($curl);
      
       return json_decode($response);
   }
```

Obs: it can also be used to get the api token

### Send Email ###

- POST api/email

#### Header ####

Content-Type	application/json

Authorization	Bearer {api_token}

```php
        $data = [
            'name_to'=> "",
            'email_to'=> $request->email ,
            'message'=> $request->texto,
            'subject'=> "",
            'from_email'=> "",
            'from_name'=> "",
            'company_token'=> $request->company_token,
            'tracking'=> ""
            
        ];  
        $data =  json_encode($data);
```

#### Return ####

Return  status code 201, if email is sent

### Send SMS ###

- POST api/sms

#### Header ####

Content-Type	application/json

Authorization	Bearer {api_token}

```php
        $data = [
            'message'=> $request->texto,
            'phone_number'=>  $request->telefone_number,
            'company_token'=> $request->company_token,
            'tracking'=> ""
            
        ];
        $data =  json_encode($data);
```

#### Return ####

Return  status code 201, if sms is sent

### List all Emails ###

- POST api/email/all

#### Header ####

Content-Type	application/json

Authorization	Bearer {api_token}

```php
        $data = [
            'company_token' => $company_token  
        ];
        $data =  json_encode( $data);
 ```
 #### Return ####

Return  status code 200, return all emails

### List all SMS ###

- POST api/sms/all

#### Header ####

Content-Type	application/json

Authorization	Bearer {api_token}

```php
        $data = [
            'company_token' => $company_token  
        ];
        $data =  json_encode( $data);
 ```
 #### Return ####

Return  status code 200, return all Sms

### Get an email info ###

- POST  api/email/info

#### Header ####

Content-Type	application/json

Authorization	Bearer {api_token}

```php
        $data = [
            'id' => $id 
        ];
        $data =  json_encode( $data);
 ```
 #### Return ####

Return  status code 200 and email info, if there is id

### Get an SMS info ###

- POST  api/sms/info

#### Header ####

Content-Type	application/json

Authorization	Bearer {api_token}

```php
        $data = [
            'id' => $id 
        ];
        $data =  json_encode( $data);
 ```
 #### Return ####

Return  status code 200 and SMS info, if there is id

### API Token valid ###

- GET api/access/valid/{api_token}

#### Return ####

Return status code 200, if api token is valid, else return 404
