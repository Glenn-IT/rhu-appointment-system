// ============================================================
// RHU Rizal Appointment System - Mock Data
// ============================================================

const RHU_DATA = {
  services: [
    { id: 1, name: "General Consultation" },
    { id: 2, name: "Prenatal Care" },
    { id: 3, name: "Pediatrics" },
    { id: 4, name: "Dental Services" },
    { id: 5, name: "Family Planning" },
    { id: 6, name: "Immunization" },
    { id: 7, name: "Laboratory Services" },
    { id: 8, name: "TB-DOTS Program" },
    { id: 9, name: "Nutrition Counseling" },
    { id: 10, name: "Eye Care" },
  ],

  doctors: [
    {
      id: 1,
      name: "Dr. Maria Santos",
      specialty: "General Medicine",
      schedule: "Mon-Wed-Fri",
      available: true,
    },
    {
      id: 2,
      name: "Dr. Jose Reyes",
      specialty: "Pediatrics",
      schedule: "Tue-Thu",
      available: true,
    },
    {
      id: 3,
      name: "Dr. Ana Dela Cruz",
      specialty: "OB-Gynecology",
      schedule: "Mon-Thu",
      available: true,
    },
    {
      id: 4,
      name: "Dr. Carlos Mendoza",
      specialty: "Dentistry",
      schedule: "Wed-Fri",
      available: true,
    },
    {
      id: 5,
      name: "Dr. Rosa Flores",
      specialty: "Internal Medicine",
      schedule: "Tue-Fri",
      available: false,
    },
    {
      id: 6,
      name: "Dr. Eduardo Bautista",
      specialty: "Ophthalmology",
      schedule: "Mon-Wed",
      available: true,
    },
  ],

  adminUser: {
    username: "admin",
    password: "admin123",
    name: "Admin User",
    email: "admin@rhurityzal.gov.ph",
    role: "System Administrator",
  },

  samplePatients: [
    {
      id: "P-001",
      fullName: "Juan dela Cruz",
      username: "juandc",
      password: "patient123",
      email: "juan@example.com",
      phone: "09171234567",
      address: "Brgy. Rizal, Rizal",
      birthdate: "1990-05-15",
      gender: "Male",
      bloodType: "O+",
      status: "Active",
      registeredDate: "2025-01-10",
    },
    {
      id: "P-002",
      fullName: "Maria Clara Santos",
      username: "mcsantos",
      password: "patient123",
      email: "maria@example.com",
      phone: "09187654321",
      address: "Brgy. Poblacion, Rizal",
      birthdate: "1985-09-22",
      gender: "Female",
      bloodType: "A+",
      status: "Active",
      registeredDate: "2025-02-14",
    },
    {
      id: "P-003",
      fullName: "Roberto Mangubat",
      username: "rmangubat",
      password: "patient123",
      email: "roberto@example.com",
      phone: "09201112233",
      address: "Brgy. San Jose, Rizal",
      birthdate: "1978-03-08",
      gender: "Male",
      bloodType: "B+",
      status: "Inactive",
      registeredDate: "2025-03-01",
    },
    {
      id: "P-004",
      fullName: "Liza Fernandez",
      username: "lfernandez",
      password: "patient123",
      email: "liza@example.com",
      phone: "09334455667",
      address: "Brgy. Kalinawan, Rizal",
      birthdate: "1995-11-30",
      gender: "Female",
      bloodType: "AB+",
      status: "Active",
      registeredDate: "2025-03-20",
    },
  ],

  sampleAppointments: [
    {
      id: "APT-001",
      patientId: "P-001",
      patientName: "Juan dela Cruz",
      service: "General Consultation",
      doctor: "Dr. Maria Santos",
      date: "2026-04-15",
      time: "09:00",
      reason: "Routine check-up and blood pressure monitoring",
      status: "Pending",
      createdAt: "2026-04-10",
    },
    {
      id: "APT-002",
      patientId: "P-002",
      patientName: "Maria Clara Santos",
      service: "Prenatal Care",
      doctor: "Dr. Ana Dela Cruz",
      date: "2026-04-16",
      time: "10:30",
      reason: "Monthly prenatal check-up, 6 months pregnant",
      status: "Approved",
      createdAt: "2026-04-11",
    },
    {
      id: "APT-003",
      patientId: "P-003",
      patientName: "Roberto Mangubat",
      service: "Dental Services",
      doctor: "Dr. Carlos Mendoza",
      date: "2026-04-14",
      time: "14:00",
      reason: "Tooth extraction",
      status: "Completed",
      createdAt: "2026-04-08",
    },
    {
      id: "APT-004",
      patientId: "P-004",
      patientName: "Liza Fernandez",
      service: "Family Planning",
      doctor: "Dr. Ana Dela Cruz",
      date: "2026-04-17",
      time: "11:00",
      reason: "Family planning consultation",
      status: "Pending",
      createdAt: "2026-04-12",
    },
    {
      id: "APT-005",
      patientId: "P-001",
      patientName: "Juan dela Cruz",
      service: "Laboratory Services",
      doctor: "Dr. Maria Santos",
      date: "2026-03-20",
      time: "08:00",
      reason: "Complete blood count and urinalysis",
      status: "Completed",
      createdAt: "2026-03-15",
    },
    {
      id: "APT-006",
      patientId: "P-002",
      patientName: "Maria Clara Santos",
      service: "Immunization",
      doctor: "Dr. Jose Reyes",
      date: "2026-04-18",
      time: "09:30",
      reason: "Child immunization schedule",
      status: "Approved",
      createdAt: "2026-04-13",
    },
    {
      id: "APT-007",
      patientId: "P-003",
      patientName: "Roberto Mangubat",
      service: "TB-DOTS Program",
      doctor: "Dr. Maria Santos",
      date: "2026-04-20",
      time: "08:30",
      reason: "TB medication refill and follow-up",
      status: "Pending",
      createdAt: "2026-04-13",
    },
    {
      id: "APT-008",
      patientId: "P-004",
      patientName: "Liza Fernandez",
      service: "Eye Care",
      doctor: "Dr. Eduardo Bautista",
      date: "2026-03-10",
      time: "13:00",
      reason: "Blurry vision and eye strain",
      status: "Completed",
      createdAt: "2026-03-05",
    },
  ],

  // Dates that are fully booked (for calendar simulation)
  bookedDates: [
    "2026-04-16",
    "2026-04-17",
    "2026-04-22",
    "2026-04-23",
    "2026-04-28",
  ],

  // Closed dates (holidays/weekends handled by JS)
  closedDates: [
    "2026-04-09", // Araw ng Kagitingan
    "2026-04-01", // Good Friday (simulated)
  ],
};

