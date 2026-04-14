# ✅ Backend Implementation Checklist

## RHU Rizal — Online Medical Appointment System

> **Purpose:** This checklist guides the conversion of the frontend prototype into a fully functional backend-powered web application.  
> **Recommended Stack:** PHP (Laravel) + MySQL + XAMPP (local) → Apache/Nginx (production)  
> **Alternative Stack:** Node.js (Express) + MySQL/PostgreSQL + Sequelize ORM

---

## 📋 How to Use This Checklist

- Check off items `[x]` as they are completed
- Items marked 🔴 are **critical/blocking**
- Items marked 🟡 are **important but non-blocking**
- Items marked 🟢 are **nice-to-have / enhancements**

---

## 🗂️ PHASE 1 — Project Setup & Infrastructure

### 1.1 Development Environment

- [ ] 🔴 Install XAMPP (Apache + MySQL + PHP 8.x)
- [ ] 🔴 Create a MySQL database: `rhu_appointment_db`
- [ ] 🔴 Set up PHP or Node.js project in the root directory
- [ ] 🟡 Install Composer (if using Laravel) or npm (if using Node.js)
- [ ] 🟡 Initialize version control (Git) with `.gitignore` for sensitive files
- [ ] 🟡 Create `.env` file for environment variables (DB credentials, secret keys)
- [ ] 🟢 Set up a local domain alias (e.g., `rhu-rizal.test`) via XAMPP `httpd-vhosts.conf`

### 1.2 Database Setup

- [ ] 🔴 Design and create the following database tables (see schema below)
- [ ] 🔴 Set up foreign key constraints and indexes
- [ ] 🟡 Create a database seeder/migration for initial data (services, doctors, admin user)
- [ ] 🟡 Seed the database with the mock data from `data/mockData.js`

#### Database Schema

