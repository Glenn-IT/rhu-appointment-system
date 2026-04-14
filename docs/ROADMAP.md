# 🗺️ Development Roadmap

## RHU Rizal — Online Medical Appointment System

> **Current Stage:** ✅ Phase 1 Complete — Frontend Prototype  
> **Next Stage:** 🔄 Phase 2 — Backend Integration

---

## 📅 Release Timeline Overview

```
2026 Q1  ─────────── ✅ DONE ──────────── 2026 Q2  ──── IN PROGRESS ────  2026 Q3  ──────────────  2026 Q4
  │                                          │                                │                        │
  ▼                                          ▼                                ▼                        ▼
[v1.0 Prototype]               [v2.0 Backend MVP]               [v2.5 Enhanced]             [v3.0 Production]
Frontend-only                  PHP + MySQL core                  Emails, Reports             Full deployment
localStorage sim               Auth + CRUD APIs                  PDF exports                 Security audit
21 HTML pages                  Real database                     SMS notifs                  Live on domain
```

---

## ✅ Phase 1 — Frontend Prototype _(Completed — April 2026)_

**Goal:** Design and validate the full UI/UX before writing any backend code.

### Deliverables

- [x] Complete UI for all 21 pages (Patient + Admin)
- [x] Patient login & registration (3-step wizard)
- [x] Appointment booking with interactive calendar and time slots
- [x] Patient dashboard, my appointments, medical history, profile
- [x] Admin dashboard with Chart.js analytics (line, doughnut, bar charts)
- [x] Admin appointment management (approve/reject/complete/reschedule/cancel)
- [x] Admin doctor schedule management (CRUD)
- [x] Admin patient records browser
- [x] Admin user account management (activate/deactivate)
- [x] Admin calendar (full monthly view with day-click modal)
- [x] Admin reports page with filters + print functionality
- [x] Admin profile + change password
- [x] Responsive layout (mobile-friendly sidebar)
- [x] localStorage-based data simulation
- [x] Toast notifications & modal system
- [x] Status badges, charts, print CSS

**Tech:** HTML5, CSS3 (custom), Vanilla JS, FontAwesome, Chart.js, Google Fonts

---

## 🔄 Phase 2 — Backend MVP _(Target: June 2026)_

**Goal:** Connect the frontend to a real PHP + MySQL backend. Replace all localStorage operations with real API calls.

### Milestone 2.1 — Database & Auth _(~2 weeks)_

- [ ] Set up MySQL database with full schema
- [ ] Seed database with initial services, doctors, admin account
- [ ] Build patient registration API with bcrypt password hashing
- [ ] Build patient + admin login with PHP sessions
- [ ] Add server-side route protection (redirect non-authenticated users)
- [ ] CSRF token integration on all forms

### Milestone 2.2 — Patient APIs _(~2 weeks)_

- [ ] Fetch patient profile from DB
- [ ] Update profile + change password
- [ ] Check appointment availability (available time slots per date)
- [ ] Book appointment (with server-side validation)
- [ ] Fetch own appointments (all + by status)
- [ ] Cancel/reschedule appointment
- [ ] Fetch medical history

### Milestone 2.3 — Admin APIs _(~2 weeks)_

- [ ] Fetch all appointments (with JOIN: patient + doctor + service)
- [ ] Approve / reject / complete / cancel / reschedule appointments
- [ ] CRUD for doctors
- [ ] View patient records + appointment history
- [ ] Activate/deactivate user accounts
- [ ] Manage closed/holiday dates
- [ ] Basic reports aggregation queries

### Milestone 2.4 — Frontend Integration _(~1 week)_

- [ ] Replace all `DB.get*/save*` calls with `fetch()` AJAX calls to the backend
- [ ] Handle API response errors gracefully (show toast messages)
- [ ] Update all page redirects to use server-side session checks

**Deliverable:** A working web app running on `http://localhost/rhu-appointment-system` with a real database.

---

## 🟡 Phase 2.5 — Enhanced Features _(Target: August 2026)_

**Goal:** Add important quality-of-life features before public launch.

### Email Notifications

- [ ] Set up PHPMailer + SMTP (Gmail or SendGrid)
- [ ] Email on: registration, booking confirmation, approval, rejection, cancellation
- [ ] Admin email alert on new appointment booking
- [ ] Functional forgot password / password reset flow

### Reports & Exports

- [ ] PDF export for individual appointment records (DomPDF)
- [ ] Excel/CSV export for admin reports (PhpSpreadsheet)
- [ ] Printable patient medical history PDF

### UX Improvements

- [ ] Add pagination to all admin tables (50 records per page)
- [ ] Add date range picker for reports/calendar filters
- [ ] Add loading spinners/skeletons during API calls
- [ ] Add "Are you sure?" confirmation for all destructive actions (already UI-done, now with real delete)

### Security Hardening

