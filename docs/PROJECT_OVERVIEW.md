# 🏥 RHU Rizal — Online Medical Appointment System

## Project Overview & Documentation

> **System Name:** Online Medical Appointment System of RHU Rizal  
> **Version:** 1.0.0 — Prototype (Frontend Only)  
> **Date Completed:** April 14, 2026  
> **Type:** Static HTML/CSS/JS — No backend, no database  
> **Author:** RHU Rizal Development Team

---

## 📌 What This System Does

The RHU Rizal Appointment System allows patients of the **Rural Health Unit – Municipality of Rizal** to:

- Register and log in as patients
- Book medical appointments online
- Track and manage their appointment history
- View their medical records

Administrators can:

- Manage and approve/reject appointments
- Maintain doctor schedules and availability
- View patient records
- Generate summary reports
- Manage user accounts

---

## 🛠️ Technology Stack

| Layer        | Technology                                                                                     |
| ------------ | ---------------------------------------------------------------------------------------------- |
| Markup       | HTML5 (Vanilla, no templating engine)                                                          |
| Styling      | Custom CSS3 with CSS Variables (no Bootstrap/Tailwind)                                         |
| Scripting    | Vanilla JavaScript (ES6+)                                                                      |
| Icons        | [FontAwesome 6.5.0](https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css) |
| Charts       | [Chart.js CDN](https://cdn.jsdelivr.net/npm/chart.js)                                          |
| Fonts        | [Google Fonts – Inter](https://fonts.google.com/specimen/Inter)                                |
| Data Storage | Browser `localStorage` (simulated database)                                                    |
| Server       | None (pure static files — runs via XAMPP or any static host)                                   |

### 🎨 Design Tokens (CSS Variables)

```css
--primary: #1a6b3c /* Main green */ --primary-dark: #145530
  --primary-light: #e8f5e9 --secondary: #2ecc71 --accent: #27ae60
  --danger: #e74c3c --sidebar-width: 260px --header-height: 64px;
```

---

## 📁 Project Structure

```
rhu-appointment-system/
│
├── index.html                        # Patient login page (entry point)
├── README.md                         # Root readme
│
├── assets/
│   ├── css/
│   │   └── style.css                 # Global stylesheet (all pages)
│   └── js/
│       └── app.js                    # Core JS utilities (auth, toast, modal, calendar)
│
├── data/
│   └── mockData.js                   # Mock data + localStorage DB helper
│
├── components/
│   ├── user-sidebar.html             # User sidebar reference (not server-included)
│   └── admin-sidebar.html            # Admin sidebar reference (not server-included)
│
├── views/
│   ├── user/
│   │   ├── signup.html               # Patient registration (3-step wizard)
│   │   ├── dashboard.html            # Patient home screen
│   │   ├── book-appointment.html     # Appointment booking form + calendar
│   │   ├── my-appointments.html      # View/edit/cancel appointments
│   │   ├── medical-history.html      # Past records (completed appointments)
│   │   └── profile.html             # Patient profile + edit + deactivate
│   │
│   └── admin/
│       ├── login.html                # Admin login page
│       ├── dashboard.html            # Admin analytics overview
│       ├── appointments.html         # Manage all appointments
│       ├── calendar.html             # Visual monthly calendar
│       ├── doctors.html             # Doctor schedule management
│       ├── patients.html            # Patient record browser
│       ├── users.html               # User account management
│       ├── reports.html             # Printable summary reports
│       └── profile.html             # Admin profile + change password
│
└── docs/
    ├── README.md                     # Docs index (this folder)
    ├── PROJECT_OVERVIEW.md           # ← You are here
    ├── BACKEND_CHECKLIST.md          # Backend implementation checklist
    └── ROADMAP.md                    # Development roadmap
```

---

## 📄 Page-by-Page Feature Summary

### 🔐 Authentication Pages

#### `index.html` — Patient Login

- Username + password form with show/hide password toggle
- "Remember Me" checkbox (UI)
- Forgot Password modal (UI only — shows toast)
- Link to signup page
- Link to admin login
- Demo credentials display box
- Auto-redirects to dashboard if session exists

#### `views/admin/login.html` — Admin Login

- Separate admin login page with shield branding
- Validates against `adminUser` in mockData
- Redirects to admin dashboard on success

#### `views/user/signup.html` — Patient Registration

- **3-step wizard:**
  - Step 1: Personal Information (full name, date of birth, sex, address, phone)
  - Step 2: Account Setup (email, username, password, confirm password, terms)
  - Step 3: Success screen with confetti/check icon
- Saves new patient to `rhu_patients` in localStorage

---

### 👤 Patient (User) Pages

#### `views/user/dashboard.html`

- Personalized welcome banner with patient name
- 3 stat cards: Total / Pending / Completed appointments
- Quick action buttons: Book, View Appointments, Medical History, Profile
- Upcoming appointments list (next 5)
- Announcements/news panel
- Notifications modal

#### `views/user/book-appointment.html`

- Service dropdown (10 services)
- Doctor dropdown (filtered by availability)
- Date picker with `RHUCalendar` widget
- Time slot grid (shows available/taken slots)
- "Check Availability" button
- Reason/notes textarea
- Confirmation modal before final submission
- Saves appointment to `rhu_appointments` in localStorage

#### `views/user/my-appointments.html`

- Tab filters: All / Pending / Approved / Completed / Cancelled
- Search bar (by name, service, doctor)
- Data table with: ID, Service, Doctor, Date, Time, Status
- **Actions:**
  - 👁 View — full detail modal
  - ✏️ Edit — reschedule (only for Pending status)
  - ❌ Cancel — confirmation modal
- Status badges with color coding

#### `views/user/medical-history.html`

- 3 summary stat cards (total history, completed, cancelled)
- Searchable table of all past appointments (completed/cancelled/rejected)
- View detail modal with notes/diagnosis
- Print individual record button (`window.print()`)

#### `views/user/profile.html`

- Profile avatar (initial-based)
- Stats: total appointments, pending, completed
- Personal info display (name, email, phone, address, DOB, sex)
- **Edit Profile modal** — updates localStorage + session
- **Change Password** section (validates old password)
- **Deactivate Account** modal (confirmation, UI only)

---

### 🔧 Admin Pages

#### `views/admin/dashboard.html`

- Dark green welcome banner
- 4 stat cards: Total Appointments / Pending / Completed / Patient Count
- **3 Chart.js charts:**
  - Line chart — Monthly appointments trend (last 6 months)
  - Doughnut chart — Appointment status breakdown
  - Bar chart — Top 5 services by appointment count
- Recent appointments list (last 8)
- Notifications modal

#### `views/admin/appointments.html`

- Status filter tabs: All / Pending / Approved / Completed / Rejected / Cancelled
- Pending count badge on tab
- Search bar
- Data table with all appointment fields
- **Inline action buttons:** Approve / Reject / Complete / Reschedule / Cancel
- View detail modal with action buttons
- Reschedule modal (date + notes)

#### `views/admin/doctors.html`

- Doctor cards grid (top 6, showing availability status)
- Full doctor table below
- **Add Doctor modal** (name, specialty, schedule, days)
- **Edit Doctor modal** (pre-filled from selected row)
- Toggle availability on/off
- Delete doctor with confirmation

#### `views/admin/calendar.html`

- Full-page monthly calendar grid
- Large cells with appointment preview pills
- Color coding: green=available, orange=partially booked, red=fully booked, gray=closed/Sunday
- Prev/Next month navigation
- **Click-day modal** — lists all appointments for that date with status badges

#### `views/admin/patients.html`

- Searchable patient records table
- Stats: Total / Active / With Pending Appointment
- **View Patient modal** — full demographics + complete appointment history list

#### `views/admin/users.html`

- Summary stats: Total / Active / Inactive users
- Status filter dropdown + search bar
- User table with: ID, Name, Username, Email, Phone, Status, Registration Date
- **Activate / Deactivate** toggle buttons
- Updates localStorage on action

#### `views/admin/reports.html`

- Filter controls: By Month / By Status / By Service (live filtering)
- 4 summary stat cards (auto-recalculates on filter)
- Appointments summary table (sortable by date)
- **Bar chart** — Appointments by service
- **Pie chart** — Appointments by status
- **Print button** → `window.print()` (sidebar/topbar hidden in print CSS)

#### `views/admin/profile.html`

- Profile hero banner (green gradient, avatar, role badge)
- Info cards grid: username, full name, email, phone, role, status
- System overview stats: total appointments, pending, patients, completed
- Recent activity feed (last 5 appointment actions)
- Security settings display (password last changed, 2FA status)
- **Edit Profile modal** — updates admin profile in localStorage
- **Change Password modal** — validates current, checks match/length

---

## 🔑 Demo Credentials

### Patient Login

| Field    | Value                                      |
| -------- | ------------------------------------------ |
| URL      | `http://localhost/rhu-appointment-system/` |
| Username | `juandc`                                   |
| Password | `patient123`                               |

### Admin Login

| Field    | Value                                                            |
| -------- | ---------------------------------------------------------------- |
| URL      | `http://localhost/rhu-appointment-system/views/admin/login.html` |
| Username | `admin`                                                          |
| Password | `admin123`                                                       |

---

## 🗄️ Data Layer

All data is stored in browser `localStorage` under these keys:

| Key                 | Content                        |
| ------------------- | ------------------------------ |
| `rhu_patients`      | Array of patient objects       |
| `rhu_appointments`  | Array of appointment objects   |
| `rhu_doctors`       | Array of doctor objects        |
| `rhu_session`       | Current logged-in user session |
| `rhu_admin_profile` | Admin profile overrides        |

### `DB` Helper Object (from `data/mockData.js`)

```javascript
DB.getPatients(); // Returns patients array
DB.savePatients(arr); // Saves patients array
DB.getAppointments(); // Returns appointments array
DB.saveAppointments(arr); // Saves appointments array
DB.getDoctors(); // Returns doctors array
DB.saveDoctors(arr); // Saves doctors array
DB.getSession(); // Returns current session object
DB.setSession(obj); // Saves session
DB.clearSession(); // Removes session (logout)
DB.generateId(prefix); // Returns unique ID e.g. "APT-009"
```

---

## 🧩 Core JS Utilities (`assets/js/app.js`)

| Function                           | Description                                                |
| ---------------------------------- | ---------------------------------------------------------- |
| `checkAuth(role)`                  | Route guard — redirects if not authenticated or wrong role |
| `logout()`                         | Clears session, redirects to login                         |
| `showToast(msg, type, title)`      | Shows floating notification (success/error/warning/info)   |
| `openModal(id)` / `closeModal(id)` | Show/hide modal overlays                                   |
| `closeAllModals()`                 | Closes all open modals                                     |
| `initSidebar()`                    | Mobile hamburger toggle                                    |
| `RHUCalendar` class                | Interactive monthly calendar with availability coloring    |
| `populateServices(selectId)`       | Fills a `<select>` with services from mock data            |
| `populateDoctors(selectId)`        | Fills a `<select>` with available doctors                  |
| `formatDate(dateStr)`              | Formats `2026-04-14` → `April 14, 2026`                    |
| `formatTime(timeStr)`              | Formats `09:00` → `9:00 AM`                                |
| `statusBadge(status)`              | Returns colored HTML badge string for a status             |

---

## 🧪 Known Prototype Limitations

1. **No real authentication** — passwords stored in plain text in localStorage
2. **No email/SMS sending** — forgot password, reset link, OTP are UI-only
3. **No server-side validation** — all validation is client-side only
4. **Data is device/browser specific** — localStorage is not shared across devices
5. **No file uploads** — profile pictures are initial-based avatars
6. **Sidebar not server-included** — sidebar HTML is duplicated in each page file
7. **No pagination** — all records load at once (may be slow with large data)
8. **No real-time updates** — no WebSocket or polling
