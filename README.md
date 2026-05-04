# 📋 EMC Attendance System

<p align="center">
  <img src="https://payments.esoft.lk/images/esoft-logo.png" alt="ESOFT Logo" width="200"/>
</p>

<p align="center">
  <a href="https://www.php.net/">
    <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/>
  </a>
  <a href="https://www.mysql.com/">
    <img src="https://img.shields.io/badge/MySQL-8.x-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/>
  </a>
  <a href="https://getbootstrap.com/">
    <img src="https://img.shields.io/badge/Bootstrap-5.3.7-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap"/>
  </a>
  <a href="https://jquery.com/">
    <img src="https://img.shields.io/badge/jQuery-3.7.1-0769AD?style=for-the-badge&logo=jquery&logoColor=white" alt="jQuery"/>
  </a>
  <a href="https://github.com/eamalindu/EMC-Attendance-System/blob/main/LICENSE">
    <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License"/>
  </a>
  <a href="https://github.com/eamalindu/EMC-Attendance-System">
    <img src="https://img.shields.io/badge/Maintained%20by-@eamalindu-blue?style=for-the-badge&logo=github" alt="Maintained by"/>
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/github/last-commit/eamalindu/EMC-Attendance-System?style=flat-square" alt="Last Commit"/>
  <img src="https://img.shields.io/github/repo-size/eamalindu/EMC-Attendance-System?style=flat-square" alt="Repo Size"/>
  <img src="https://img.shields.io/github/languages/top/eamalindu/EMC-Attendance-System?style=flat-square" alt="Top Language"/>
  <img src="https://img.shields.io/github/issues/eamalindu/EMC-Attendance-System?style=flat-square" alt="Issues"/>
</p>

---

A full-featured, web-based **Student Attendance Management System** built for ESOFT Nittambuwa. It enables staff to efficiently track attendance, manage student and batch records, generate reports, and send SMS/email notifications — all through a clean, responsive interface.

---