- [ ] Rate limiting on login endpoint
- [ ] Input sanitization + XSS prevention
- [ ] SQL injection prevention (PDO prepared statements)
- [ ] HTTPS setup on staging server

---

## 🚀 Phase 3 — Production Launch _(Target: October 2026)_

**Goal:** Deploy the system to a live server accessible by RHU Rizal staff and patients.

### 3.1 Infrastructure

- [ ] Provision Linux VPS (Ubuntu 22.04) or cPanel hosting
- [ ] Install Apache/Nginx + PHP 8.2 + MySQL 8.0
- [ ] Register and configure domain name
- [ ] Install SSL certificate (Let's Encrypt via Certbot)
- [ ] Configure HTTPS redirect and CSP headers

### 3.2 Data Migration

- [ ] Export any test data collected during prototype phase
- [ ] Import real services, doctors, and initial admin credentials
- [ ] Remove all demo/sample data

### 3.3 Testing & QA

- [ ] Full functional testing of all 21 pages on production server
- [ ] Cross-browser testing (Chrome, Firefox, Edge, Safari)
- [ ] Mobile browser testing (Chrome Android, Safari iOS)
- [ ] Load testing (simulate 50 concurrent users)
- [ ] Security scan (OWASP ZAP or similar)

### 3.4 Training & Handover

- [ ] Create user manual for patients (PDF/printed guide)
- [ ] Create admin operations manual
- [ ] Conduct training session for RHU Rizal staff
- [ ] Set up IT support contact for post-launch issues

### 3.5 Post-Launch

- [ ] Monitor error logs for first 30 days
- [ ] Set up automated daily database backups
- [ ] Set up uptime monitoring (UptimeRobot)
- [ ] Collect feedback from patients and staff

---

## 🌟 Phase 4 — Future Enhancements _(2027 and beyond)_

These are features identified as valuable but not part of the initial release scope.

### 4.1 Mobile Application

- [ ] 🟢 Build a Progressive Web App (PWA) version for home screen install
- [ ] 🟢 Push notifications for appointment reminders (Web Push API)
- [ ] 🟢 React Native or Flutter mobile app (Android/iOS)

### 4.2 Advanced Features

- [ ] 🟢 SMS notifications via Semaphore Philippines API
- [ ] 🟢 Telemedicine / video consultation booking (link to Google Meet/Zoom)
- [ ] 🟢 Online queue system with live queue number display
- [ ] 🟢 Patient satisfaction survey after each appointment
- [ ] 🟢 Waiting list / cancellation slot alerts

### 4.3 Analytics & Intelligence

- [ ] 🟢 Advanced admin analytics dashboard (patient demographics, peak hours, no-show rates)
- [ ] 🟢 Appointment reminder auto-emails (24 hours before)
- [ ] 🟢 Export data to DOH (Department of Health) reporting formats
- [ ] 🟢 Integration with PhilHealth records (if API becomes available)

### 4.4 Multi-Site / Scaling

- [ ] 🟢 Support for multiple RHU branches under one system
- [ ] 🟢 Super-admin panel for managing multiple RHU locations
- [ ] 🟢 Multi-language support (Filipino / English toggle)

---

## 📊 Milestone Summary Table

| Version            | Target Date  | Key Feature                                | Status     |
| ------------------ | ------------ | ------------------------------------------ | ---------- |
| v1.0 — Prototype   | April 2026   | Complete frontend (21 pages, localStorage) | ✅ Done    |
| v2.0 — Backend MVP | June 2026    | PHP + MySQL, real auth, all APIs           | ⬜ Planned |
| v2.5 — Enhanced    | August 2026  | Emails, PDF exports, security              | ⬜ Planned |
| v3.0 — Production  | October 2026 | Live deployment, training, go-live         | ⬜ Planned |
| v4.0 — Future      | 2027+        | PWA, SMS, telemedicine, analytics          | 💡 Ideas   |

---

## 👥 Suggested Team Roles for Backend Phase

| Role                   | Responsibilities                                            |
| ---------------------- | ----------------------------------------------------------- |
| Backend Developer      | PHP APIs, database, authentication, security                |
| Frontend Developer     | Connect HTML pages to APIs, AJAX calls, error handling      |
| Database Administrator | Schema design, indexing, backups, query optimization        |
| QA Tester              | Functional testing, security testing, cross-browser testing |
| Project Manager        | Sprint planning, milestone tracking, stakeholder updates    |
| System Admin           | Server setup, SSL, deployment, monitoring                   |

---

## 📝 Notes

- The prototype is **fully functional as a UI demo** — it can be shown to stakeholders and used for user testing
- All frontend code is reusable — no need to rewrite HTML/CSS/JS for the backend phase
- Backend integration only requires replacing `localStorage` calls with `fetch()` API calls
- Estimated total backend development time: **6–8 weeks** for a 2-person dev team
