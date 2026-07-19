# Gated Community Guest Free Movement Monitoring System

A secure, multi-tier software system designed to track, validate, and manage guest access points and internal movement logs within a gated residential perimeter. This project implements strict relational data integrity, clean object-oriented architecture, and robust input sanitization to ensure perimeter security and real-time activity auditing.

## 🚀 Key Features

*   **Token-Based Access Control:** Generates secure, unique access tokens for registered guests to validate checkpoints seamlessly without exposing sensitive personal identification numbers.
*   **State-Driven Status Tracking:** Implements a strict finite state lifecycle for guests (`Expected` ➔ `Inside` ➔ `CheckedOut` / `Overstayed`) to manage community occupancy accurately.
*   **Audit Logging & Checkpoints:** Captures atomic, multi-checkpoint timestamps (`Main Gate`, `Block Perimeter`, `Exit Lane`) mapping back to individual host relational keys.
*   **SQL Injection Mitigation:** Utilizes Prepared Statements and Parameterized Queries via a strict database driver layout (`PDO`) to enforce system safety.

---

## 📐 System Architecture & File Layout

The codebase relies on an organized, decoupled layout separating database layers from business validation workflows:

```text
├── config/
│   └── database.php          # Secure relational database connector
├── src/
│   ├── Models/
│   │   ├── Guest.php         # Guest model schemas & validation layers
│   │   └── MovementLog.php   # Time-series checkpoint event handlers
│   ├── Controllers/
│   │   └── SecurityController.php # Core application API and route router
│   └── Services/
│       └── AccessControlService.php # Business logic rulesets for token verifications
├── database/
│   └── schema.sql            # Normalized relational MySQL relational layouts
└── README.md                 # System documentation
