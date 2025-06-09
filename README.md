# Places API

API simples para gerenciar lugares (CRUD) utilizando Laravel 12 e PostgreSQL, com ambiente Docker configurado para facilitar desenvolvimento e testes.

---

## Tecnologias utilizadas

- PHP 8.x com Laravel 12
- PostgreSQL 15
- Docker e Docker Compose
- Nginx (container)

---

## Requisitos

- Docker e Docker Compose instalados na sua máquina
- Git (para clonar o projeto)

---

## Configuração do ambiente

1. Clonar o repositório
```bash
git clone https://github.com/LeoSTeles/laravel_places_api 
```
e depois entre na pasta do projeto com o comando 
```bash 
cd laravel_places_api
```

2. Copiar o arquivo de ambiente exemplo

```bash
cp .env.example .env
```

3. Conferir as variáveis de ambiente (caso exista algum conflito de portas, por exemplo)



## Rodando o projeto

1. Subir containers com o docker

```bash
docker-compose up -d --build
```

2. Receber dependências do Laravel

```bash
docker-compose exec app composer install
```

3. Rodar o comando de migrations no docker

```bash
docker-compose exec app php artisan migrate
```

4. Acessar link de teste da API para conferir se está funcionando

```bash
http://localhost:8000/api/test
```

5. Parar o ambiente quando desejado

```bash
docker-compose down
```

## Observações

Certifique-se de que as portas 8000 (nginx) e 5432 (PostgreSQL) estejam livres na sua máquina.
Para qualquer alteração nas dependências, reconstrua a imagem do container com:  docker-compose up -d --build.
Caso queira acessar o container do app para rodar comandos artisan manualmente: docker-compose exec app bash

## Endpoints existentes na API

| Método    | URL                  | Descrição                         |
| --------- | -------------------- | --------------------------------- |
| GET       | /api/places          | Lista todos os lugares            |
| GET       | /api/places?name=xxx | Lista lugares filtrando pelo nome |
| GET       | /api/places/{id}     | Retorna um lugar específico       |
| POST      | /api/places          | Cria um novo lugar                |
| PUT/PATCH | /api/places/{id}     | Atualiza um lugar existente       |
| DELETE    | /api/places/{id}     | Deleta um lugar                   |


## Exemplos de requisições:

1. Criar um Lugar (POST /api/places)

``` bash
{
  "name": "Beach Park",
  "slug": "beach-park",
  "city": "Fortaleza",
  "state": "CE"
}
```
Headers obrigatórios (A API não irá executar o comando se os headers não existirem)

Accept: application/json
Content-Type: application/json

2. Atualizar um lugar (PUT /api/places/{id})
``` bash
{
  "name": "Beach Park Updated",
  "slug": "beach-park-updated",
  "city": "Fortaleza",
  "state": "CE"
}
```
3. Listar lugares (GET /api/places)

Sem filtros: retorna todos os lugares
Com filtro: /api/places?name=park retorna lugares que contém "park" no nome

4. Obter lugar específico (GET /api/places/{id})
Retorna o lugar com o ID informado.

5. Deletar um lugar (DELETE /api/places/{id})
Deleta o lugar pelo ID.


