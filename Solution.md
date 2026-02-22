# Dental CRM API - Solution

## Approach

Built using CodeIgniter 4 with a token-based authentication system and multi-tenant data isolation.

## Setup
```bash
docker-compose up --build codeigniter db

docker-compose exec codeigniter php spark migrate

docker-compose exec codeigniter php spark db:seed DatabaseSeeder
```

## Test Accounts

| Practice | Email | Password |
|----------|-------|----------|
| Dans Dental | daniel@dansdental.com | password123 |
| Tays Teeth | tay@taysteeth.com | password123 |

## Endpoints

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| POST | /api/login | No | Authenticate and receive token |
| GET | /api/patients | Yes | List patients for your practice |
| POST | /api/patients | Yes | Create a new patient |
| GET | /api/appointments | Yes | List appointments for your practice |
| POST | /api/appointments | Yes | Create a new appointment |

## Authentication
```
Authorization: Bearer <token>
```

Tokens expire after 8 hours.

## Postman

Import the collection and environment from `/postman` to test all endpoints with pre-configured auth. The login request automatically saves the token to the environment.

## Security Decisions

**Tenant isolation** — every query is scoped to the authenticated user's practice_id, derived from the token server-side. The client cannot influence which practice they belong to.

**Token hashing** — tokens are stored as SHA256 hashes in the database. The raw token is returned once on login and never stored server-side. A database breach does not expose valid tokens.

**Token expiry** — tokens expire after 8 hours. The expires_at column is non-nullable — a token cannot be issued without an expiry.

**Token revocation** — tokens have a revoked_at column allowing instant revocation on logout or forced sign-out.

**404 not 403** — requests for resources belonging to another practice return 404, not 403, to avoid confirming that a resource exists.

**Vague auth errors** — login always returns the same generic message regardless of whether the email or password was wrong, preventing email enumeration.

**Password hashing** — bcrypt via PHP's password_hash().

## GDPR Notes

- PII fields (email, phone, date of birth) are stored in plaintext for this exercise. In production these would be encrypted at rest using AES-256 application-level encryption
- Token hashing ensures a database breach does not expose valid session tokens
- Short token expiry limits exposure if a token is leaked
- In production, tokens should be stored in HttpOnly Secure cookies (web) or flutter_secure_storage backed by iOS Keychain / Android Keystore (mobile)