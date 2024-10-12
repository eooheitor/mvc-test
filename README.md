# MVC TEST
Aplicação feita em PHP com banco de dados MYSQL, usando a arquitetura MVC. 

### Tecnologias usadas:

1. Doctrine
2. Bootstrap
3. Javascript

## Instalação

Siga os passos abaixo para configurar o ambiente e executar o projeto em sua máquina local.

### Passos para instalar

1. Clone o repositório:
   ```bash
   git clone https://github.com/eooheitor/mvc-test.git
2. Rode os comandos do composer:
   ```bash
   composer update
3. Crie as tabelas no seu banco de dados com o comando:
   ```bash
   php bin/doctrine orm:schema-tool:create
4. Mude as configurações do arquivo .env que esta dentro da pasta src conforme sua necessidade.
5. Caso queria usar o DOCKER rode o comando:
   ```bash
   docker-compose up --build
6. Caso queria usar o servidor embutido do php, rode o comando:
   ```bash
   php -S localhost:5000 -t public