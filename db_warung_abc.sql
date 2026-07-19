-- Membuat Database
CREATE DATABASE db_warung_abc;
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE db_warung_abc;

-- ==========================================
-- Tabel User
-- ==========================================
CREATE TABLE tbl_user (
    id_user INT(11) NOT NULL AUTO_INCREMENT,
    nama_lengkap VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'kasir', 'gudang') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user),
    UNIQUE KEY username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================
-- Tabel Barang
-- ==========================================
CREATE TABLE tbl_barang (
    id_barang INT(11) NOT NULL AUTO_INCREMENT,
    kode_barang VARCHAR(20) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga_satuan DECIMAL(12,2) NOT NULL,
    stok INT(11) NOT NULL DEFAULT 0,
    tanggal_kadaluarsa DATE DEFAULT NULL,
    PRIMARY KEY (id_barang),
    UNIQUE KEY kode_barang (kode_barang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================
-- Tabel Pelanggan
-- ==========================================
CREATE TABLE tbl_pelanggan (
    id_pelanggan INT(11) NOT NULL AUTO_INCREMENT,
    nama_pelanggan VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) DEFAULT NULL,
    alamat VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id_pelanggan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================
-- Tabel Transaksi
-- ==========================================
CREATE TABLE tbl_transaksi (
    id_transaksi INT(11) NOT NULL AUTO_INCREMENT,
    no_transaksi VARCHAR(30) NOT NULL,
    tanggal DATETIME NOT NULL,
    id_kasir INT(11) NOT NULL,
    id_pelanggan INT(11) DEFAULT NULL,
    total_bayar DECIMAL(12,2) NOT NULL,
    PRIMARY KEY (id_transaksi),
    FOREIGN KEY (id_kasir) REFERENCES tbl_user(id_user),
    FOREIGN KEY (id_pelanggan) REFERENCES tbl_pelanggan(id_pelanggan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================
-- Tabel Detail Transaksi
-- ==========================================
CREATE TABLE tbl_detail_transaksi (
    id_detail INT(11) NOT NULL AUTO_INCREMENT,
    id_transaksi INT(11) NOT NULL,
    id_barang INT(11) NOT NULL,
    jumlah INT(11) NOT NULL,
    subtotal DECIMAL(12,2) NOT NULL,
    PRIMARY KEY (id_detail),
    FOREIGN KEY (id_transaksi) REFERENCES tbl_transaksi(id_transaksi),
    FOREIGN KEY (id_barang) REFERENCES tbl_barang(id_barang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================================
-- Tabel Log
-- ==========================================
CREATE TABLE tbl_log (
    id_log INT(11) NOT NULL AUTO_INCREMENT,
    id_user INT(11) NOT NULL,
    aktivitas VARCHAR(255) NOT NULL,
    waktu DATETIME NOT NULL,
    PRIMARY KEY (id_log),
    FOREIGN KEY (id_user) REFERENCES tbl_user(id_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;