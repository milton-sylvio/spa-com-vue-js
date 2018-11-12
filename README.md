########################################################
########################################################

# SINGLE PAGE COM VUE JS E LAVARAVE

########################################################
########################################################


# spa-com-vue-js
Repositório referente ao curso de SPA com Vue JS e API com Laravel (https://bit.ly/2MEhbZ6)

########################################################
# VUE JS
########################################################

# AXIOS
########################################################

# Instalar o Axios:
npm install axios

# Para utilizar 
import axios from 'axios'

# VUEX (https://vuex.vuejs.org/ptbr/)
########################################################
npm install vuex --save

# SLUG (https://www.npmjs.com/package/slug)
########################################################
npm install slug




########################################################
# API COM LARAVEL
########################################################

# Instalar o Laravel
composer create-project --prefer-dist laravel/laravel webservice "5.5.*"

composer require laravel/passport "4.0"

# Configurar o banco de dados
php artisan migrate

php artisan passport:install

# Colocar no User (app/User.php):
use Laravel\Passport\HasApiTokens;
use HasApiTokens, Notifiable;

# Configurar o config/auth.php
'api' => [
    'driver' => 'passport',
    'provider' => 'users',
],

# Rodar o servidor local do PHP
php artisan serve

# Baixar o Postman:
https://www.getpostman.com/

# Incluir no arquivo routes/api.php
# para corrigir o problema de "allowed by Access-Control-Allow-Origin"
# refrencia: https://bit.ly/2QF6W4h
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

# Adicionar uma Migração no Laravel...
php artisan make:migration add_image_table_user --table=users

# ... depois rodar o comando 
php artisan migrate

# Para criar controllers
php artisan make:controller UserController

# Adicionar o TIMEZONE no config/app.php (linha 68)
'timezone' => 'America/Sao_Paulo', 


# CORS
########################################################
# Instalação no Laravael 
https://github.com/barryvdh/laravel-cors

# Comando para instalação (via terminal):
composer require barryvdh/laravel-cors

# Banco de Dados
########################################################

# Tabelas:
users
contents (id, user_id, title, text, image, link, date)
friends (user_id, friend_id)
likes (user_id, content_id)
comments (id, user_id, content_id, text, date)

# Criando Modelos e Migrações
php artisan make:model Content -m
php artisan make:model Comment -m
php artisan make:migration create_friends_table --create=friends
php artisan make:migration create_likes_table --create=likes

# Criando as Tabelas
php artisan migrate