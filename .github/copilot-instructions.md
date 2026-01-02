<!-- Short guide for AI coding agents working on this CodeIgniter4 app -->
# Copilot instructions — tubes-pemweb

Summary
- Framework: CodeIgniter 4 (see `composer.json`). App is a typical CI4 appstarter with app/ (application code), public/ (web root) and vendor/.
- Entrypoint: web requests arrive at `public/index.php` and routing is defined in `app/Config/Routes.php`.

Quick commands
- Run development server (from project root): `php spark serve` or `php -S localhost:8080 -t public`.
- Install/update deps: `composer install` / `composer update`.
- Run tests: `composer test` (runs `phpunit`).
- Use `.env` (copy `env` → `.env`) to set `app.baseURL`, DB credentials and `CI_ENVIRONMENT=development` for debugging.

Architecture & big picture
- MVC CodeIgniter4 app: Controllers in `app/Controllers`, Models in `app/Models`, Views in `app/Views`.
- Controllers extend `app/Controllers/BaseController.php` which loads common services — inspect it for global helpers and services.
- Routing groups: the app uses grouped routes (see `app/Config/Routes.php`) such as the `table` and `master` groups that map REST-like URIs to controller methods.
- Database: models use CodeIgniter Model patterns; database artifacts include `database.sql` and `tubes-web.sql` at project root.

Project-specific conventions (examples)
- Controller method names and routes:
  - index/listing: `index()` — e.g. routes like `table/rencana-pembelajaran` → `RencanaPembelajaran::index` ([app/Config/Routes.php](app/Config/Routes.php#L1-L40)).
  - create/edit/delete flows use `create()`, `edit($id)`, `delete($id)` and sometimes `store`/`update` (see `SubCpmk` routes).
- Views follow a layout system under `app/Views/layout/admin` — controllers render view fragments into that layout.
- Authentication gating uses `app/Filters/UsersAuthFilter.php` — check routes or controllers for filter usage.
- Models use names like `XxxModel.php` in `app/Models` and are typically injected/instantiated inside controllers (see `SubCpmkModel.php`).

Integration points & external deps
- Vendor: `codeigniter4/framework` (via Composer). See `composer.json` for runtime and dev deps.
- CLI: `spark` (root) — used for migrations, controllers generation, and running the dev server.
- Debugging: enable `CI_ENVIRONMENT=development` in `.env` to see debugbar and detailed errors; logs are under `writable/logs`.

Developer workflows to be aware of
- Webserver must point to `public/` (not project root). For local dev with XAMPP, set virtual host document root to `public`.
- DB setup: import `database.sql` / `tubes-web.sql` or run migrations if migrations are provided in `app/Database/Migrations`.
- Migrations: use `php spark migrate` / `php spark make:migration` if you add migrations (see `app/Config/Migrations.php`).
- Tests: `composer test` runs PHPUnit; test support is under `tests/_support`.

Where to look first (key files)
- Routing and surface area: [app/Config/Routes.php](app/Config/Routes.php)
- Shared controller boot: [app/Controllers/BaseController.php](app/Controllers/BaseController.php)
- Auth filter: [app/Filters/UsersAuthFilter.php](app/Filters/UsersAuthFilter.php)
- Models directory: [app/Models](app/Models)
- Views and layout: [app/Views/layout/admin/layout.php](app/Views/layout/admin/layout.php) and related view folders

How to make small changes safely
- Match controller method signatures used by routes before renaming.
- If adding DB fields, prefer a migration file under `app/Database/Migrations` and document the SQL in migration up()/down().
- Keep `public/index.php` as the webroot entrypoint; do not move logic outside `app/`.

Examples (explicit references)
- To add a new table CRUD: add routes in `app/Config/Routes.php` (follow `subcpmk` or `cpmk` patterns), create `app/Controllers/MyTable.php`, `app/Models/MyTableModel.php` and views under `app/Views/mytable/`.

If something is ambiguous
- Ask for runtime context: whether developer uses XAMPP virtual host or `php spark serve`, and their `.env` DB settings.

Feedback request
- Is any area missing or should I expand examples for migrations, seeders, or CI4 `Services` usage?
