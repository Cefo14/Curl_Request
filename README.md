# Curl_Request
a simple query tool for http requests GET POST OPTION PUT PATCH DELETE

How to use:

You can create an instance by assigning the token and the token type
$request = Curl_Request(array("token" => "MY_TOKEN", "type" => "Bearer"))

or empty
$request = Curl_Request()
$request->setToken()
$request->setType()

You can make requests in two ways, using the method
$request->request("GET", "http://api.com")

or (this applies to the verbs GET POST OPTION PUT PATCH DELETE)
$request->GET("http://api.com")

You can assign the headers and fields you want to send as follows
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

Note:
if the header is empty, assign these by default
  "Content-Type: application/json",
  "Accept: application/json"

By default it does not do a json_encode but it can be assigned in the following way
$data = array(
  "fields" => [
    "foo" => "foo",
    "data" => "data"
  ],
  
  "json" => true
)
$request->PUT("http://api.com", $data)

for convenience you can also do an http_build_query for the GET method as follows
$data = array(
  "fields" => [
    "foo" => "foo",
    "data" => "data"
  ],
  
  "url" => true
)
$request->GET("http://api.com", $data)

I hope it is useful to you as it was for me, regards :)
