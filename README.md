# Curl_Request
a simple query tool for http requests GET POST OPTION PUT PATCH DELETE

## How to use:

You can create an instance by assigning the token and the token type
```php
$request = Curl_Request(array("token" => "MY_TOKEN", "type" => "Bearer"))
```

or empty
```php
$request = Curl_Request()
$request->setToken()
$request->setType()
```
You can make requests in two ways, using the method
```php
$request->request("GET", "http://api.com")
```

or (this applies to the verbs GET POST OPTION PUT PATCH DELETE)
```php
$request->GET("http://api.com")
```

You can assign the headers and fields you want to send as follows
```php
$data = array(
  "headers" => [
    "Content-Type: application/json",
		"Accept: application/json"
  ],
  
  "fields" => [
    "foo" => "foo",
    "data" => "data"
  ]
)
$request->POST("http://api.com", $data)
```
**Note:
if the header is empty, assign these by default
  "Content-Type: application/json",
  "Accept: application/json"**

By default it does not do a json_encode but it can be assigned in the following way
```php
$data = array(
  "fields" => [
    "foo" => "foo",
    "data" => "data"
  ],
  
  "json" => true
)
$request->PUT("http://api.com", $data)
```
For your convenience when making a GET request the **"fields"** are encoded and concatenated with http_build_query, you can also do it manually in the following way:
```php
$data = array(
  "fields" => [
    "foo" => "foo",
    "data" => "data"
  ],
  
  "url" => true
)
$request->GET("http://api.com", $data)
```
## **I hope it is useful to you as it was for me, regards :)**