```sql
-- Users / Patients table
CREATE TABLE patients (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  patient_code VARCHAR(20) UNIQUE,         -- e.g. P-001
  full_name    VARCHAR(100) NOT NULL,
  username     VARCHAR(50) UNIQUE NOT NULL,
  password     VARCHAR(255) NOT NULL,       -- bcrypt hashed
  email        VARCHAR(100) UNIQUE,
  phone        VARCHAR(20),
  address      TEXT,
  date_of_birth DATE,
  sex          ENUM('Male','Female','Other'),
  status       ENUM('Active','Inactive') DEFAULT 'Active',
  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Admin Users table
CREATE TABLE admins (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  username   VARCHAR(50) UNIQUE NOT NULL,
  password   VARCHAR(255) NOT NULL,        -- bcrypt hashed
  full_name  VARCHAR(100),
  email      VARCHAR(100),
  phone      VARCHAR(20),
  role       VARCHAR(50) DEFAULT 'System Administrator',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Doctors table
CREATE TABLE doctors (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(100) NOT NULL,
  specialty   VARCHAR(100),
  schedule    VARCHAR(100),               -- e.g. "Mon-Wed-Fri"
  is_available TINYINT(1) DEFAULT 1,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Services table
CREATE TABLE services (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  description TEXT,
  is_active  TINYINT(1) DEFAULT 1
);

-- Appointments table
CREATE TABLE appointments (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  appt_code       VARCHAR(20) UNIQUE,          -- e.g. APT-001
  patient_id      INT NOT NULL,
  doctor_id       INT,
  service_id      INT,
  appt_date       DATE NOT NULL,
  appt_time       TIME NOT NULL,
  reason          TEXT,
  notes           TEXT,                        -- admin notes/diagnosis
  status          ENUM('Pending','Approved','Completed','Rejected','Cancelled') DEFAULT 'Pending',
  cancelled_by    ENUM('Patient','Admin') NULL,
  created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
  FOREIGN KEY (doctor_id)  REFERENCES doctors(id) ON DELETE SET NULL,
  FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

-- Closed/Holiday Dates
CREATE TABLE closed_dates (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  closed_date DATE UNIQUE NOT NULL,
  reason      VARCHAR(200),
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Notifications table (optional)
CREATE TABLE notifications (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  user_id     INT,
  user_type   ENUM('patient','admin'),
  message     TEXT,
  is_read     TINYINT(1) DEFAULT 0,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🔐 PHASE 2 — Authentication & Session Management

### 2.1 Patient Authentication

- [ ] 🔴 Create `POST /auth/login` endpoint — validates credentials, returns session token or sets cookie
- [ ] 🔴 Hash all passwords with `bcrypt` (never store plain text)
- [ ] 🔴 Create `POST /auth/logout` endpoint — destroy session/token
- [ ] 🔴 Create `POST /auth/register` endpoint — validates + inserts new patient
- [ ] 🟡 Add server-side form validation (required fields, email format, password strength, duplicate username/email)
- [ ] 🟡 Add CSRF token protection on all forms
- [ ] 🟡 Implement "Forgot Password" — generate reset token, send email (PHPMailer or SMTP)
- [ ] 🟡 Implement "Reset Password" — validate token expiry, update hashed password
- [ ] 🟢 Add "Remember Me" — long-lived cookie / persistent session

### 2.2 Admin Authentication

- [ ] 🔴 Create separate admin login endpoint `POST /admin/auth/login`
- [ ] 🔴 Add middleware/guard: only authenticated admins can access `/admin/*` routes
- [ ] 🟡 Add role-based access control (RBAC) if multiple admin roles are needed
- [ ] 🟡 Log all admin login attempts (with IP, timestamp)
- [ ] 🟢 Implement 2FA (TOTP or SMS OTP) for admin accounts

### 2.3 Session / Token Management

- [ ] 🔴 Use PHP `$_SESSION` or JWT tokens for stateless auth (API-based)
- [ ] 🟡 Set secure, httpOnly, sameSite cookies
- [ ] 🟡 Implement session timeout (auto-logout after inactivity)
- [ ] 🟢 Implement refresh tokens (for long sessions)

---

## 👤 PHASE 3 — Patient (User) Features

### 3.1 Registration & Profile

- [ ] 🔴 `POST /register` — create patient record in DB with hashed password
- [ ] 🔴 Validate: unique username, unique email, matching passwords, required fields
- [ ] 🔴 `GET /profile` — fetch logged-in patient data from DB
- [ ] 🔴 `PUT /profile` — update patient personal info in DB
- [ ] 🔴 `PUT /profile/password` — change password (validate current, hash new)
- [ ] 🟡 `PUT /profile/deactivate` — set patient status to 'Inactive', logout
- [ ] 🟢 `POST /profile/avatar` — handle profile picture upload (store in `/uploads/avatars/`)

### 3.2 Appointment Booking

- [ ] 🔴 `GET /appointments/availability?date=YYYY-MM-DD` — return available time slots for a date
- [ ] 🔴 `POST /appointments` — create new appointment, validate: date not closed, slot not taken, no duplicate pending
- [ ] 🔴 Validate that the selected date is not a Sunday or a `closed_dates` entry
- [ ] 🔴 Validate maximum appointments per time slot (configurable, e.g., 5 per slot)
- [ ] 🟡 Send confirmation email to patient on booking (PHPMailer/SMTP)
- [ ] 🟡 Send notification to admin on new booking
- [ ] 🟢 Add Google Calendar / iCal export for appointment

### 3.3 My Appointments

- [ ] 🔴 `GET /appointments?patient_id=X` — fetch all appointments for logged-in patient
- [ ] 🔴 `PUT /appointments/{id}` — reschedule appointment (only if status is Pending)
- [ ] 🔴 `PUT /appointments/{id}/cancel` — cancel appointment (only if Pending or Approved)
- [ ] 🟡 Add filter by status (Pending/Approved/Completed/Cancelled)
- [ ] 🟡 Add search by service/doctor/date

### 3.4 Medical History

- [ ] 🔴 `GET /appointments/history?patient_id=X` — fetch completed/cancelled/rejected appointments
- [ ] 🟡 Include doctor notes/diagnosis in the returned data
- [ ] 🟢 Generate PDF export of medical history (mPDF or DomPDF for PHP)

---

## 🔧 PHASE 4 — Admin Features

### 4.1 Appointment Management

- [ ] 🔴 `GET /admin/appointments` — fetch all appointments with patient/doctor/service details (JOIN queries)
- [ ] 🔴 `PUT /admin/appointments/{id}/approve` — set status to Approved, send email to patient
- [ ] 🔴 `PUT /admin/appointments/{id}/reject` — set status to Rejected, send email with reason
- [ ] 🔴 `PUT /admin/appointments/{id}/complete` — mark as Completed
- [ ] 🔴 `PUT /admin/appointments/{id}/cancel` — cancel from admin side
- [ ] 🔴 `PUT /admin/appointments/{id}/reschedule` — update date/time + notes
- [ ] 🟡 Add bulk approve/reject/complete functionality
- [ ] 🟡 Add filtering by date range, doctor, service, status

### 4.2 Doctor Management

- [ ] 🔴 `GET /admin/doctors` — fetch all doctors
- [ ] 🔴 `POST /admin/doctors` — add new doctor
- [ ] 🔴 `PUT /admin/doctors/{id}` — update doctor info
- [ ] 🔴 `DELETE /admin/doctors/{id}` — soft-delete doctor (set inactive)
- [ ] 🔴 `PUT /admin/doctors/{id}/toggle` — toggle availability on/off
- [ ] 🟡 Handle doctor-appointment conflict on delete (warn admin if doctor has upcoming appointments)

### 4.3 Patient / User Management

- [ ] 🔴 `GET /admin/patients` — fetch all patient records
- [ ] 🔴 `GET /admin/patients/{id}` — fetch single patient with full appointment history
- [ ] 🔴 `PUT /admin/patients/{id}/activate` — set status to Active
- [ ] 🔴 `PUT /admin/patients/{id}/deactivate` — set status to Inactive
- [ ] 🟡 `DELETE /admin/patients/{id}` — hard delete patient (with confirmation)
- [ ] 🟢 Export patient list to CSV/Excel

### 4.4 Calendar & Closed Dates

- [ ] 🔴 `GET /admin/calendar?month=YYYY-MM` — return appointments grouped by date
- [ ] 🔴 `POST /admin/closed-dates` — mark a date as closed (holiday)
- [ ] 🔴 `DELETE /admin/closed-dates/{date}` — remove a closed date
- [ ] 🟡 Sync closed dates to the patient-facing booking calendar

### 4.5 Reports

- [ ] 🔴 `GET /admin/reports` — aggregate query: total appointments by status, by service, by month
- [ ] 🟡 Add date range filtering for reports
- [ ] 🟡 Add server-side CSV/Excel export (PhpSpreadsheet)
- [ ] 🟢 Add PDF export for official reports (DomPDF)
- [ ] 🟢 Add scheduled email reports (weekly/monthly summary to admin)

### 4.6 Admin Profile

- [ ] 🔴 `PUT /admin/profile` — update admin name, email, phone
- [ ] 🔴 `PUT /admin/profile/password` — change admin password (validate current, hash new)
- [ ] 🟢 `PUT /admin/profile/2fa` — enable/disable 2FA

---

## 📧 PHASE 5 — Notifications & Emails

- [ ] 🟡 Set up PHPMailer or SendGrid/Mailgun API
- [ ] 🟡 Create email templates (HTML) for:
  - Appointment confirmation (patient)
  - Appointment approved (patient)
  - Appointment rejected with reason (patient)
  - Appointment cancelled (patient)
  - New appointment alert (admin)
  - Password reset link (patient)
- [ ] 🟢 Add SMS notifications via Semaphore (Philippines SMS API)
- [ ] 🟢 Add in-app notification bell with real-time updates (polling or WebSocket)

---

## 🛡️ PHASE 6 — Security & Validation

- [ ] 🔴 Sanitize all user inputs (prevent XSS)
- [ ] 🔴 Use prepared statements / ORM to prevent SQL injection
- [ ] 🔴 Add CSRF token to all state-changing forms
- [ ] 🔴 Rate limit login endpoint (max 5 attempts, then 15-min lockout)
- [ ] 🔴 Validate all file uploads (type, size, extension whitelist)
- [ ] 🟡 Add Content Security Policy (CSP) headers
- [ ] 🟡 Force HTTPS in production (`Strict-Transport-Security` header)
- [ ] 🟡 Add server-side session expiry
- [ ] 🟡 Log all sensitive actions (login, password change, appointment status changes) with IP + timestamp
- [ ] 🟢 Run OWASP Top 10 vulnerability checklist before deployment

---

## 🔌 PHASE 7 — API Design (Optional — if going SPA/API route)

If the frontend is converted to React/Vue.js or kept as vanilla JS consuming a REST API:

- [ ] 🔴 Define RESTful API endpoints with consistent response format:
  ```json
  {
    "success": true,
    "data": { ... },
    "message": "Appointment created successfully.",
    "errors": null
  }
  ```
- [ ] 🔴 Add API authentication via Bearer tokens (JWT)
- [ ] 🟡 Add API versioning: `/api/v1/...`
- [ ] 🟡 Document all endpoints using Swagger / Postman collection
- [ ] 🟡 Add CORS headers for cross-origin requests (if API is on a different domain)
- [ ] 🟢 Implement API rate limiting

---

## 🚀 PHASE 8 — Deployment

### 8.1 Hosting Preparation

- [ ] 🔴 Purchase domain name (e.g., `rhurjzal.gov.ph` or subdomain)
- [ ] 🔴 Set up Linux server (Ubuntu 22.04) with Apache/Nginx + PHP 8.x + MySQL
- [ ] 🔴 Install SSL certificate (Let's Encrypt — free via Certbot)
- [ ] 🔴 Configure `.htaccess` (Apache) or `nginx.conf` for URL rewriting
- [ ] 🔴 Move `.env` and sensitive files outside the web root
- [ ] 🟡 Set up daily MySQL database backup (cron job → dump to storage)
- [ ] 🟡 Configure PHP `error_log` (disable `display_errors` in production)

### 8.2 Go-Live Checklist

- [ ] 🔴 Test all forms with real data on staging server
- [ ] 🔴 Verify email sending works from production server
- [ ] 🔴 Check all relative paths work on production domain
- [ ] 🔴 Remove all `console.log` and debug statements
- [ ] 🔴 Remove demo credentials from UI
- [ ] 🟡 Run Lighthouse performance audit (aim for 80+ score)
- [ ] 🟡 Test on mobile browsers (Chrome Android, Safari iOS)
- [ ] 🟡 Test on slow/3G connection
- [ ] 🟢 Set up uptime monitoring (UptimeRobot — free tier)
- [ ] 🟢 Configure Google Analytics or Plausible for usage tracking

---

## 📊 Progress Tracker

| Phase                      | Status         | Notes    |
| -------------------------- | -------------- | -------- |
| Phase 1 — Setup & DB       | ⬜ Not Started |          |
| Phase 2 — Authentication   | ⬜ Not Started |          |
| Phase 3 — Patient Features | ⬜ Not Started |          |
| Phase 4 — Admin Features   | ⬜ Not Started |          |
| Phase 5 — Notifications    | ⬜ Not Started |          |
| Phase 6 — Security         | ⬜ Not Started |          |
| Phase 7 — API Design       | ⬜ Not Started | Optional |
| Phase 8 — Deployment       | ⬜ Not Started |          |

> Update status to: ⬜ Not Started → 🔄 In Progress → ✅ Completed
