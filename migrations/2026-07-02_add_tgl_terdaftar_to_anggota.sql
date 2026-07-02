-- Migration: add tgl_terdaftar column to anggota table
-- Context: edit_data.php was updated to read/write the member's registration
-- date (tgl_terdaftar), which tambah_data.php already supported. Run this
-- only against a koperasi-saw database whose `anggota` table predates that
-- column (the current koperasi-saw.sql schema dump already includes it).
--
-- Not executed automatically — apply manually via phpMyAdmin or:
--   mysql -u root koperasi-saw < migrations/2026-07-02_add_tgl_terdaftar_to_anggota.sql

ALTER TABLE `anggota`
    ADD COLUMN IF NOT EXISTS `tgl_terdaftar` DATE DEFAULT NULL AFTER `jumlah_modal`;
