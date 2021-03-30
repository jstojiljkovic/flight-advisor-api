## Flight Advisor

1. [Configuration](#configuration)
2. [Usage](#usage)

## Configuration

Before API usage, please rename `.env.example` into `.env`

Run this commands which will create a dummy admin account, as for API authentication I've used Stateless HTTP Authentication as it was a  test otherways, it would have a different one
```bash
php artisan migrate --seed
```

Admin credentials

```bash
username: admin
password: password
```

## Usage

You can locate API documentation at `flight-advisor/v1/documentation`
