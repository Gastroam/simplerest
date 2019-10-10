# SimpleRestFul

## Request examples

## GET <READ>

    GET /api/products
    GET /api/products/83

### Search    

    GET /api/products?name=Vodka
    GET /api/products?name=Vodka&size=1L

A OR B

    GET /api/products?name=Vodka,Wisky,Tekila

### Comparision operators

    =    eq
    !=   neq
    >    gt
    <    lt
    >=   gteq
    <=   lteq

Example:    

    GET /api/products?cost[gteq]=100&cost[lteq]=250

### List of fields to include

    GET /api/products?fields=id,name,cost
    GET /api/products/83?fields=id,name,cost
    GET /api/products?fields=id,cost&name=Vodka


### Exclude fields

    GET /api/users?exclude=firstname,lastname


### Select null or not null values

    GET /api/products?description=NULL
    GET /api/products?description[neq]=NULL


## POST <CREATE>

    POST /api/products

With a request body like:

    {
        "name": "Vodka",
        "description": "from Bielorussia",
        "size": "2L",
        "cost": "200"
    }

## DELETE

    DELETE /api/products/100

## PUT  <UPDATE>

    PUT /api/products/84

With a request body like:

    {
        "name": "Vodka",
        "description": "from Bielorussia",
        "size": "2L",
        "cost": "200"
    }

## PATCH <PARTIAL UPDATE>

    PUT /api/products/84

With a request body like:

    {
        "description": "from Bielorussia!",
        "cost": "230"
    }

## ORDER BY

    GET /api/products?order[cost]=DESC
    GET /api/products?order[cost]=DESC&order[name]=ASC
    GET /api/products?order[cost]=ASC&order[id]=DESC

## LIMIT

    GET /api/products?limit=10
    GET /api/products?offset=40&limit=10
    GET /api/products?limit=10&order[name]=ASC&order[cost]=DESC&size=2L
