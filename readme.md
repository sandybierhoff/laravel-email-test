Simple example of sending mail with queues in laravel
=================
```php
composer update
php artisan migrate
php artisan queue:work --tries=3
```
You must have previously configured the mail provider to use. [Click here]( https://laravel.com/docs/5.5/mail#previewing-mailables-in-the-browser )


Make a post request to "http://domain/api/send-email" with a json in this format:

```json
{
  "subject": "Intro",
  "body": "This is a email body",
  "to": "to@main.com",
  "cc": ["cc1@main.com","cc2@main.com"]
}
```
