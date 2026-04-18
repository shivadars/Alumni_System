ConnectWork – Alumni Interaction System

Description

ConnectWork is a web-based alumni interaction platform designed to connect students, alumni, and departments in a structured and meaningful way. The system enables communication, opportunity sharing, and mentorship while ensuring that interactions remain relevant through department-based content filtering.

Technologies Used


Backend: Laravel (PHP)

Database: PostgreSQL

Frontend: HTML, CSS, JavaScript

Architecture: MVC (Model-View-Controller)

Other: Eloquent ORM, Middleware (Role-based access control)

Key Features

 Role-based authentication (Student, Alumni, Department, Admin)
 
 Department-based content visibility (users see only relevant posts)
 
 Community feed for sharing jobs, internships, and announcements
 
 Alumni directory with department-wise filtering
 
 Messaging system for communication between department and alumni
 
 Department dashboard for posting updates and interacting with users
 
 Secure routing using middleware and role-based access control
 
Process Overview

The system follows a structured workflow where users first register and log in based on their role. After authentication, the application identifies the user's department and provides access to relevant features through a unified dashboard. Posts and messages are filtered using the department ID to ensure that users only see content related to their department. The backend is built using Laravel’s MVC architecture, while PostgreSQL handles data storage efficiently. This design ensures scalability, security, and organized interaction between users.
