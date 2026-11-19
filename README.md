# ConnectWork – Alumni Interaction System

# Description

ConnectWork is a web-based alumni interaction platform designed to connect students, alumni, and departments in a structured and meaningful way. The system enables communication, opportunity sharing, and mentorship while ensuring that interactions remain relevant through department-based content filtering.

# Technologies Used

Backend: Laravel (PHP)

Database: PostgreSQL

Frontend: HTML, CSS, JavaScript

Architecture: MVC (Model-View-Controller)

Other: Eloquent ORM, Middleware (Role-based access control)

# Key Features

 * Role-based authentication (Student, Alumni, Department, Admin)
 
 * Department-based content visibility (users see only relevant posts)
 
 * Community feed for sharing jobs, internships, and announcements
 
 * Alumni directory with department-wise filtering
 
 * Messaging system for communication between department,alumni and students
  
 * Secure routing using middleware and role-based access control
 
Process Overview

The system follows a structured workflow where users first register and log in based on their role. After authentication, the application identifies the user's department and provides access to relevant features through a unified dashboard. Posts and messages are filtered using the department ID to ensure that users only see content related to their department. The backend is built using Laravel’s MVC architecture, while PostgreSQL handles data storage efficiently. This design ensures scalability, security, and organized interaction between users.

# Live Hosted Link

The application is deployed on Render:
**URL:** [https://alumni-system-y4h6.onrender.com](https://alumni-system-y4h6.onrender.com)

# How to Use

### 1. Getting Started & Registration
1. Open the live link: [https://alumni-system-y4h6.onrender.com](https://alumni-system-y4h6.onrender.com)
2. Click **Register** in the top navigation.
3. Select your role (**Student**, **Alumni**, or **Department**) and provide your name, email, and password.
4. Complete your profile by entering your department, graduation year, bio, and social links.

### 2. Exploring & Posting on the Feed
* Once logged in, your dashboard displays posts tailored specifically to your department.
* To create a post, click on the post input at the top of the feed.
* Select a category (**Jobs**, **Internships**, **Announcements**, or **Discussions**), write your content, optionally attach an image or video, and click publish.
* You can like posts and add comments to participate in discussions.

### 3. Finding Alumni & Direct Messaging
* Click on **Alumni Search** or **Alumni Directory** in the navigation bar.
* Filter or search alumni by name, pass-out batch year, or department.
* Click on an alumnus profile to view their details, or click the **Message** button to start a private 1-on-1 chat.
* You can access all your active conversations and unread messages from the **Messages** tab.

### 4. Admin Management
* Administrators can log in to view the Admin Dashboard (`/admin/dashboard`).
* Admins can verify, approve, or reject new user registrations under user management to ensure platform safety.

### 5. Demo Accounts
To quickly test the platform without registering:
* **Admin Account:** `admin@example.com` | Password: `password`
* **Test User Account:** `test@example.com` | Password: `password`