## 📑 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Screenshots](#-screenshots)
- [Prerequisites](#-prerequisites)
- [Installation & Setup](#-installation--setup)
- [Database Configuration](#-database-configuration)
- [Database Schema](#-database-schema)
- [File Structure](#-file-structure)
- [Usage Guide](#-usage-guide)
- [SMS & Email Notifications](#-sms--email-notifications)
- [Security](#-security)
- [Contributing](#-contributing)
- [Author](#-author)

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔐 **Secure Login** | Session-based authentication with username & password |
| 🔑 **Password Reset** | Email-based password reset via PHPMailer |
| 📊 **Dashboard** | At-a-glance stats: Active, Postponed, Suspended, and Inactive students |
| 📅 **Class Schedule** | Today's class list shown directly on the dashboard |
| ✅ **Mark Attendance** | Mark student attendance by registration number or barcode scan |
| 🕓 **Attendance History** | View per-student attendance history with Excel export |
| 📄 **Attendance Report** | Filter attendance records by date and batch; export to Excel |
| 🚫 **Absent Report** | Identify and export absent students for any date and batch |
| 👤 **Manage Students** | Add, view, update, and soft-delete student records |
| 📤 **Bulk Upload** | Upload students in bulk from `.xlsx` or `.csv` files |
| 🏫 **Manage Batches** | Create and manage batches with per-day schedules and class timings |
| ✔️ **Complete Batch** | Mark a batch as completed to archive it |
| 🔖 **Update Barcode** | Assign or update the barcode/EID for any student |
| 📱 **SMS Notifications** | Send SMS alerts to students/parents via the text.lk API |
| 📧 **Email Notifications** | Send welcome emails and notifications via PHPMailer |
| 🗂️ **Activity Logs** | Automatic logging of user actions (login events with IP address) |
| 📱 **Responsive UI** | Mobile-friendly design using Bootstrap 5 |

---

## 🛠 Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8.x |
| **Database** | MySQL 8.x |
| **Frontend** | HTML5, CSS3, Bootstrap 5.3.7 |
| **JavaScript** | jQuery 3.7.1, Vanilla JS |
| **Tables** | DataTables 2.3.2 |
| **Excel Export/Import** | SheetJS (xlsx-latest) |
| **Email** | PHPMailer 6.10.0 |
| **SMS** | text.lk REST API |
| **Icons** | Font Awesome Pro 5 |
| **Modals** | Custom Modal v2 (built-in) |
| **Fonts** | Google Fonts (Poppins) |

---

## 📸 Screenshots

> _Screenshots can be added here to showcase the login page, dashboard, attendance marking, reports, and batch management screens._

| Login Page | Dashboard |
|---|---|
| _(screenshot)_ | _(screenshot)_ |

| Mark Attendance | Attendance Report |
|---|---|
| _(screenshot)_ | _(screenshot)_ |

| Manage Students | Manage Batches |
|---|---|
| _(screenshot)_ | _(screenshot)_ |

---

## ✅ Prerequisites

Before installing, make sure you have:

- **PHP** 8.0 or higher
- **MySQL** 8.0 or higher
- A web server: **Apache** (recommended) or **Nginx**
- **Composer** _(optional — PHPMailer is already bundled)_
- A mail server or SMTP credentials (for password reset emails)
- A [text.lk](https://text.lk) API key (for SMS notifications)

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/eamalindu/EMC-Attendance-System.git
cd EMC-Attendance-System
```

### 2. Deploy to Web Server

Copy the project folder to your web server's root directory:

- **XAMPP / WAMP:** Place in `htdocs/` or `www/`
- **Linux (Apache):** Place in `/var/www/html/`

### 3. Configure the Database

Open `config.php` and update the connection settings to match your environment:

```php
$serverName = "localhost";
$username   = "your_db_username";
$password   = "your_db_password";
$database   = "attendance";
$port       = "3306";  // Default MySQL port
```

### 4. Import the Database

Create a MySQL database named `attendance` and import the SQL schema:

```sql
CREATE DATABASE attendance;
```

Then import the provided SQL dump (if available) or create the tables manually — see the [Database Schema](#-database-schema) section below.

### 5. Configure PHPMailer (for Password Reset & Email Notifications)

Open `processReset.php` and `mailTemplate.php` and update the SMTP settings:

```php
$mail->isSMTP();
$mail->Host       = 'smtp.yourmailprovider.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'your@email.com';
$mail->Password   = 'your_email_password';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;
```

### 6. Configure SMS (text.lk)

Open `sms.php` and replace the placeholder API key with your real key:

```php
$apiKey = "YOUR_TEXTLK_API_KEY_HERE";
```

### 7. Access the System

Open your browser and navigate to:

```
http://localhost/EMC-Attendance-System/
```

Log in with your admin credentials.

---

## 🗄 Database Configuration

The system connects to a MySQL database using the settings in `config.php`. Make sure the database user has the following privileges:

```sql
GRANT SELECT, INSERT, UPDATE, DELETE ON attendance.* TO 'your_user'@'localhost';
FLUSH PRIVILEGES;
```

---

## 🧩 Database Schema

The system uses the following core tables:

### `users`
| Column | Type | Description |
|---|---|---|
| `id` | INT (PK, AI) | User ID |
| `username` | VARCHAR | Login username |
| `password` | VARCHAR | Login password |
| `email` | VARCHAR | User email address |

### `student`
| Column | Type | Description |
|---|---|---|
| `reg` | VARCHAR (PK) | Student registration number |
| `name` | VARCHAR | Full name |
| `eid` | VARCHAR | Student EID / barcode |
| `batch` | VARCHAR | Assigned batch name |
| `contact` | VARCHAR | Student contact number |
| `pStatus` | VARCHAR | Parent contact number |
| `email` | VARCHAR | Student email |
| `sStatus` | VARCHAR | Status: Active, Postponed, Suspended, Inactivated, Deleted |
| `addedBy` | VARCHAR | Username who added the record |
| `created_at` | DATETIME | Record creation timestamp |

### `batch`
| Column | Type | Description |
|---|---|---|
| `name` | VARCHAR (PK) | Batch name (e.g., `L4-DiSE-01`) |
| `monday` – `sunday` | TINYINT(1) | Class days (1 = Yes, 0 = No) |
| `startTime` | TIME | Class start time |
| `endTime` | TIME | Class end time |
| `status` | VARCHAR | Active / Completed |

### `attendance`
| Column | Type | Description |
|---|---|---|
| `id` | INT (PK, AI) | Attendance record ID |
| `reg_id` | VARCHAR | Student registration number (FK → student) |
| `batch_id` | VARCHAR | Batch name (FK → batch) |
| `timestamp` | DATETIME | Date and time attendance was marked |
| `addedBy` | VARCHAR | Username who marked attendance |

### `log`
| Column | Type | Description |
|---|---|---|
| `id` | INT (PK, AI) | Log entry ID |
| `user` | VARCHAR | Username |
| `description` | VARCHAR | Log description |
| `created` | DATETIME | Log timestamp |

---

## 📁 File Structure

```
EMC-Attendance-System/
│
├── config.php                  # Database connection settings
├── index.php                   # Login page
├── dashboard.php               # Main dashboard
│
├── attendance.php              # Mark attendance page
├── addAttendance.php           # AJAX handler: save attendance record
├── attendance-history.php      # Per-student attendance history
├── attendance-report.php       # Attendance report (by date & batch)
├── generateReport.php          # AJAX handler: fetch report data
│
├── absent.php                  # Absent students report
│
├── manage-students.php         # Student management (list, edit, delete)
├── add-students.php            # AJAX handler: add / update students
├── updateStudent.php           # AJAX handler: update student record
├── deleteStudent.php           # AJAX handler: soft-delete student
├── getStudent.php              # AJAX handler: fetch student details
├── upload-students.php         # Bulk student upload page
│
├── manage-batches.php          # Batch management (list, add, edit)
├── getBatch.php                # AJAX handler: fetch batch details
├── completeBatch.php           # AJAX handler: mark batch as completed
│
├── update-barcode.php          # Update student barcode/EID page
├── updateBarCode.php           # AJAX handler: save updated barcode
│
├── active-students.php         # Active students listing
│
├── Reset-Password.php          # Password reset request page
├── processReset.php            # Handles reset link generation & email
├── update-password.php         # Handles password update after reset
├── passwordReset.html          # Reset email HTML template
│
├── todayClassList.php          # Renders today's batch schedule (included in dashboard)
├── getIP.php                   # Utility: get client IP address
├── logout.php                  # Handles user logout
│
├── sms.php                     # SMS utility (text.lk API)
├── mailTemplate.php            # Email template helper
├── welcomeMail.html            # Welcome email HTML template
│
├── css/
│   ├── style.css               # Login page styles
│   ├── dashboard.css           # Dashboard styles
│   ├── all.css                 # Shared/global styles
│   └── loader.css              # Page preloader animation
│
├── js/
│   ├── app.js                  # Attendance marking logic
│   ├── report.js               # Attendance report logic
│   ├── manageStudents.js       # Student management logic
│   ├── manageBatches.js        # Batch management logic
│   ├── upload-students.js      # Bulk upload logic
│   ├── update-barcode.js       # Barcode update logic
│   ├── external-table.js       # DataTables initialisation
│   ├── loader.js               # Page preloader logic
│   └── logout.js               # Logout confirmation logic
│
├── images/                     # Static images (logos, placeholders, icons)
│
├── PHPMailer-6.10.0/           # PHPMailer library (bundled)
└── customModal_V2/             # Custom modal library (bundled)
```

---

## 📖 Usage Guide

### Marking Attendance

1. Navigate to **Mark Attendance** from the dashboard.
2. Enter the student's **Registration Number** in the search box (or scan their barcode).
3. The student's details will populate automatically.
4. Click **Mark** to record the attendance.

### Managing Students

1. Go to **Manage Students**.
2. Use the **eye icon** to view and edit a student's details in the side panel.
3. Use the **trash icon** to soft-delete a student.
4. To add students in bulk, use **Upload Students** and upload an `.xlsx` or `.csv` file.

> **Required columns for bulk upload:** `reg`, `name`, `contact`, `batch`, `email`

### Managing Batches

1. Go to **Manage Batches**.
2. Click **Add New Batch** in the side panel.
3. Set the batch name, toggle the class days, and set start/end times.
4. Use the **tick icon** to mark a batch as **Completed**.

### Generating Reports

- **Attendance Report:** Select a date and batch, click Search, and optionally export to Excel.
- **Absent Report:** Select a date and batch to see all students who did not attend; export to Excel.

---

## 📱 SMS & Email Notifications

### SMS (text.lk)

The system uses the [text.lk](https://text.lk) REST API to send SMS notifications to students and/or parents when attendance is marked.

Configure your API key in `sms.php`:

```php
$apiKey = "YOUR_API_KEY";
```

Call the function anywhere in the system:

```php
sendSMS("94XXXXXXXXX", "Your attendance has been recorded. - ESOFT Nittambuwa");
```

### Email (PHPMailer)

PHPMailer 6.10.0 is bundled in the `PHPMailer-6.10.0/` directory. It is used for:

- **Password reset** emails
- **Welcome emails** for new students

Configure your SMTP credentials in the relevant PHP files before use.

---

## 🔒 Security

- **Prepared statements** are used throughout to prevent SQL injection.
- **Session-based authentication** protects all pages; unauthenticated users are redirected to the login page.
- **`htmlspecialchars()`** is applied when rendering user-supplied data in HTML.
- **COLLATE utf8mb4_bin** is enforced on login queries for case-sensitive credential matching.
- User login events (including IP address) are recorded in the `log` table.

> ⚠️ **Important:** Before deploying to production, ensure you:
> - Change the default database credentials in `config.php`
> - Remove or rotate any API keys committed to the repository
> - Enable HTTPS on your web server
> - Store passwords as hashed values (e.g., using `password_hash()` / `password_verify()`)

---

## 🤝 Contributing

Contributions are welcome! To contribute:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m "Add your feature"`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Open a Pull Request

Please make sure your code follows the existing coding style and does not introduce new security vulnerabilities.

---

## 👤 Author

**Amalindu Ekanayaka**  
GitHub: [@eamalindu](https://github.com/eamalindu)

> Maintained for **ESOFT Nittambuwa**

---

<p align="center">
  Made with ❤️ by <a href="https://github.com/eamalindu">@eamalindu</a>
</p>
