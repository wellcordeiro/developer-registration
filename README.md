# `Desafio GazinTech`
# **Developer Registration (Backend)**

Projeto produzido para participar do processo seletivo da [**GazinTech**](https://gazin.com.br/).


### **Tecnologias**
PHP 8.1x, [Laravel 9x](https://laravel.com), Composer 2.4.x
### Ferramentas utilizadas

[DevilBox (DOCKER)](http://devilbox.org) - Ambiente de desenvolvimento (OPCIONAL)

[Insomnia](https://insomnia.rest/download) - Testes API

[HeidiSQL](https://www.heidisql.com/download.php) - Acessar banco de dados (OPCIONAL)



### **Executando o projeto**

#### **1.** Clone o projeto

```
git clone https://github.com/wellcordeiro/developer-registration.git 
```

### Configurações do Projeto
#### Entre na pasta do projeto
```
 cd developer-registration
```
#### **2.** Instale as dependências do projeto
```     
composer install
```


Configure o arquivo `.env` da aplicação conforme o `.env.example`

```docker
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=developer-registration
DB_USERNAME=root
DB_PASSWORD=
```




#### **3.** Rode as migrações e Realize os testes:
```
php artisan migrate
php artisan test
```
#### **4.** Rode a aplicação com:
```
php artisan serve

http://127.0.0.1:8000
```



### **Rotas**

#### **1.** Consultar/ Cadastrar e buscar níveis
```
HEADERS: Accept: application/json / Content-Type: application/json
GET/HEAD http://127.0.0.1:8000/levels
GET/HEAD http://127.0.0.1:8000/levels?name= {BUSCA}


POST http://127.0.0.1:8000/levels
PUT/PATCH http://127.0.0.1:8000/levels/{id}
DELETE http://127.0.0.1:8000/levels/{id}

BODY: { "name": "TESTE 06"  }
```

#### **2.** Consultar/ Cadastrar e buscar desenvolvedores
```
HEADERS: Accept: application/json / Content-Type: application/json
GET/HEAD http://127.0.0.1:8000/developers
GET/HEAD http://127.0.0.1:8000/developers?level_id= {id}
GET/HEAD http://127.0.0.1:8000/developers?name= {nome/email}


POST http://127.0.0.1:8000/developers
PUT/PATCH http://127.0.0.1:8000/developers/{id}
DELETE http://127.0.0.1:8000/developers/{id}

BODY: {
     "name": "Welington Cordeiro",
	"email": "well@gazintech.com",
	"level_id": "14",
	"gender": "M",
	"birthdate": "2022-09-20",
	"hobby": "Coding.. :)"
}
```


Feito com <3 by [**Welington Cordeiro**](https://github.com/wellcordeiro)