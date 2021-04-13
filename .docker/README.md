# Docker Environment

Pokretanje lokalnog razvojnog okruženja

### Requirements
`docker`

`docker-composer`

### Source
Potrebno je podesiti konekciju prema MYSQL serveru

_Podešavanja baze_

File location: `web/application/config/database.php`
  
```
'hostname' => 'mysql'
'username' => 'im2021-db-user'
'password' => 'im2021-db-password'
'database' => 'im2021-db'
```

_Podešavanje servera_

File location: `web/application/config/config.php`

```
$config['base_url'] = '/';
```

### Run
`cd .docker`

`docker-compose build`

`docker-compose up -d`

Aplikacija bi trebala biti dostupna na: `http://127.0.0.1:7800`
