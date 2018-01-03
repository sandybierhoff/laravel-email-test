Simple example of sending mail with queues in laravel
=================
```php
composer update
php artisan migrate
php artisan db:seed
```
You must have previously configured the mail provider to use. [Click here]( https://laravel.com/docs/5.5/mail#previewing-mailables-in-the-browser )

Finally:

```php
php artisan queue:work --tries=1
```

You must login in the system, make a post request to "http://domain/api/login" with a json in this format:

```json
{
	"login": "admin@domain.com",
	"password": "secret"
}
```

And he will return:

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNTE0NDgzNTQ3LCJleHAiOjE1MTQ0ODcxNDcsIm5iZiI6MTUxNDQ4MzU0NywianRpIjoiUFJNeUczbVFtVzN6T1g3dSIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.K6HK6jqBeE3M2t__BLMezjkuGeKR4MUHD8XYXu4nyU8"
}
```

That token must be sent in the header of each request, 

```text
Authorization: Bearer {{ token }}
```

Make a post request to "http://domain/api/send-email" with a json in this format:

```json
{
  "subject": "Intro",
  "body": "This is a email body",
  "to": "to@main.com",
  "cc": ["cc1@main.com","cc2@main.com"]
}
```

If the mail can not be sent, an alert mail will be sent to the authenticated user's email.