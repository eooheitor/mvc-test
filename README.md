# MVC TEST
Aplicação feita em PHP com banco de dados MySQL, usando a arquitetura MVC. 

### Tecnologias usadas:

1. Doctrine
2. Bootstrap
3. Javascript

## Instalação

Siga os passos abaixo para configurar o ambiente e executar o projeto em sua máquina local.

### Passos para instalar caso utilize o Docker

1. Clone o repositório:
   ```bash
   git clone https://github.com/eooheitor/mvc-test.git

2. Mude as configurações do arquivo .env que esta dentro da pasta src conforme sua necessidade.

3. Construa e inicie os contêineres:
   ```bash
   docker-compose up --build
4. Abra um novo terminal e acesse o container em execução para criar as tabelas
   ```bash
   docker exec -it php-apache-container bash
5. Crie as tabelas:
   ```bash
   php bin/doctrine orm:schema-tool:create
6. Acesse:
   ```bash
   http://localhost:8080/

### Passos para instalar caso use o servidor do PHP
1. Clone o repositório:
   ```bash
   git clone https://github.com/eooheitor/mvc-test.git
2. Rode os comandos do composer:
   ```bash
   composer update
3. Crie a base de dados com o nome que você colocou no .env

4. Crie as tabelas:
   ```bash
   php bin/doctrine orm:schema-tool:create
5. Rode o comando:
   ```bash
   php -S localhost:5000 -t public
6. Acesse:
   ```bash
   http://localhost:5000/

## Observações
- Mude o HOST no .env de acordo com o formato de uso.
- O docker-compose deve carregar automaticamente o arquivo .env, mas se houver um problema, você pode definir as variáveis diretamente no docker-compose.yml
