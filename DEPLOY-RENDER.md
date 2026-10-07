# Render deployment guide — Social Media PHP

## Repository structure

The actual PHP application is in `social_media/`. A root-level `Dockerfile`
has been added so Render can deploy the repository without using `npm`.

## Render

Create a **Web Service** from this GitHub repository.

Use:
- Runtime: Docker
- Dockerfile: `./Dockerfile`
- Docker Context: `.`
- Build Command: leave empty
- Start Command: leave empty
- Health Check Path: `/`

Do NOT use `npm install`.

## MySQL

This application uses MySQL/MariaDB. Configure a MySQL-compatible database
separately and add these environment variables to the Render Web Service:

- `MYSQL_HOST`
- `MYSQL_PORT` (normally `3306`)
- `MYSQL_DATABASE`
- `MYSQL_USER`
- `MYSQL_PASSWORD`

Import `social_media/social_media_db.sql` into that database before logging in.

## Important

1. The SQL dump contains sample/demo data from the original project.
2. Change/remove demo accounts before production.
3. The original admin creation script uses a fixed password (`admin123`).
   Do not expose that script publicly in production; remove it after creating
   the admin or replace it with a protected admin setup.
4. Runtime uploads inside a container are not durable across redeploys.
   For production, move user uploads to persistent object storage or another
   durable volume/storage solution.
5. The code's old localhost links were changed to root-relative paths so they
   work on a Render domain.
