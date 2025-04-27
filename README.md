**Dokumentasi Proyek Aplikasi Penilaian Siswa untuk SMA NEGERI 91 Jakarta Timur**

---

# 1. Deskripsi Umum
Aplikasi ini dikembangkan untuk memudahkan pengelolaan data siswa, guru, kelas, nilai, dan absensi di SMA NEGERI 91 Jakarta Timur. Terdapat dua jenis pengguna: **Admin** dan **Siswa**.

# 2. Teknologi yang Digunakan
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL

# 3. Struktur Database

## 3.1. Tabel MATPEL
| Field        | Tipe Data   | Keterangan           |
|--------------|-------------|----------------------|
| kd_matpel    | VARCHAR(10) | Primary Key          |
| nm_matpel    | VARCHAR(100)| Nama Mata Pelajaran  |

## 3.2. Tabel GURU
| Field           | Tipe Data   | Keterangan                   |
|-----------------|-------------|-------------------------------|
| nip             | VARCHAR(20) | Primary Key                  |
| nm_guru         | VARCHAR(100)| Nama Guru                    |
| tmp_lahir_guru  | VARCHAR(50) | Tempat Lahir Guru            |
| tgl_lahir_guru  | DATE        | Tanggal Lahir Guru           |
| kel_guru        | VARCHAR(20) | Jenis Kelamin Guru           |
| alamat          | TEXT        | Alamat Guru                  |
| telp            | VARCHAR(20) | Telepon Guru                 |
| kd_matpel       | VARCHAR(10) | Kode Mata Pelajaran (FK)     |
| nm_matpel       | VARCHAR(100)| Nama Mata Pelajaran          |

## 3.3. Tabel KELAS
| Field        | Tipe Data   | Keterangan                   |
|--------------|-------------|-------------------------------|
| kd_kelas     | VARCHAR(10) | Primary Key                  |
| nm_kelas     | VARCHAR(50) | Nama Kelas                   |
| jml_siswa    | INT         | Jumlah Siswa                 |
| thn_ajaran   | VARCHAR(10) | Tahun Ajaran                 |
| nip          | VARCHAR(20) | NIP Guru Wali Kelas (FK)      |
| nm_guru      | VARCHAR(100)| Nama Guru Wali Kelas         |

## 3.4. Tabel SISWA
| Field      | Tipe Data   | Keterangan                |
|------------|-------------|----------------------------|
| nis        | VARCHAR(20) | Primary Key               |
| nm_siswa   | VARCHAR(100)| Nama Siswa                |
| tmp_lahir  | VARCHAR(50) | Tempat Lahir Siswa        |
| tgl_lahir  | DATE        | Tanggal Lahir Siswa       |
| jkel       | VARCHAR(10) | Jenis Kelamin             |
| alamat     | TEXT        | Alamat Siswa              |
| telp       | VARCHAR(20) | Telepon Siswa             |
| nm_wali    | VARCHAR(100)| Nama Wali                 |
| kd_kelas   | VARCHAR(10) | Kode Kelas (FK)           |
| username   | VARCHAR(50) | Username Siswa            |
| password   | VARCHAR(50) | Password Siswa            |

## 3.5. Tabel NILAI
| Field             | Tipe Data   | Keterangan                   |
|-------------------|-------------|-------------------------------|
| kd_nilai          | VARCHAR(20) | Primary Key                  |
| nis               | VARCHAR(20) | NIS Siswa (FK)               |
| nm_siswa          | VARCHAR(100)| Nama Siswa                   |
| kd_matpel         | VARCHAR(10) | Kode Mata Pelajaran (FK)     |
| nm_matpel         | VARCHAR(100)| Nama Mata Pelajaran          |
| uts_sem_ganjil    | DECIMAL(5,2)| Nilai UTS Semester Ganjil    |
| uas_sem_ganjil    | DECIMAL(5,2)| Nilai UAS Semester Ganjil    |
| uts_sem_genap     | DECIMAL(5,2)| Nilai UTS Semester Genap     |
| uas_sem_genap     | DECIMAL(5,2)| Nilai UAS Semester Genap     |

## 3.6. Tabel ABSEN
| Field      | Tipe Data   | Keterangan                |
|------------|-------------|----------------------------|
| kd_absen   | VARCHAR(20) | Primary Key               |
| nm_bulan   | VARCHAR(20) | Nama Bulan                |
| nis        | VARCHAR(20) | NIS Siswa (FK)            |
| nm_siswa   | VARCHAR(100)| Nama Siswa                |
| jml_hadir  | INT         | Jumlah Hadir              |
| alfa       | INT         | Jumlah Alfa               |
| izin       | INT         | Jumlah Izin               |
| sakit      | INT         | Jumlah Sakit              |

## 3.7. Tabel ADMIN
| Field      | Tipe Data   | Keterangan                |
|------------|-------------|----------------------------|
| username   | VARCHAR(50) | Primary Key               |
| password   | VARCHAR(50) | Password                  |
| nama       | VARCHAR(100)| Nama Admin                |

# 4. Struktur Folder Project
```
/penilaian-siswa/
├── config/
│   └── database.php
├── views/
│   ├── siswa/
│   ├── guru/
│   ├── absen/
│   ├── kelas/
│   └── nilai/
├── index.php
├── login.php
└── logout.php
```

# 5. Fitur Aplikasi

## 5.1. Admin
- Login sebagai Admin
- Kelola data Guru (CRUD)
- Kelola data Siswa (CRUD)
- Kelola data Kelas (CRUD)
- Kelola data Nilai (CRUD)
- Kelola data Absensi (CRUD)
- Logout

## 5.2. Siswa
- Login sebagai Siswa
- Melihat data Absensi pribadi
- Melihat data Nilai pribadi
- Logout

# 6. Diagram Relasi Entitas (ERD)
(ERD terlampir dalam file gambar)

---

**Selesai.**

