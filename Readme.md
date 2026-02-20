# Clin-Sync Technical Interview
## Mini Dental CRM API

Build a small REST API for a multi-tenant dental CRM.

You may use either **CodeIgniter 4** or **Laravel** (CI4 is preferred, but either is fine).

---

### Getting Started

Both frameworks are pre-installed and pre-configured to connect to the database. Just pick one and start coding.

```bash
# Start everything (both frameworks + database)
docker-compose up --build

# Or start only the framework you want to use:
docker-compose up --build codeigniter db    # CodeIgniter 4
docker-compose up --build laravel db        # Laravel
```

| Framework     | URL                        | Code Directory |
|---------------|----------------------------|----------------|
| CodeIgniter 4 | http://localhost:8080       | `./CodeIgnitor/` |
| Laravel       | http://localhost:8081       | `./Laravel/`     |

### Database

The MySQL database is pre-configured and shared between both frameworks.

| Setting   | Value        |
|-----------|--------------|
| Host      | `db` (from within Docker) / `localhost` (from host) |
| Port      | `3306` (internal) / `3307` (from host)               |
| Database  | `dental_crm` |
| Username  | `dental`     |
| Password  | `dental`     |
| Root Pass | `root`       |

### Project Structure

```
├── CodeIgnitor/        # CodeIgniter 4 application
├── Laravel/            # Laravel application
├── Dockerfile          # Shared PHP 8.2 + Apache image
├── docker-compose.yml  # Docker services
└── Readme.md
```

### Notes

- Database connections are already configured in each framework's `.env` file
- Composer dependencies are pre-installed; if `vendor/` is missing, the container will auto-install them on startup
- Both containers use PHP 8.2 with Apache and include: `pdo_mysql`, `mysqli`, `intl`, `zip`, `bcmath`

