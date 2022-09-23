## About Weather App

Weather App is a collection of APIs to list all cities with 5 days weather data, Add new cities and view any city's weather data.

## Installation Steps

- Clone the Repo by this command: `git clone https://github.com/hirenwadhiya/weather.git`
- Navigate to project directory by: `cd weather`
- Create environment file from demo file: `cp .env.example .env`
- Update `WEATHER_APP_KEY` in the .env file
- Create a database and fill the correct DB credentials in the .env file
- Generate app key: `php artisan key:generate`
- Install packages by: `composer install`
- Run migration by: `php artisan migrate`

## API Endpoints


### Add new city
- Request Method: POST
- End Point: `domain-name.com/api/city`
- Parameters: name(string), latitude(numeric), longitude(numeric)

### View city
- Request Method: GET
- End Point: `domain-name.com/api/city/{id}`

### List all cities
- Request Method: GET
- End Point: `domain-name.com/api/city`
