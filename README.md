# 🚀 Business Listing & Rating System

A modern, dynamic **Business Directory & Rating Platform** built using **Core PHP (MVC)**, **MySQL**, **jQuery AJAX**, and **Bootstrap 5**.
This project demonstrates real-world development practices including **clean architecture, asynchronous UI updates, and third-party plugin integration**.

---

## 🌟 Project Highlights

✨ Fully dynamic Business Management System
✨ Real-time rating updates (no page reload)
✨ Clean MVC-based architecture (Core PHP)
✨ Interactive UI with Bootstrap 5
✨ Star Rating System using Raty Plugin
✨ Optimized SQL queries with relational integrity

---

## 🛠️ Tech Stack

| Technology  | Description                   |
| ----------- | ----------------------------- |
| PHP (Core)  | Backend logic (MVC structure) |
| MySQL       | Database management           |
| jQuery      | DOM manipulation              |
| AJAX        | Real-time data updates        |
| Bootstrap 5 | Responsive UI                 |
| Raty Plugin | Star rating system            |

---

## 📁 Project Structure

```
project-root/
│
├── config/
│   └── database.php
│
├── models/
│   ├── Business.php
│   └── Rating.php
│
├── controllers/
│   ├── BusinessController.php
│   └── RatingController.php
│
├── ajax/
│   ├── business_ajax.php
│   └── rating_ajax.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── plugins/raty/
│
├── views/
│   ├── index.php
│   └── modals.php
│
├── database.sql
└── README.md
```

---

## ⚙️ Features

### 🏢 Business Management (CRUD)

* Add new business via modal (AJAX)
* Edit existing business details
* Delete business with confirmation
* Instant UI updates without refresh

---

### ⭐ Rating System

* Star-based rating (0–5 with half-star support)
* Built using Raty jQuery Plugin
* Users can rate businesses via modal
* Existing users (email/phone) can update ratings

---

### 🔄 Real-Time Updates

* Ratings update instantly using AJAX
* Average rating recalculated dynamically
* No page reload required

---

### 🧠 Smart Rating Logic

* Prevents duplicate ratings
* Updates rating if user already exists
* Maintains data consistency

---

## 🗄️ Database Schema

### 📌 businesses

| Column     | Type      |
| ---------- | --------- |
| id         | INT (PK)  |
| name       | VARCHAR   |
| address    | TEXT      |
| phone      | VARCHAR   |
| email      | VARCHAR   |
| created_at | TIMESTAMP |

---

### 📌 ratings

| Column      | Type         |
| ----------- | ------------ |
| id          | INT (PK)     |
| business_id | INT (FK)     |
| name        | VARCHAR      |
| email       | VARCHAR      |
| phone       | VARCHAR      |
| rating      | DECIMAL(2,1) |
| created_at  | TIMESTAMP    |

---

## 🧩 Key SQL Query (Average Rating)

```sql
SELECT b.*, 
       IFNULL(AVG(r.rating), 0) as avg_rating
FROM businesses b
LEFT JOIN ratings r ON b.id = r.business_id
GROUP BY b.id;
```

---

## ⚡ Installation Guide (MySQL Workbench + XAMPP)

### 1️⃣ Clone Repository

```bash
git clone https://github.com/Siddhant963/nadsoft.git
```

---

### 2️⃣ Setup Database

* Open **MySQL Workbench**
* Open `database.sql`
* Click ⚡ Execute

---

### 3️⃣ Configure Database

Edit:

```
config/database.php
```

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "business_rating_system";
```

---

### 4️⃣ Run Project

* Move project to:

```
htdocs/ (XAMPP)
```

* Open browser:

```
http://localhost/project-folder/
```

---

## 🎯 Core Concepts Demonstrated

✔ MVC Architecture in Core PHP
✔ AJAX-based CRUD operations
✔ Third-party plugin integration
✔ Clean and maintainable code
✔ Database normalization & relationships
✔ Real-time UI rendering

---

## 🔐 Security Practices

* Prepared statements (SQL Injection prevention)
* Input validation (client + server)
* Output escaping (`htmlspecialchars`)
* Clean data handling

---

## 🎨 UI/UX Highlights

* Responsive Bootstrap 5 layout
* Modern dashboard-style design
* Smooth modals and transitions
* Interactive rating visuals

---

## 📸 Screenshots

> Add your screenshots here (UI, rating modal, dashboard)

---

## 🚀 Future Enhancements

* 🔐 Authentication system (Admin/User)
* 🔍 Search & filter businesses
* 📄 Pagination
* 🌐 API integration
* 📊 Analytics dashboard

---

## 👨‍💻 Author

**Siddhant Dubey**
Backend Developer | MERN & PHP Specialist
📍 India

---

## 📄 License

This project is for educational & assessment purposes.

---

## 💡 Final Note

This project reflects **real-world development practices** and showcases the ability to build scalable, maintainable, and interactive web applications using a traditional stack.

---
