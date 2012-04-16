Jirapi
==================================
Jirapi is a PHP library that aims to provide an easy access to the [JIRA REST API](http://docs.atlassian.com/jira/REST/latest/).

Getting Started
---------------
To use Jirapi in your project you have to include it. Best way to do this is to use [PHP autoload](http://www.php.net/manual/en/language.oop5.autoload.php).
When you're ready just create a new `Client` with your access data and JIRA URL:

	$config = array(
		'url' => 'https://jira.atlassian.com',
		'username' => 'your username',
		'password' => 'your password'
	);
	$client = new Client($config);

Now you can easily access an issue using the following code:

	$issue = $client->getIssue($issueId);

Have fun and explore!

Documentation
-------------
No documentation yet.
