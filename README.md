# ConnectIn
Social networking application using CQRS-ES with a help of broadway framework.

## Tech stack
- Broadway
- Symfony
- phpunit
- elastic search
- sqlite
- git
- docker

## Installation

### Docker Compose

```sh
docker-compose up -d

docker-compose exec app /bin/bash
app/console broadway:event-store:schema:init
```
us
Docker-compose will set up the containers needed to run this app.

To make sure the app running properly
```sh
curl -i localhost:8100
```

The app will be available at http://localhost:8100 as configured in `docker-compose.yml`.

## Running the unit test
```sh
docker-compose exec app /bin/bash
vendor/bin/phpunit
```

## Running the demo

This app doesn't have a GUI, only an API with the following endpoints:

| Method | Path | Description | Action |
|--------|------|-------------| ------- |
| POST | `/user` | Create a new user, name should be given as form fields) and returns the userId | ```curl -X -F 'name=$name' POST localhost:8100/user ``` |
| GET | `/users` | Retrieve registered users  | ``` curl localhost:8100/users ```
| POST | `/user/addFriend` | Add a friend to a user (userId and friendId should be given as form fields) and returns the userId| ``` curl -X POST localhost:8100/user/addFriend ``` |
| GET | `/user/{userId}/friends` | Retrieve list of friends for a user  | ``` curl localhost:8100/user/$userId/friends ```

## Code structure

- Domain code can be found in `src/ConnectIn/`
- ReadModel code can be found in `src/ConnectIn/ReadModel`
- Controller / services can be found in `src/Controler`

For more information, rilwanfit@gmail.com