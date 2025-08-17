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
3. Run migrations & seeders
```bash
   php artisan migrate --seed
```
4. Start the server
```bash
   php artisan serve
```
#### 🔑 Authentication

- Authentication is handled via Laravel Sanctum.

- After login, the API returns a Bearer Token.

- All protected routes require the following header:

  `Authorization: Bearer <token>`

##### 📌 API Endpoints

### 🔐 Auth
- **POST** `/api/user/register` → Register a new user
- **POST** `/api/user/login` → Login and get token
- **POST** `/api/user/logout` → Logout (requires token)

---

### 📝 Posts
- **GET** `/api/user/posts` → Get all posts (User)
- **GET** `/api/admin/posts/{post}` → Get a single post (**Admin only**)
- **GET** `/api/admin/posts/create` → Create a post (**Admin only**)
- **PUT** `/api/adminposts/{post}` → Update a post (**Admin only**)
- **DELETE** `/api/admin/posts/{post}` → Delete a post (**Admin only**)

---

### 💬 Comments
- **POST** `/api/user/posts/{post}/comments` → Add a comment to a post (User)
- **GET** `/api/user/posts` → View posts and approved comments
- **PUT** `/api/admin/comments/{comment}/approve` → Approve a comment (**Admin**)
- **PUT** `/api/admin/comments/{comment}/reject` → Reject a comment (**Admin**)  

###### 🧪 Testing the API

- You can test the API using tools like Postman or Insomnia.
