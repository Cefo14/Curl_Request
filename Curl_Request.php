<?php
	class Curl_Request
	{
		private $token;
		private $type;

		public function __construct($data = array())
		{

			$this->token = $data["token"] ? $data["token"] : null;
			$this->type = $data["type"] ? ucfirst(strtolower($data["type"])) : null;
		}
		
		public function setToken($token)
		{
			$this->token = $token;
		}

		public function getToken()
		{
			return $this->token;
		}
		
		public function setType($type)
		{
			$this->type = $type;
		}

		public function getType()
		{
			return $this->type;
		}

		private function getHeaders($data)
		{
			if($data["headers"])
				$headers = $data["headers"];
			
			else
				$headers =  array(
					"Content-Type: application/json",
					"Accept: application/json"
				);
			
			if($this->token != null && $this->type)
				$headers[] = "Authorization: " $this->type . " " .  $this->token;
			return $headers;
		}

		private function getFields($data)
		{
			$fields;
			if($data["fields"])
			{
				$fields = $data["fields"];
				if($data["json"])
					$fields = json_encode($fields, JSON_UNESCAPED_SLASHES);
				else if($data["url"])
					$fields = http_build_query($fields);
			}
			
			return $fields;
		}

		private function encodeUrl($url, $data)
		{
			return $url . "?" . $fields;
		}
		
		public function request($type, $url, $data = array())
		{
			$headers = self::getHeaders($data);
			$fields = self::getFields($data);
			$type = strtoupper($type);
			
			$curl = curl_init();
			
			if($type == "GET" && $fields)
				curl_setopt($curl, CURLOPT_URL, self::encodeUrl($url, $fields));
			else
				curl_setopt($curl, CURLOPT_URL, $url);
			
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_HEADER, FALSE);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			
			if($type == "GET")
				curl_setopt($curl, CURLOPT_HTTPGET, TRUE);

			else if($type == "POST")
				curl_setopt($curl, CURLOPT_POST, TRUE);

			else 
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
			
			if($type != "GET" && $fields)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
			
			$response = curl_exec($curl);
			$error = curl_error($curl);
			$errno = curl_errno($curl);
			
			curl_close($curl);
			
			if($error)
				throw new Exception($error);
			
			else if($errno)
				throw new Exception($errno);
			
			$json = json_decode($response);
			
			if (json_last_error() === JSON_ERROR_NONE)
				return $json;
			else
				return $response;
		}

		public function GET($url, $data = array())
		{
			return self::request("GET", $url, $data);
		}
		
		public function POST($url, $data = array())
		{
			return self::request("POST", $url, $data);
		}

		public function OPTIONS($url, $data = array())
		{
			return self::request("OPTIONS", $url, $data);
		}

		public function PUT($url, $data = array())
		{
			return self::request("PUT", $url, $data);
		}

		public function PATCH($url, $data = array())
		{
			return self::request("PATCH", $url, $data);
		}

		public function DELETE($url, $data = array())
		{
			return self::request("DELETE", $url, $data);
		}
		
		private function debugg($curl)
		{
			echo "<pre>" . print_r(curl_getinfo($curl)) . "</pre>";
		}
	}