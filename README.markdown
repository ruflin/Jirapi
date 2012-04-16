Jirapi
==================================
Jirapi is a PHP library that aims to provide an easy access to the [JIRA REST API](http://docs.atlassian.com/jira/REST/latest/).

Getting Started
---------------
Jirapi uses the [xBoilerplate](https://github.com/ruflin/xBoilerplate) structure. For instructions on how to setup and use xBoilerplate visit [its github page](https://github.com/ruflin/xBoilerplate).
When you're ready just create a new `Client` with your access data and JIRA URL:

	$url = 'https://jira.atlassian.com/';
	$client = new Client($url, $username, $password);

Now you can easily access an issue using the following code:

	$issue = $client->getIssue($issueId);

Have fun and explore!

Documentation
-------------
No Documentation yet.
