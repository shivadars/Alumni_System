# ConnectWork – Alumni Interaction System

[![Live Demo](https://img.shields.io/badge/Live%20Demo-Render-00c7b7?style=for-the-badge&logo=render&logoColor=white)](https://alumni-system-y4h6.onrender.com)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-16+-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-Vite-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)

**ConnectWork** is a modern, web-based alumni interaction platform designed to bridge the gap between students, alumni, and academic departments. The platform facilitates structured communication, mentorship, job and internship opportunities, and alumni networking while keeping interactions contextually relevant through department-based content filtering.

🌐 **Live Application:** [https://alumni-system-y4h6.onrender.com](https://alumni-system-y4h6.onrender.com)

---

## 📌 Table of Contents
- [Key Features](#-key-features)
- [System Architecture & Tech Stack](#-system-architecture--tech-stack)
- [User Roles & Permissions](#-user-roles--permissions)
- [How to Use the Platform (User Guide)](#-how-to-use-the-platform-user-guide)
- [Demo Credentials](#-demo-credentials)
- [Local Development Setup](#-local-development-setup)
- [Deployment on Render](#-deployment-on-render)
- [Contributing & License](#-contributing--license)

---

## 🚀 Key Features

* **Role-Based Authentication & Access Control:** Dedicated user journeys and permission tiers for Students, Alumni, Departments, and Administrators.
* **Department-Based Content Filtering:** Feeds, announcements, and posts are organized by department to prevent clutter and ensure users only see relevant information.
* **Community Feed:** Share career advice, job and internship openings, tech discussions, and college updates with image and video support.
* **Social Engagement:** Like posts, comment on discussions, and engage in meaningful conversations with peers and seniors.
* **Alumni Directory & Search:** Comprehensive searchable directory filtered by department, pass-out batch year, and name.
* **Direct 1-on-1 Messaging:** Seamless communication between students, alumni, and faculty with unread indicators and message histories.
* **Events & Webinars:** Create, discover, and RSVP to department reunions, webinars, and networking events.
* **Admin Control Center:** Manage, verify, approve, or reject incoming user registrations to maintain community integrity.

---

## 🛠️ System Architecture & Tech Stack

```
+--------------------------------------------------------------------------+
|                              ConnectWork                                 |
|                                                                          |
|   +-----------------------+     +------------------+     +-----------+   |
|   | Blade / Tailwind / JS | <-> | Laravel 12 (MVC) | <-> | Postgres  |   |
|   |  Vite Frontend Assets |     | Eloquent & Auth  |     | Database  |   |
|   +-----------------------+     +------------------+     +-----------+   |
+--------------------------------------------------------------------------+
```

* **Backend:** PHP `8.2+` / `8.3`, Laravel `12.x` (MVC Architecture, Eloquent ORM, Middleware)
* **Frontend:** Blade Templates, Tailwind CSS, Alpine.js, Turbo / Vite
* **Database:** PostgreSQL (Production on Render) / SQLite (Local Quick-Start)
* **Storage:** Local Storage Symlink & Cloud Object Storage Driver
* **Containerization:** Docker with Apache & PHP `8.3`

---

## 👥 User Roles & Permissions

| Role | Permissions & Capabilities |
| :--- | :--- |
| **Student** | Browse department feed, apply for jobs/internships, search alumni directory, reach out via direct messaging, RSVP to events. |
| **Alumni** | Share job opportunities, post career guidance, mentor students, organize alumni meetups, message faculty and students. |
| **Department** | Post official department announcements, host webinars, coordinate with alumni, broadcast important circulars. |
| **Admin** | Full system administration, verify/approve student & alumni registrations, moderate posts and accounts. |

---

## 📖 How to Use the Platform (User Guide)

### 1. Account Registration & Onboarding
1. Visit [ConnectWork](https://alumni-system-y4h6.onrender.com).
2. Click **Register** in the top navigation.
3. Select your user role:
   * **Student:** Current college student looking for guidance, opportunities, and connections.
   * **Alumni:** Graduate willing to share opportunities, network, and mentor.
   * **Department / Faculty:** Official department representative.
4. Complete your **Profile Setup**:
   * Add your **Department** (e.g., Computer Science, Mechanical, Electronics, etc.).
   * Set your **Batch / Graduation Year**.
   * Upload a profile picture, add your bio, roll number, and social links (LinkedIn, GitHub).

### 2. Exploring the Feed & Sharing Posts
* **View Feed:** Upon login, your home dashboard displays posts specifically filtered for your department.
* **Create a Post:**
  1. Click on the post input at the top of the feed.
  2. Select a category: **Jobs**, **Internships**, **Announcements**, or **Discussions**.
  3. (Optional) Attach an image or video to your post.
  4. Click **Publish** to share with your department network.
* **Interactions:** Like helpful posts and reply with comments to ask questions.

### 3. Finding and Connecting with Alumni
* Navigate to **Alumni Directory** from the navigation bar.
* Use the search bar to find alumni by name, pass-out year, or specific department.
* View their complete profile to see their current industry role and background.
* Click the **Message** button on any profile to initiate a direct chat.

### 4. Direct Messaging
* Access your inbox via the **Messages** icon.
* Engage in 1-on-1 private messaging to ask for career advice, resume reviews, or job referrals.
* Incoming unread messages are marked with notification badges in real-time.

### 5. Events & Networking
* Visit the **Events** tab to see upcoming department webinars, mock interviews, and alumni reunions.
* Click **Attend** on any event to register your attendance and view other attendees.

### 6. Admin Panel (For Administrators)
* Login using an administrator account.
* Navigate to `/admin/dashboard` or click **Admin Dashboard**.
* Review pending registrations in the **User Management** section:
  * Click **Approve** to grant verified status.
  * Click **Reject** or delete spam accounts.

---

## 🔑 Demo Credentials

To explore the live demo immediately without creating a new account:

| Account Type | Email | Password | Role |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@example.com` | `password` | Super Admin |
| **Test User** | `test@example.com` | `password` | Verified Student |

*(You can also click **Register** to create your own personalized student or alumni account).*

---

## 💻 Local Development Setup

If you want to run ConnectWork locally on your computer:

### Prerequisites
* **PHP** `>= 8.2` (with `pdo`, `pdo_pgsql`, `pdo_sqlite`, `mbstring`, `fileinfo` extensions)
* **Composer** `>= 2.5`
* **Node.js** `>= 18.x` & **npm**
* **PostgreSQL** or **SQLite**

### Installation Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/shivadars/Alumni_System.git
   cd Alumni_System
   ```

2. **Install PHP and Node dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure the Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set Up the Database:**
   * **Option A: SQLite (Quickest, Zero Configuration):**
     In your `.env` file, set:
     ```env
     DB_CONNECTION=sqlite
     DB_DATABASE=database/database.sqlite
     ```
     Touch the database file if it does not exist:
     ```bash
     php artisan migrate --seed
     ```
   * **Option B: PostgreSQL (Matching Production):**
     Set your PostgreSQL credentials in `.env`:
     ```env
     DB_CONNECTION=pgsql
     DB_HOST=127.0.0.1
     DB_PORT=5432
     DB_DATABASE=alumni_system
     DB_USERNAME=postgres
     DB_PASSWORD=your_password
     ```
     Then run:
     ```bash
     php artisan migrate --seed
     ```

5. **Link Storage:**
   ```bash
   php artisan storage:link
   ```

6. **Build Frontend Assets & Run Local Server:**
   ```bash
   composer run dev
   ```
   *(Or start `php artisan serve` and `npm run dev` in separate terminals).*

7. Open **http://127.0.0.1:8000** in your browser.

---

## ☁️ Deployment on Render

This repository includes turnkey deployment configuration for **[Render](https://render.com)** via `render.yaml` and `Dockerfile`:

1. Fork or push this repository to your GitHub account.
2. Sign in to **[Render](https://dashboard.render.com)**.
3. Click **New +** → **Blueprint**.
4. Select your `Alumni_System` repository.
5. Render will automatically read `render.yaml`, launch the PostgreSQL database, build the Docker container, run migrations and seeders, and assign an SSL-secured live URL.

---

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).
