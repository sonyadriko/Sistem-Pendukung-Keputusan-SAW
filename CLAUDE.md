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

### Running the Application
- Requires XAMPP or similar PHP/MySQL server
- Access via: `http://localhost/Sistem-Pendukung-Keputusan-SAW/views/login.php`
- All views are in the `views/` directory

## Architecture

### Directory Structure
```
/
├── config/
│   └── database.php          # Database connection (mysqli)
├── views/
│   ├── index.php             # Dashboard (SAW method explanation)
│   ├── login.php             # Login page
│   ├── proses_login.php      # Authentication logic (included by login.php)
│   ├── logout.php            # Session destruction
│   ├── kriteria.php          # Manage criteria weights (admin only)
│   ├── edit_kriteria.php     # Edit criterion
│   ├── update_kriteria.php   # Update criterion handler
│   ├── anggota.php           # Manage member data (admin only)
│   ├── tambah_data.php       # Add new member
│   ├── edit_data.php         # Edit member
│   ├── delete_data.php       # Delete member
│   ├── cek_hitung.php        # Select members for calculation
│   ├── hasil.php             # Display all members with SAW calculation
│   ├── hasil1.php            # Display selected members with SAW calculation
│   ├── save_ranking.php      # Save calculation results to history
│   ├── history.php           # View past calculations
│   ├── detail_history.php    # View details of past calculation
│   └── partials/
│       ├── sidebar.php       # Navigation (role-based menu)
│       ├── topnavbar.php     # Top bar with user profile
│       └── footer.php        # Footer scripts
└── assets/                   # CSS, JS, images (Bootstrap-based admin template)
```

### Session & Authentication
- Session started in `proses_login.php` and `sidebar.php`
- `$_SESSION['role']` determines menu access: `admin` vs `Kepala Koperasi`
- Passwords stored as MD5 hash (not secure, but legacy)
- Logout: `views/logout.php` destroys session and redirects to login

### Role-Based Access
- **admin**: Full access - Dashboard, Kriteria, Anggota, Hitung, History
- **Kepala Koperasi**: Limited access - Dashboard, History only
- Sidebar in `views/partials/sidebar.php` controls menu visibility

## SAW Method Implementation

The Simple Additive Weighting algorithm is implemented in `hasil.php` and `hasil1.php`:

### Key Criteria (9 total)
1. **C1** - Tingkat Golongan ASN (civil service grade)
2. **C2** - Lamanya Jangka Waktu Pinjam (loan duration)
3. **C3** - Banyaknya realisasi pencairan (1 tahun)
4. **C4** - Besarnya jasa yang diterima
5. **C5** - Frekuensi jumlah pinjaman
6. **C6** - Banyaknya jumlah modal (1 tahun)
7. **C7** - Tanggal terdaftar sebagai anggota
8. **C8** - Intensitas transaksi simpanan wajib (1 tahun)
9. **C9** - Intensitas angsuran pinjaman

### Calculation Flow
1. **Normalization** (`normalize()` function): Converts raw values to 1-5 scale based on criteria-specific ranges
2. **Max Values**: Find maximum value for each criterion across selected members
3. **Normalized Matrix**: Divide each member's value by max value for that criterion
4. **Preference Value**: `V_i = Σ (W_j × R_ij)` where W = weight, R = normalized value
5. **Ranking**: Sort by preference value (descending)

### Important Validation
- **Total weight must equal 1**: Calculations blocked if `SUM(bobot) != 1`
- **Minimum 2 members**: `hasil1.php` requires selecting 2+ members

### Weight Management
- Criteria weights stored in `kriteria` table
- Sum must equal exactly 1.0 for calculations to proceed
- Admin can edit weights via `kriteria.php` → `edit_kriteria.php`

## Database Tables

| Table | Purpose |
|-------|---------|
| `users` | Authentication (id_user, nama, username, password, role) |
| `kriteria` | Criteria definitions (id_kriteria, nama_kriteria, bobot, jenis) |
| `anggota` | Member data with 9 criteria values |
| `hasil` | Calculation history (timestamp) |
| `detail_hasil` | Ranking results linked to hasil |

## Common Tasks

### Add a New Criterion
1. Add to `kriteria` table via SQL
2. Update `normalize()` function in `hasil.php` and `hasil1.php`
3. Add column to `anggota` table
4. Update calculation formulas (9 hard-coded criteria references)
5. Update forms and table displays

### Debug SAW Calculation
- Check `normalize()` function returns correct scale (1-5)
- Verify `SUM(bobot) = 1` in `kriteria` table
- In `hasil1.php`, check `$selected_ids` from URL parameter
- Use `var_dump()` on `$preferensi` array to see intermediate results

### Change Database Credentials
Edit `config/database.php`:
```php
$conn = mysqli_connect("localhost", "root", "", "koperasi-saw");
```
