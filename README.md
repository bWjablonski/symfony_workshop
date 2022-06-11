# Simple symfony refactor - from standard MVC to (lazy) CQRS && DDD - workshop 

## Info
This is a workshop/learning material!

## Req:
- PHP 8.1
- sqlite3
- composer 2
- git
- symfony cli

or with Docker

## Update schema
- php bin/console doctrine:schema:create
- php bin/console doctrine:schema:update -f 
or 
- php doctrine:migrations:execute 

## How to run 
- composer install
- do steps from update schema
- symfony server:start

If using docker:
- docker exec PHP_CONTAINER_NAME_HERE -it bash
- composer install
- do steps from update schema
- chown -r 1000:1000 var/data.db
- chmod 776 var/data.db 

## Simplified business logic
/tool 
/tool/1/validate-insurance
/insurance

If tool have "big" in name it requires at least one Insurance of "OC" type
If else then we treat tool as cheap and lack of insurance is not a problem 

## About the code:
A simple example of refactoring. Here we aim to demonstrate simple way of slowly moving code from controller/views to more standalone units (in this case, messages).

Entities and services are of course simplified.
Code created by make:crud is here to be treated as "legacy" - something we want to slowly migrate from. 
We're moving away specific method - validateInsuranceStatus from ToolController.

Of course at this stage transition to DDD or CQRS is not fully done, we're still missing important parts:
- DTO and more interfaces to better secure domain layer
- Proper exception handling inside Application layer
- Entities should be in domain, but it would create some mess without additional steps
- Finally, controllers and Forms should be moved to new "UI" layer

## Others
- Running pslam: ```vendor/bin/psalm src```
- Running easy codding standards: ```vendor/bin/ecs check "src"```