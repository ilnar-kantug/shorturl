# Laravel URL Shortener project

## Getting Started

Install all needed packages

```
composer install
```

Create .env file from .env.example (if you are not using build-in docker, then fill .env with your data)

Generate key for project

```
php artisan key:generate
```

Change permissions for common folders
```
make perm
```

Build docker environment.
```
make build-docker 
```

If any command doesn't work properly try it with sudo.

Run migrations
```
make migrate 
```