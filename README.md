# Cadastro de Desenvolvedores e Artigos – Laravel 12 + Livewire

Aplicação web construída com **Laravel 12**, **Livewire**, **Tailwind CSS** e **SQLite**, permitindo:
- Cadastro e gerenciamento de desenvolvedores
- Cadastro e gerenciamento de artigos
- Relacionamento *muitos-para-muitos* entre desenvolvedores e artigos
- Filtros em tempo real usando Livewire
- Layout responsivo com Tailwind CSS

---

## 🚀 Tecnologias Utilizadas
- [Laravel 12](https://laravel.com)
- [Livewire](https://livewire.laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- SQLite (banco de dados local)

---

## 📦 Instalação e Configuração

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/SEU_USUARIO/SEU_REPOSITORIO.git
cd SEU_REPOSITORIO/laravel/example-app
```

### 2️⃣ Instalar dependências PHP
```bash
composer install
```

### 3️⃣ Instalar dependências JavaScript
```bash
npm install
```

### 4️⃣ Configurar o arquivo `.env`
```bash
cp .env.example .env
```
Edite o `.env` e configure:
```env
DB_CONNECTION=sqlite
DB_DATABASE=absolute_path_para/banco-de-dados.sqlite.txt
```
> **Importante**: Use o caminho absoluto até o arquivo SQLite.

### 5️⃣ Gerar chave da aplicação
```bash
php artisan key:generate
```

---

## ▶️ Executando o projeto

### Backend (Laravel)
```bash
php artisan serve
```
Rodará em `http://127.0.0.1:8000`

### Frontend (Assets com Vite)
Em outro terminal:
```bash
npm run dev
```

---

## 🔑 Credenciais de Demonstração
- **E-mail:** admin@example.com  
- **Senha:** password  

---

## 📂 Estrutura Simplificada
```
app/
 ├── Http/Controllers   # Controladores da aplicação
 ├── Livewire           # Componentes Livewire
 ├── Models             # Modelos Eloquent
resources/views         # Views Blade
database/               # Migrations e seeders
```

---

## 📬 Contato
Dúvidas, sugestões ou melhorias?

✉️ **Email:** contato@ltcloud.com.br  
💼 **Autor:** [@victorocumura](https://github.com/victorocumura)

---

## 📜 Licença
Este projeto está sob a licença MIT. Sinta-se livre para usar e modificar.
