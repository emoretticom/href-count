# hrefCount - href click counter for PHP 
HrefCount is a PHP library that register and store in database, how many times a link is clicked by user.

## Installation
Install the latest version with

```bash
$ composer require emoretti/href-count ^dev-master
```

## Configuration

Change the attribute in `hrefCountConfig` class as you needed.

1. Change with your site base url
	```php 
		private $BASE_URL = "http://<yoursite>/"; 
	``` 

2. You can change the key for the query string variable
	```php 
		private $QUERY_STRING_VAR_NAME = "qs"; 
	``` 

3. Set your database connection data
	```php	private $DATABASE_HOST = "localhost";
    	private $DATABASE_NAME = "test";
    	private $DATABASE_USR = "root";
    	private $DATABASE_PWD = "";
    	private $TABLE_NAME = "href_count"; ```


## Basic Usage

Create an instance of `hrefCount()` class in the page you will use the  HTML a tag.
In the href attribute, insert the call to the href() method, passing the "link" and "alias" values.

```php
<?php
	
	use emoretti\utils\hrefcount\hrefCount;

	$HC =  new hrefCount(); 

?>

<html>
	<head>
		<title>Click Counter Example</title>
	</head>

	<body>

		<h1>Click Counter PHP - Example use</h1>
		<h2>Click a link to increase the relative counter.</h2>

		<h3>Same Page link</h3>
		<a href="<?php $HC->href('index.php','Homepage') ?>">Homepage</a><br/>

		<h3>Same Page link with get parameter</h3>
		<a href="<?php $HC->href('index.php?test=hello','Homepage_Hello') ?>">Homepage with query string</a>

		<h3>Same page with #anchor link</h3>
		<a href="<?php $HC->href('#ancorar','Homepage_anchor') ?>">Homepage with Anchor</a><br/>


		<h3>Another page link</h3>
		<a href="<?php $HC->href('link1.php','Another page') ?>">Link1</a><br/>

	</body>
</html>
```

In any linked page you want count the click add 
```php
<?php
	
	use emoretti\utils\hrefcount\hrefCountEndpoint;

	$HC_EP =  new hrefCountEndpoint();

?>
```


### Author

Ettore Moretti - <info@ettoremoretti.com> - <https://twitter.com/emoretticom> - <https://www.facebook.com/emoretticom/>

### License

href-count is licensed under the MIT License - see the `LICENSE` file for details
