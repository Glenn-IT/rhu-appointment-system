# 🏥 RHU Rizal — Online Medical Appointment System

> **Prototype Version 1.0** — Frontend only (HTML/CSS/JS + localStorage)  
> Rural Health Unit – Municipality of Rizal

---

## 🚀 Quick Start

1. **Clone or download** this repository into your XAMPP `htdocs` folder:
   ```
   C:\xampp\htdocs\rhu-appointment-system\
   ```
2. **Start XAMPP** — ensure Apache is running
3. **Open in browser:**
   - Patient Login: `http://localhost/rhu-appointment-system/`
   - Admin Login: `http://localhost/rhu-appointment-system/views/admin/login.html`

### Demo Credentials

| Role    | Username | Password     |
| ------- | -------- | ------------ |
| Patient | `juandc` | `patient123` |
| Admin   | `admin`  | `admin123`   |

---

## 📁 Project Structure

```
rhu-appointment-system/
├── index.html               # Patient login (entry point)
├── assets/css/style.css     # Global styles
├── assets/js/app.js         # Core JS utilities
├── data/mockData.js         # Mock data + localStorage DB
├── components/              # Sidebar component references
├── views/
│   ├── user/                # Patient pages (6 pages)
│   └── admin/               # Admin pages (9 pages)
└── docs/                    # 📚 Full documentation
```

---

## 📚 Documentation

All project documentation is in the [`/docs`](./docs/) folder:

| Document                                            | Description                                      |
| --------------------------------------------------- | ------------------------------------------------ |
| [PROJECT_OVERVIEW.md](./docs/PROJECT_OVERVIEW.md)   | Full feature list, tech stack, page descriptions |
| [BACKEND_CHECKLIST.md](./docs/BACKEND_CHECKLIST.md) | Step-by-step backend implementation checklist    |
| [ROADMAP.md](./docs/ROADMAP.md)                     | Development roadmap from prototype to production |

---

## 🛠️ Tech Stack

- **HTML5** + **CSS3** (custom, no framework) + **Vanilla JavaScript**
- **FontAwesome 6.5.0** — Icons
- **Chart.js** — Admin analytics charts
- **Google Fonts (Inter)** — Typography
- **localStorage** — Data persistence (prototype only)

---

## 📋 Pages

### Patient Side

| Page                               | Description         |
| ---------------------------------- | ------------------- |
| `index.html`                       | Login               |
| `views/user/signup.html`           | 3-step registration |
| `views/user/dashboard.html`        | Home + stats        |
| `views/user/book-appointment.html` | Book with calendar  |
| `views/user/my-appointments.html`  | Manage appointments |
| `views/user/medical-history.html`  | Past records        |
| `views/user/profile.html`          | Profile management  |

### Admin Side

| Page                            | Description             |
| ------------------------------- | ----------------------- |
| `views/admin/login.html`        | Admin login             |
| `views/admin/dashboard.html`    | Analytics overview      |
| `views/admin/appointments.html` | Manage all appointments |
| `views/admin/doctors.html`      | Doctor schedules        |
| `views/admin/calendar.html`     | Monthly calendar view   |
| `views/admin/patients.html`     | Patient records         |
| `views/admin/users.html`        | User account management |
| `views/admin/reports.html`      | Printable reports       |
| `views/admin/profile.html`      | Admin profile           |

---

## ⚠️ Prototype Limitations

- No backend — all data stored in browser `localStorage` only
- Passwords stored in plain text (prototype only — **never do this in production**)
- Data is browser/device specific and can be cleared
- Email/SMS features are UI-only (no actual messages sent)

See [`docs/BACKEND_CHECKLIST.md`](./docs/BACKEND_CHECKLIST.md) to implement a real backend.

---

## 📄 License

For academic / government prototype use — RHU Rizal, Municipality of Rizal.
