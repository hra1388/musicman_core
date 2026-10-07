# Security Checklist (OWASP Top 10 & API Security Compliance)

## 1. Authentication & Session Management
- [x] Secure password hashing using `PASSWORD_DEFAULT` (Bcrypt/Argon2).
- [x] JWT/HMAC token signatures for authenticated API requests (`X-Api-Token`, `Authorization: Bearer`).
- [x] Secure HTTP-Only, SameSite, and Secure cookies for web browser sessions.
- [x] Rate limiting on authentication endpoints (`/auth/login`, `/auth/register`).

## 2. Input Validation & Data Hygiene
- [x] Parameterized SQL statements using PDO to prevent SQL Injection across all MySQL & SQLite queries.
- [x] Strict type casting and input normalization on entity IDs and query tokens.
- [x] HTML entity encoding (`htmlspecialchars`) for external strings used in sitemaps and response texts.

## 3. Network & Transport Security
- [x] TLS 1.3 requirement for HTTPS production deployments.
- [x] Strict CORS header restrictions and origin verification.
- [x] Protection against Brute Force attacks via exponential backoff and rate-limiting history tables.

## 4. Database & Secrets Management
- [x] Separation of concerns: Primary catalog in MySQL, dedicated SQLite file for local download queues.
- [x] Database connections configured with least privilege access.
- [x] Credentials moved from code to environment variables / config array mappings.