// ============================================================
// localStorage Initialization
// ============================================================
function initMockData() {
  if (!localStorage.getItem("rhu_patients")) {
    localStorage.setItem(
      "rhu_patients",
      JSON.stringify(RHU_DATA.samplePatients),
    );
  }
  if (!localStorage.getItem("rhu_appointments")) {
    localStorage.setItem(
      "rhu_appointments",
      JSON.stringify(RHU_DATA.sampleAppointments),
    );
  }
  if (!localStorage.getItem("rhu_doctors")) {
    localStorage.setItem("rhu_doctors", JSON.stringify(RHU_DATA.doctors));
  }
  if (!localStorage.getItem("rhu_booked_dates")) {
    localStorage.setItem(
      "rhu_booked_dates",
      JSON.stringify(RHU_DATA.bookedDates),
    );
  }
}

// ============================================================
// Data Helper Functions
// ============================================================
const DB = {
  // Patients
  getPatients: () => JSON.parse(localStorage.getItem("rhu_patients") || "[]"),
  savePatients: (data) =>
    localStorage.setItem("rhu_patients", JSON.stringify(data)),

  // Appointments
  getAppointments: () =>
    JSON.parse(localStorage.getItem("rhu_appointments") || "[]"),
  saveAppointments: (data) =>
    localStorage.setItem("rhu_appointments", JSON.stringify(data)),

  // Doctors
  getDoctors: () => JSON.parse(localStorage.getItem("rhu_doctors") || "[]"),
  saveDoctors: (data) =>
    localStorage.setItem("rhu_doctors", JSON.stringify(data)),

  // Booked Dates
  getBookedDates: () =>
    JSON.parse(localStorage.getItem("rhu_booked_dates") || "[]"),

  // Session
  getSession: () => JSON.parse(localStorage.getItem("rhu_session") || "null"),
  setSession: (user) =>
    localStorage.setItem("rhu_session", JSON.stringify(user)),
  clearSession: () => localStorage.removeItem("rhu_session"),

  // Generate ID
  generateId: (prefix) => {
    const items = JSON.parse(
      localStorage.getItem(
        `rhu_${prefix === "APT" ? "appointments" : "patients"}`,
      ) || "[]",
    );
    const num = items.length + 1;
    return `${prefix}-${String(num).padStart(3, "0")}`;
  },
};

// Initialize on load
initMockData();
