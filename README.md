# Autosmozi APP

## Install

Clone repository:
`git pull https://github.com/Hu51/autosmozi`

Update composer packages
`composer update`
`docker compose up --build`

Copy **.env.example** to **.env**
And update **.env** and **docker-compose.yml**


Run migration in docker:
`php artisan migrate --seed`


### API Documentation
http://localhost/api/documentation
