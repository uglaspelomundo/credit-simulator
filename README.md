# Simulador de Empréstimos

## Requisitos

* PHP 8.2
* Composer
* Docker
* Postman

## Como rodar o projeto baixado
1. Duplicar o arquivo ".env.example" e renomear para ".env".

2. Instalar as dependências do PHP:
```
composer install
```

3. Gerar a chave no arquivo .env se for necessário:
```
php artisan key:generate
```

4. Iniciar o container do banco de dados:
```
docker-compose up -d
```

5. Executar a migration para criar a tabela no banco:
```
php artisan migrate
```

6. Iniciar o projeto criado com Laravel:
```
php artisan serve
```

## Exemplos de Requisições para os Endpoints

### Simular Empréstimo

**Endpoint:**
```
POST http://127.0.0.1:8000/api/loan/simulate
```

**Request Headers:**
```
Content-Type: application/json
```

**Request Body (JSON):**
```
{
    "loan_amount": 5000,
    "birth_date": "1990-05-20",
    "months": 24
}
```

**Resposta Esperada:**
```
{
    "success": true,
    "message": "Simulação realizada com sucesso!",
    "data": {
        "totalAmountToPay": "5.264,57",
        "monthlyPayment": "219,36",
        "totalInterest": "264,57"
    }
}
```

**CURL:**
```
curl --location 'http://127.0.0.1:8000/api/loan/simulate' \
--header 'Content-Type: application/json' \
--data '{
    "loan_amount": 5000,
    "birth_date": "1990-05-20",
    "months": 24
}'
```


## Estrutura do Projeto e Decisões de Arquitetura

O projeto está estruturado utilizando a arquitetura **Hexagonal**, ambém conhecida como arquitetura de portos e adaptadores. Essa abordagem permite que a lógica de negócios (domínio) seja separada das implementações de interface do usuário e da infraestrutura, facilitando a manutenção e a escalabilidade.

### Principais Pastas e Arquivos

- **app/Http/Controllers**: Contém os controladores que gerenciam as requisições da API.
- **app/UseCases**: Implementa a lógica de negócios, como simulações de empréstimos.
- **app/Models**: Contém os modelos que representam as entidades do banco de dados.
- **database/migrations**: Armazena os arquivos de migração que definem a estrutura do banco de dados.

### Decisões de Arquitetura

- **Separação de Responsabilidades**: A lógica de negócios foi mantida separada dos controladores, utilizando casos de uso para implementar a simulação de empréstimos. Isso permite que a lógica de negócios seja reutilizada e testável.
  
- **Validação de Requisições**: Utilizamos **FormRequests** para validar as entradas da API, garantindo que as requisições estejam no formato correto antes de serem processadas.
