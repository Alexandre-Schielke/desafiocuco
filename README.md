<h2>Requisitos para rodar o projeto deste repositório(backend)</h2>
<p>Primeiramente você pode ver esse projeto rodando <a href="http://codezeus.com.br/"> CLIQUE AQUI PARA VER O PROJETO RODANDO</a><p>
<p>O projeto foi feito utilizando o micro framework Lumen v. 8 do laravel, para que ele rode temos que seguir os requisitos da própia documentação <a href="https://lumen.laravel.com/docs/8.x"> CLIQE AQUI PARA IR A DOCUMENTAÇÃO</a></p>
<p>
	Após clonar o projeto do github (git clone https://github.com/Schielke-code/desafiocuco.git) abra a pasta do projeto e rode os seguinte comando dentro do terminal:
	<code>composer install</code>
</p>
<p>
	Concluindo esta etapa copie o arquivo ".env.example" e cole renomeando para ".env (cole no mesmo diretório do .env.example)" ou somente da o comando <code>cp .env.example .env</code>
</p>

<p>
	Abra novamente o seu terminal e gere uma chave com o seguinte comando:  <code>php artisan key:generate</code>
</p>

<p>
	Agora vamos limpar o seu arquivo de configuração usando o comando:  <code>php artisan config:clear</code> </p>


<h2>Configurando o banco de dados no arquivo .env</h2>

<p>
	Crie um banco de dados Mysql no seu localhost (nome do banco 'api_cuco') apont para o banco criado e rode o arquivo "banco.sql" q se entra na raiz desse projeto.
</p>

<p>
	Após criar o banco atualize as informações do seu banco no arquivo .env com as seguintes configurações:<br/><br/>

	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=api_cuco
	DB_USERNAME=root
	DB_PASSWORD={senha-se-necessario}

</p>
<p>
	Agora vamos limpar o seu arquivo de configuração usando o comando: <code>php artisan config:clear</code>
</p>
<p>
	com o banco de dados criado e o .env atualizado abra o seu terminal setado para a pasta do seu projeto e execute o comando: <code>php artisan migrate</code>, observe que as suas tabelas vão ser criadas utilizando a função migrate do laravel
</p>

<p>
   Aproveitado que o seu terminal esta aberto execute o comando <code>php artisan serve</code>, veja que vai exibir o link no qual o seu backend esta rodando, deixe o rodando e vamos para configuração do front end
   <a href="https://github.com/Schielke-code/" target="_blank">clicando aqui</a>
</p>

<h2>Documentação collection  do Postman</h2>
<p>
	Documentação do collection através do link "https://www.postman.com/warped-comet-5254/workspace/desafiocuco/documentation/10762742-4530ea88-91ca-4cf6-9381-02b4d701af16".
</p>

# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


