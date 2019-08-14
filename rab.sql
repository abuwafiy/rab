-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2019 pada 11.15
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori_bahan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `satuan`, `harga`, `kategori_bahan`) VALUES
(1, 'Semen', 'Kg', 43000, 'Material');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_bahan`
--

CREATE TABLE `detail_bahan` (
  `id_detail_bahan` int(11) NOT NULL,
  `id_detail_rab` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `volume` double NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_bahan`
--

INSERT INTO `detail_bahan` (`id_detail_bahan`, `id_detail_rab`, `id_bahan`, `volume`, `satuan`, `harga`) VALUES
(1, 1, 1, 1, 'Kg', 43000),
(2, 2, 1, 2, 'Kg', 43000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_bahan_realisasi`
--

CREATE TABLE `detail_bahan_realisasi` (
  `id_detail_bahan_realisasi` int(11) NOT NULL,
  `id_detail_realisasi` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `volume` double NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_bahan_realisasi`
--

INSERT INTO `detail_bahan_realisasi` (`id_detail_bahan_realisasi`, `id_detail_realisasi`, `id_bahan`, `volume`, `satuan`, `harga`) VALUES
(1, 1, 1, 4, 'Kg', 43000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_group`
--

CREATE TABLE `detail_group` (
  `id_parent` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_group`
--

INSERT INTO `detail_group` (`id_parent`, `id_jabatan`) VALUES
(1, 1),
(1, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(63, 1),
(64, 1),
(66, 1),
(66, 2),
(66, 3),
(69, 1),
(69, 2),
(69, 3),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(71, 3),
(73, 1),
(74, 1),
(74, 2),
(75, 1),
(75, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_rab`
--

CREATE TABLE `detail_rab` (
  `id_detail_rab` int(11) NOT NULL,
  `id_rab` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `volume_rab` double NOT NULL,
  `satuan_rab` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_rab`
--

INSERT INTO `detail_rab` (`id_detail_rab`, `id_rab`, `id_kategori`, `kegiatan`, `volume_rab`, `satuan_rab`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(1, 1, 1, 'Pembersihan Lahan', 12, 'M2', '2019-08-05', '2019-08-10'),
(2, 1, 2, 'galian tanah', 10, 'M2', '2019-08-04', '2019-08-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_realisasi`
--

CREATE TABLE `detail_realisasi` (
  `id_detail_realisasi` int(11) NOT NULL,
  `id_detail_rab` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `volume_realisasi` double NOT NULL,
  `satuan_realisasi` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `persentase` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_realisasi`
--

INSERT INTO `detail_realisasi` (`id_detail_realisasi`, `id_detail_rab`, `id_kategori`, `kegiatan`, `volume_realisasi`, `satuan_realisasi`, `tanggal_mulai`, `tanggal_selesai`, `persentase`) VALUES
(1, 1, 1, 'Pembersihan Lahan', 15, 'M2', '2019-08-05', '2019-08-14', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `header`
--

CREATE TABLE `header` (
  `id_header` int(11) NOT NULL,
  `nama_header` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `header`
--

INSERT INTO `header` (`id_header`, `nama_header`) VALUES
(1, 'Navigasi'),
(2, 'Transaksi'),
(3, 'Laporan'),
(4, 'Konfigurasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `status_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `status_jabatan`) VALUES
(1, 'Direktur Keuangan', 'Aktif'),
(2, 'Manajer Perencanaan', 'Aktif'),
(3, 'Pengawas ', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(50) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `alamat_karyawan` varchar(100) NOT NULL,
  `no_hp` int(12) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`nik`, `id_jabatan`, `nama_karyawan`, `alamat_karyawan`, `no_hp`, `password`) VALUES
('1111', 1, 'Muhamad Irsajidin', 'manukan', 89631931, '1111'),
('2222', 2, 'Harits Yulianta', 'Gresik', 8122555, '2222'),
('3333', 3, 'Yayan', 'kediri', 812554975, '3333'),
('4444', 2, 'naufal', 'manukan kulon', 81239922, '4444');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'PEKERJAAN PERSIAPAN'),
(2, 'PEKERJAAN TANAH'),
(3, 'PEKERJAAN PONDASI'),
(4, 'PEKERJAAN DINDING'),
(5, 'PEKERJAAN PLESTERAN DINDING'),
(6, 'PEKERJAAN KAYU'),
(7, 'PEKERJAAN BETON'),
(8, 'PEKERJAAN PENUTUP ATAP'),
(9, 'PEKERJAAN PLAFON'),
(10, 'PEKERJAAN PENUTUP LANTAI DINDING'),
(11, 'PEKERJAAN KUNCI DAN KACA'),
(12, 'PEKERJAAN PENGECATAN'),
(13, 'PEKERJAAN INSTALASI LISTRIK'),
(14, 'PEKERJAAN SANITASI'),
(15, 'Tahap Akhir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_header` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_header`, `nama_menu`, `url`, `icon`) VALUES
(1, 1, 'Dashboard', '-1', 'fa fa-dashboard'),
(2, 2, 'Perencanaan Proyek', '-1', 'fa fa-tasks'),
(3, 4, 'Master', '-1', 'fa fa-table'),
(12, 2, 'Pelaksanaan Proyek', '-1', 'fa fa-table'),
(13, 3, 'Laporan Proyek', '-1', 'fa fa-table');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_parent`
--

CREATE TABLE `menu_parent` (
  `id_parent` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama_parent` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `id_parent_child` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu_parent`
--

INSERT INTO `menu_parent` (`id_parent`, `id_menu`, `nama_parent`, `url`, `id_parent_child`) VALUES
(1, 2, 'Rencana Anggaran Biaya', 'rab', 0),
(59, 3, 'Proyek', 'proyek', 0),
(60, 3, 'Satuan', 'satuan', 0),
(61, 3, 'Bahan', 'bahan', 0),
(62, 3, 'Kategori', 'kategori', 0),
(63, 3, 'Jabatan', 'jabatan', 0),
(64, 3, 'Karyawan', 'karyawan', 0),
(66, 12, 'Checklist Progress', 'realisasi', 0),
(69, 12, 'Pengajuan Tambah Bahan', 'pengajuan', 0),
(70, 13, 'Laporan Akhir Proyek', 'report/selisih', 0),
(71, 1, 'Dashboard', 'dashboard', 0),
(73, 12, 'Approval Pengajuan ', 'approval', 0),
(74, 13, 'Laporan Proyek Per Periode', 'periode/realisasi', 0),
(75, 13, 'Laporan Pengajuan Bahan', 'laporanbhn/laporan', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_tambah_bahan`
--

CREATE TABLE `pengajuan_tambah_bahan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `id_rab` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `keterangan_pengajuan` varchar(50) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `status_approval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan_tambah_bahan`
--

INSERT INTO `pengajuan_tambah_bahan` (`id_pengajuan`, `id_proyek`, `id_rab`, `id_kategori`, `keterangan_pengajuan`, `tanggal_pengajuan`, `status_approval`) VALUES
(1, 2, 1, 1, 'penambahan semen', '2019-08-04', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(11) NOT NULL,
  `nama_proyek` varchar(255) NOT NULL,
  `lokasi_proyek` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `nama_proyek`, `lokasi_proyek`, `status`) VALUES
(1, 'adwd', 'dwdwd', 'Aktif'),
(2, 'La DIva Green Hill', 'Gresik', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rab`
--

CREATE TABLE `rab` (
  `id_rab` int(11) NOT NULL,
  `id_proyek` int(11) NOT NULL,
  `nama_rab` varchar(50) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `luas_tanah` double NOT NULL,
  `luas_bangunan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rab`
--

INSERT INTO `rab` (`id_rab`, `id_proyek`, `nama_rab`, `lokasi`, `luas_tanah`, `luas_bangunan`) VALUES
(1, 2, 'Kavling Tipe B', 'Gresik', 12, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Kg'),
(2, 'Ltr'),
(6, 'Oh'),
(7, 'M2'),
(8, 'M3'),
(9, 'CM'),
(10, 'M');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indeks untuk tabel `detail_bahan`
--
ALTER TABLE `detail_bahan`
  ADD PRIMARY KEY (`id_detail_bahan`);

--
-- Indeks untuk tabel `detail_bahan_realisasi`
--
ALTER TABLE `detail_bahan_realisasi`
  ADD PRIMARY KEY (`id_detail_bahan_realisasi`);

--
-- Indeks untuk tabel `detail_group`
--
ALTER TABLE `detail_group`
  ADD PRIMARY KEY (`id_parent`,`id_jabatan`);

--
-- Indeks untuk tabel `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD PRIMARY KEY (`id_detail_rab`),
  ADD KEY `fk_rab_det` (`id_rab`),
  ADD KEY `fk_rab_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `detail_realisasi`
--
ALTER TABLE `detail_realisasi`
  ADD PRIMARY KEY (`id_detail_realisasi`);

--
-- Indeks untuk tabel `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id_header`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_header_fk` (`id_header`);

--
-- Indeks untuk tabel `menu_parent`
--
ALTER TABLE `menu_parent`
  ADD PRIMARY KEY (`id_parent`),
  ADD KEY `id_menu_fk` (`id_menu`);

--
-- Indeks untuk tabel `pengajuan_tambah_bahan`
--
ALTER TABLE `pengajuan_tambah_bahan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`);

--
-- Indeks untuk tabel `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`id_rab`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_rab`
--
ALTER TABLE `detail_rab`
  MODIFY `id_detail_rab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_realisasi`
--
ALTER TABLE `detail_realisasi`
  MODIFY `id_detail_realisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `menu_parent`
--
ALTER TABLE `menu_parent`
  MODIFY `id_parent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_tambah_bahan`
--
ALTER TABLE `pengajuan_tambah_bahan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id_proyek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rab`
--
ALTER TABLE `rab`
  MODIFY `id_rab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_rab`
--
ALTER TABLE `detail_rab`
  ADD CONSTRAINT `fk_rab_det` FOREIGN KEY (`id_rab`) REFERENCES `rab` (`id_rab`),
  ADD CONSTRAINT `fk_rab_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `id_header_fk` FOREIGN KEY (`id_header`) REFERENCES `header` (`id_header`);

--
-- Ketidakleluasaan untuk tabel `menu_parent`
--
ALTER TABLE `menu_parent`
  ADD CONSTRAINT `id_menu_fk` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
