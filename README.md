# 🌌 Terra-Space OS

**Terra-Space OS** is a web-based Space Mission Feasibility Analyzer built with **PHP**, **MySQL**, and **D3.js**. The application calculates mission readiness scores based on cloud coverage and solar activity parameters, overlaying the results on a live rotating celestial map calibrated to a Dhaka-centric geoposition.

---

## ✨ Features

* 🔐 **Authentication Framework:** Secure terminal-style register and login handlers using password encryption.
* 🌍 **Live Celestial Map:** Real-time rotating star map powered by **D3-Celestial** using an orthographic projection centered on Dhaka coordinates.
* 📡 **Mission Analyzer:** Computes instant readiness scores dynamically based on user-controlled environment sliders.
* 💾 **Data Persistence:** Asynchronously transmits and logs all simulation outputs to a MySQL database using AJAX.
* 📊 **Historical Log Matrix:** A dedicated portal to view past mission metrics and color-coded status alerts.

---

## 🗂️ Project Architecture

```text
terra-space-os/
├── db.php           # Database connection & global session initialization
├── auth.php         # Authentication controller (Handles both Register & Login POST logic)
├── login.php        # Login form UI
├── register.php     # Registration form UI
├── logout.php       # Session termination controller
├── dashboard.php    # Main Control Panel — hosts interactive sliders & D3 star map
├── save.php         # AJAX endpoint — processes and inserts simulation data to DB
└── logs.php         # Historical logs table view
