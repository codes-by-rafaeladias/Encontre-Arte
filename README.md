# Encontre Arte – Marketplace para Conexão entre Artesãos Independentes e Clientes

Projeto apresentado como requisito parcial de avaliação da disciplina **Trabalho de Conclusão de Curso II**, do curso de **Sistemas de Informação** do **Instituto Federal de Educação, Ciência e Tecnologia da Bahia – IFBA**.

**Discente:** Rafaela Dias dos Santos

---

## Informações 

O **Encontre Arte** é um marketplace desenvolvido para **facilitar a conexão entre artesãos independentes e consumidores** dentro do contexto da **Economia Criativa**.

A plataforma permite que artesãos cadastrem seus produtos, recebam avaliações e divulguem seu trabalho, enquanto consumidores encontram peças únicas e artesanais de forma centralizada e intuitiva.

---

## Objetivos

- Analisar as demandas do setor da Economia Criativa, identificando as necessidades específicas dos profissionais atuantes no artesanato.  
- Propor uma solução tecnológica capaz de promover a divulgação e comercialização de produtos artesanais.  
- Facilitar a aproximação e interação entre artesãos independentes e consumidores por meio de um marketplace digital.

---

## Funcionalidades

- Cadastro e autenticação de usuários, incluindo artesãos e clientes.  
- Cadastro, atualização e gerenciamento de produtos artesanais.  
- Exibição detalhada das informações de cada produto cadastrado.  
- Listagem e visualização dos artesãos cadastrados na plataforma.  
- Registro e gerenciamento de avaliações dos produtos pelos usuários.  
- Visualização detalhada do perfil de cada artesão, incluindo seus produtos.

---

## Tecnologias Usadas

- **PHP**: Linguagem de programação utilizada no desenvolvimento do back-end da aplicação.  
- **Laravel v12**: Framework PHP empregado para estruturar a aplicação e gerenciar rotas, controllers e modelos.  
- **MySQL**: Sistema de gerenciamento de banco de dados relacional utilizado para armazenamento das informações da aplicação.  
- **XAMPP**: Pacote de servidor web que inclui Apache, MySQL e PHP, utilizado para executar a aplicação localmente.  
- **Composer**: Gerenciador de dependências do PHP, utilizado para instalar e atualizar pacotes necessários ao projeto.  
- **Git**: Sistema de controle de versão utilizado para versionamento e histórico do código-fonte.  
- **HTML5, CSS3 e JavaScript**: Tecnologias empregadas na criação e estilização da interface gráfica da aplicação.

---

## Artefatos

**Vídeo de Demonstração do Sistema**  
[Assista aqui no YouTube](https://youtu.be/kdQEGLcVpUU)

---

## Como Instalar e Usar

### Requisitos

Antes de iniciar, certifique-se de ter instalado:

- **XAMPP** (com Apache e MySQL ativos)  
- **Composer** (gerenciador de dependências do PHP)  
- **Node.js** (ambiente de execução Javascript)
- **NPM** (gerenciador de pacotes do Node.js)
- **Git** (para clonar o repositório)

---

### 1. Clonar o repositório

Dentro da pasta do XAMPP (`C:\xampp\htdocs`):

```bash
cd C:\xampp\htdocs
git clone https://github.com/codes-by-rafaeladias/Encontre-Arte.git 
cd Encontre-Arte
```

---

### 2. Instalar Dependências

```bash
composer install
```

---

### 3. Criar o Arquivo `.env`

Copie o arquivo de exemplo:

```bash
cp .env.example .env # Linux/Mac
copy .env.example .env # Windows
```

Depois, configure o `.env` com suas credenciais do banco:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Gerar a Chave da Aplicação

```bash
php artisan key:generate
```

---

### 5. Rodar Migrações

```bash
php artisan migrate
```

---

### 6. Instalar dependências do Node.js

```bash
npm install
```

---

### 7. Iniciar o Servidor Vite

```bash
npm run dev
```

---

### 8. Iniciar o Servidor Laravel

```bash
php artisan serve
```

A aplicação estará disponível em: http://localhost:8000