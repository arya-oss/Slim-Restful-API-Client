## RESTFul API in Slim and REST Client in Angular Resource
1. `base_url` is `http://localhost/rest/public/`

2. `api_url` is `http://localhost/rest/public/users`

### Database Table Structure

```sql
CREATE TABLE friends (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  name varchar(64) NOT NULL,
  email varchar(64) NOT NULL,
  phone varchar(16) DEFAULT NULL,
  rollno int(7) NOT NULL,
  company varchar(20) DEFAULT NULL
)
```

### How to setup (apache mod_rewrite must be enabled)
1. Clone this repo in `www` or `htdocs` directory.
2. Change DB configuration in `bootstrap/app.php` and import `resources/friends.sql` in a db.
3. Install composer dependencies `composer install`

4. Goto url `http://localhost/rest/public/users`

### How To Test REST API
Add chrome extension [Postman](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=en) which is a
REST Api Client to test this application.

| HTTP Method | Path | Action | Fields  |
| -------- | ------- | -----  | ------- |
| GET      | /users  | index  |
| GET      | /users/{user_id} | index   |
| POST     | /users  | Add    | *rollno* (int), *name*, *email*, *phone* and *company* with <br /> header `Content-Type: application/x-www-form-urlencoded`
| PUT      | /users/{user_id} | update  | *rollno* (int), *name*, *email*, *phone* and *company* with <br /> header `Content-Type: application/x-www-form-urlencoded`
| DELETE   | /users/{user_id} | destroy |

### Todo

1. Add OAuth 2.0 Support
