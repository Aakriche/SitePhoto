# SitePhoto

Site pour exposer photos ou toiles

## Environnement de developpement

### Pré requis

* PHP 7.4
* Composer
* Symfony CLI
* Docker
* Docker Compose
* nodejs et npm


On peut verifier les pré requis (sauf Docker et Docker compose) avec la commande suivante 

```bash
symfony check:requirements
```

### Lancer l'environnement de developmment

```bash
composer install
npm install
npm run build

docker-compose up -d
symfony serve -d
```

##lancer des tests

```bash
php bin/phpunit --testdox
```