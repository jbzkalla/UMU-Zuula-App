# UMU-Zuula Technical User Manual 

Welcome to the technical documentation for the **UMU-Zuula Lost and Found System**. This manual explains the purpose of each directory and key file to help you understand the system architecture during your presentation.

**Project Designed by:** Kato Joseph Bwanika (0708419371)

---

## Directory Structure Overview

### 1. `root/` (Public Portal)
The root directory contains files for the public-facing side of the website.
- **`index.php`**: The main entry point. It handles routing for the public pages (About, Contact, Home).
- **`home.php`**: The landing page displaying university branding and a call to action.
- **`items.php`**: Displays the gallery of Lost and Found items.
- **`item_detail.php`**: Shows specific details for a selected item, including its image and reporting user.
- **`login.php` & `register.php`**: Handles student authentication.

### 2. `admin/` (Administrative Portal)
Contains all administrative tools used by the Security and Admin staff.
- **`index.php`**: The admin dashboard portal.
- **`categories/`**: Management of item categories (e.g., Electronics, Documents).
- **`items/`**: Full control over reported items, including editing and deletion.
- **`claims/`**: The workflow for approving or rejecting item claims.
- **`faqs/`**: Interface for administrators to update the system's dynamic FAQ list.
- **`messages/`**: The administrative inbox for student inquiries.
- **`notifications/`**: Tools for sending system-wide broadcasts.
- **`reports/`**: Analytics dashboard showing resolution rates.
- **`audit_logs/`**: Real-time tracking of all system activity.

### 3. `user/` (Student Portal)
Personal dashboard for students to track their activity.
- **`home.php`**: Displays student-specific stats (My Reports, My Claims).
- **`my_reports.php`**: List of items the student has reported (Lost or Found).
- **`my_claims.php`**: Status tracking for claims the student has made on found items.
- **`messages.php`**: Real-time chat interface with administrators.
- **`change_password.php`**: Secure interface for updating account credentials.

### 4. `classes/` (Backend Logic)
The "Brain" of the system.
- **`DBConnection.php`**: Handles the connection to the MySQL database.
- **`Master.php`**: Contains the core business logic (saving items, deleting claims, sending messages).
- **`Users.php`**: Manages user-specific logic (registration, login, profile updates).
- **`SystemSettings.php`**: Manages global system information like branding and logos.

### 5. `inc/` (Reusable Components)
- **`header.php` & `footer.php`**: Standard layouts used across all pages.
- **`navigation.php`**: The main navigation menu logic.

---

##  Key Technical Features
1. **Dynamic FAQs**: Managed via the Admin Panel and instantly reflected on the Public page.
2. **Real-Time Messaging**: Implemented using AJAX to allow instant communication without page reloads.
3. **Secure Authentication**: Uses PHP `password_hash` (bcrypt) for all student and admin accounts.
4. **Audit Trail**: Every significant action (Logins, Status changes) is recorded in the `audit_logs` table.

