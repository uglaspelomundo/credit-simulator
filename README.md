## Requisitos

* PH 8.2
* Composer
* Docker
* Postman

## Como rodar o projeto baixado
Duplicar o arquivo ".env.example" e renomear para ".env".<br>

Instalar as dependências do PHP
```
composer install
```

Gerar a chave no arquivo .env se for necessario
```
php artisan key:generate
```

Iniciar o container do banco de dados
```
docker-compose up -d
```
Executar a migration para criar a tabela no banco
```
php artisan migrate
```

Iniciar o projeto criado com Laravel
'''
php artisan serve
'''

Para acessar a API, é recomendado utilizar o postman para simular requisições à API
'''

'''



