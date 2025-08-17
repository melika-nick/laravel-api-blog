# 📰 Laravel 12 Blog API

This is a **Blog RESTFUL API** built with **Laravel 12**.  
It supports both **Admin** and **User** roles with authentication powered by **Laravel Sanctum**.

---

## ✨ Features

- User & Admin authentication with **Sanctum**
- **CRUD operations** on posts (only accessible by Admin)
- Users can view posts
- Users can submit **comments** on posts
- Admin can **approve** or **reject** comments
- Only **approved comments** are visible to users
- **Seeders & Factories** for generating test data (Users & Posts)

---

## ⚙️ Installation

1. Clone the repository
```bash
  git clone https://github.com/melika-nick/laravel-api-blog
  cd laravel-blog-api
    ```
2. Install dependencies
```bash
   composer install
    npm install && npm run build
```
