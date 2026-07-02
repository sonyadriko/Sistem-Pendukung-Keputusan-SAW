# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **Sistem Pendukung Keputusan (SPK)** - Decision Support System for a Koperasi (cooperative) using the **SAW (Simple Additive Weighting)** method. The system evaluates cooperative members based on 9 criteria to determine rankings for loan/financial decisions.

## Development Setup

### Database
- Uses MySQL/MariaDB database named `koperasi-saw`
- Connection config: `config/database.php`
- Default XAMPP credentials: `localhost`, `root`, empty password
- Import schema: `koperasi-saw.sql`
- Incremental schema changes live in `migrations/*.sql` — apply manually (not auto-run) against an existing database, e.g. `mysql -u root koperasi-saw < migrations/<file>.sql`

### Running the Application
- Requires XAMPP or similar PHP/MySQL server
- `.htaccess` sets `DirectoryIndex views index.php`, so the root URL auto-redirects into `views/`
- Login entry point: `http://localhost/Sistem-Pendukung-Keputusan-SAW/views/login.php`

### CSS / SASS
- Source styles are in `assets/sass/` (SCSS files with a BEM-like structure)
- Compiled output is `assets/css/main.css` — edit the SCSS source and recompile; do not hand-edit the compiled CSS
- Some CSS/JS dependencies (DataTables, Font Awesome) are loaded from CDN; others are bundled locally in `assets/`

## Architecture

### Request Flow
Every page follows the same pattern:
1. `include '../config/database.php'` — opens `$conn` (mysqli)
2. `include 'partials/sidebar.php'` — starts the session and renders the nav
3. Business logic / SQL queries inline in the view file
4. `include 'partials/footer.php'` — closes HTML and loads JS

There is no router, controller layer, or templating engine — each `.php` file in `views/` is a self-contained page. Incremental schema changes live in `migrations/*.sql` and are applied manually, not auto-run.

### Session & Authentication
- `session_start()` is called inside `views/partials/sidebar.php` (not in each page)
- `$_SESSION['role']` controls menu visibility: `admin` vs `Kepala Koperasi`
- **Auth guards are commented out** in several files (`cek_hitung.php`, `sidebar.php`) — pages are accessible without login in the current state
- Passwords stored as MD5 hash (legacy, not salted)
- Logout: `views/logout.php` destroys session and redirects to login

### Role-Based Access
- **admin**: Dashboard, Kriteria, Anggota, Hitung, History
- **Kepala Koperasi**: Dashboard, History only
- Access is enforced only via sidebar menu visibility — there is no server-side route guard on individual pages

## SAW Calculation Pipeline

The calculation runs across three files in sequence:

1. **`cek_hitung.php`** — member selection table with checkboxes; on POST, redirects to `hasil1.php?id_anggota=1,2,3`
2. **`hasil1.php`** — receives `$_GET['id_anggota']` as a raw comma-separated string, runs the SAW algorithm, and renders the ranked results table
3. **`save_ranking.php`** — called via POST from the results page; inserts one row into `hasil` then inserts ranked members into `detail_hasil`

`hasil.php` (no suffix) runs the same SAW algorithm over **all** members rather than a selection.

### SAW Algorithm (in `hasil.php` / `hasil1.php`)
1. **`normalize($value, $criteria)`**: Maps raw values to a 1–5 scale using criteria-specific ranges
2. **Max per criterion**: Find the highest normalized value across all selected members
3. **Normalized matrix**: `R_ij = normalized_value / max_for_criterion`
4. **Preference value**: `V_i = Σ (W_j × R_ij)` where W = bobot from `kriteria` table
5. **Ranking**: Sort descending by `V_i`

### Key Criteria (9 total, hard-coded in `normalize()`)
| Code | Name | Notes |
|------|------|-------|
| C1 | Tingkat Golongan ASN | Enum: HONORER/Gol.I–IV → 1–5 |
| C2 | Lamanya Jangka Waktu Pinjam | ≤32/≤64/≤96 months → 1–3 |
| C3 | Banyaknya realisasi pencairan | Currency ranges → 1–5 |
| C4 | Besarnya jasa yang diterima | Currency ranges → 1–5 |
| C5 | Frekuensi jumlah pinjaman | Count 1–6+ → 1–5 |
| C6 | Banyaknya jumlah modal | Only returns 2 or 4 (incomplete) |
| C7 | Tanggal terdaftar sebagai anggota | Date ranges 2014–2028 → 1–5 |
| C8 | Intensitas transaksi simpanan wajib | `decimal(10,6)` — input pakai titik: `0.005782`. Only two ranges covered in normalize() |
| C9 | Intensitas angsuran pinjaman | Currency ranges → 1–3 |

### Important Validations
- **Total weight must equal 1.0**: `SUM(bobot)` is checked with `round(..., 2)`; calculations are blocked if it doesn't match
- **Minimum 2 members required** for `hasil1.php`

## Database Tables

| Table | Purpose |
|-------|---------|
| `users` | Authentication (id_user, nama, username, password MD5, role) |
| `kriteria` | Criteria definitions (id_kriteria, nama_kriteria, bobot, jenis) |
| `anggota` | Member data with 9 criteria value columns |
| `hasil` | Calculation history (auto-timestamp, no explicit columns) |
| `detail_hasil` | Ranked results: id_hasil, nama, nilai_akhir, ranking |

## Known Issues / Gotchas

- **`var_dump($selected_ids)` at `hasil1.php:76`** is left in — it outputs debug noise on the results page
- **Auth guards are commented out** across multiple files; the site is effectively open without login enforcement
- **SQL injection risk**: `$selected_ids` from `$_GET['id_anggota']` is interpolated directly into queries in `hasil1.php`; `save_ranking.php` also uses unescaped `$_POST` values in INSERT statements
- **`normalize()` incomplete cases**: C6 only returns 2 or 4, C8 only covers two sub-ranges, C9 only maps to 1–3. Values outside defined ranges return `0`, which silently skews rankings
- **`$conn` is a global** opened in `database.php` and used by name across all files — there is no connection-passing mechanism

## Common Tasks

### Debug SAW Calculation
- Check `normalize()` returns correct scale (1–5) for the criterion in question
- Verify `SELECT SUM(bobot) FROM kriteria` equals 1.0
- In `hasil1.php`, `$selected_ids` comes from `$_GET['id_anggota']` — confirm it's populated
- Temporarily `var_dump($preferensi)` after the preference calculation loop

### Add a New Criterion
1. Add column to `anggota` table and a row to `kriteria` (write a `migrations/*.sql` file rather than editing `koperasi-saw.sql` in place, so existing databases can be updated incrementally)
2. Add a `case` to `normalize()` in both `hasil.php` and `hasil1.php`
3. Update the preference calculation loops (currently loop over 9 hard-coded criteria)
4. Update member add/edit forms (`tambah_data.php`, `edit_data.php`) and display tables

### Change Database Credentials
Edit `config/database.php`:
```php
$conn = mysqli_connect("localhost", "root", "", "koperasi-saw");
```
