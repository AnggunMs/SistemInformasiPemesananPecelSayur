-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 08:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pecel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_lengkap` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(101, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `id_perum` int(12) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longtitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nama_perum`
--

CREATE TABLE `nama_perum` (
  `id_perum` int(11) NOT NULL,
  `nama_perum` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nama_perum`
--

INSERT INTO `nama_perum` (`id_perum`, `nama_perum`) VALUES
(1, 'Taman Palma'),
(2, 'Taman Puspita'),
(3, 'Taman Puspa'),
(4, 'Karebean'),
(5, 'Gardenia'),
(6, 'Graha Indira'),
(7, 'Graha Pesona'),
(8, 'Graha Lestari');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(25) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email_pelanggan` varchar(25) DEFAULT NULL,
  `password_pelanggan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `telepon`, `email_pelanggan`, `password_pelanggan`) VALUES
(4, 'Shahdat Maulani', '082260917355', 'shahdat1997@gmail.com', 'tidakada'),
(5, 'Doni', '081281880514', 'doni@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `bank` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_ongkir` int(11) DEFAULT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `total_pembelian` int(11) DEFAULT NULL,
  `nama_kurir` varchar(25) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `tarif` int(11) NOT NULL,
  `status_pembelian` varchar(25) NOT NULL DEFAULT 'Pending',
  `resi_pengiriman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stock` int(5) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(5) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kategori`, `nama_produk`, `stock`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`) VALUES
(110, 'makanan', 'Sate Bandeng', 15, 30000, 700, 'Sate Bandeng.jpg', 'Sate Bandeng adalah masakan tradisional khas Banten, Indonesia. Sate Bandeng dibuat dari ikan bandeng (Chanos chanos; bahasa Indonesia: ikan Bandeng) yang dihilangkan durinya, dagingnya dibumbui dan dimasukkan kembali ke kulitnya, lalu ditusuk atau dijepit tusukan tangkai bambu, lalu dibakar di atas bara arang.'),
(111, 'makanan', 'Rabeg', 15, 20000, 500, 'rabeg.jfif', 'Rabeg adalah masakan yang berasal dari Jazirah Arab, lalu menyebar di Banten yang terbuat dari daging kambing yang memakai bumbu sederhana. Rasanya gurih dan tidak terlalu berbahaya untuk yang menderita kolesterol karena makanan ini tidak memerlukan santan dalam proses pengolahannya.																			'),
(112, 'makanan', 'Sambel Burog', 10, 15000, 300, 'sambelburog.jfif', 'Sambel burog merupakan makanan khas Serang yang berbahan dasar kulit melinjo. Kulit melinjo juga dikenal dalam bahasa lokal kulit tangkil. Melinjo atau tangkil memang banyak terdapat di daerah Banten. Salah satu penghasil melinjo di daerah Banten yaitu Pandeglang, kota tentangga Serang. Kulit melinjo matang diiris kecil-kecil ditumis hingga layu. Warnanya yang merah sekilas terlihat seperti irisan cabai merah. Cita rasa sambel burog identik dengan pedas. Campuran cabai, bawang merah, bawang putih, daun salam, kemiri, membuat cita rasa khas masakan kulit melinjo sangat khas.				'),
(113, 'makanan', 'Pecak Bandeng', 30, 25000, 500, 'pecakbandeng.jfif', 'Pecak bandeng, makanan khas Banten, selain sate bandeng. Pecak bandeng dibuat dari ikan bandeng dan di tambah sambal khasnya. Pecak bandeng diolah dengan cara membakar bandeng segar. Yang istimewa dari pecak bandeng adalah sambal yang dicampur langsung dengan ikan bandeng yang telah dibakar. Tidak hanya warga dari Serang, warga dari luar Banten juga memburu kuliner itu terutama di akhir pekan. Bagi Anda yang seneng makan pecak bandeng hanya ada satu di daerah provinsi Banten tepatnya di desa Sawah Luhur, Kecamatan Kasemen.															'),
(114, 'makanan', 'Gecom', 10, 10000, 500, 'gecom.jfif', 'Makanan khas Kabupaten Tangerang yang satu ini wajib anda coba. Namanya cukup unik berasal dari singkatan tauge oncom. Makanan ini berbahan dasar tauge yang dipadukan dengan oncom dan disirm kecap sebagai pemanis. Kecap yang dipakai dalam sajian gecom adalah kecap asli Tangerang yang dikenal dengan merk Kecap SH. Rasanya khas dan menggiurkan.											'),
(115, 'makanan', 'Balok Menes', 15, 13000, 250, 'Balok Menes.jpg', 'Kue balok menes memiliki cita rasa khas. Kue olahan dari singkong atau ubi kayu ini sangat lembut di mulut. Jika Anda kenal dengan makanan tradisional getuk, itulah salah satu jenis getuk, tapi tetap mempertahankan warna asli singkong yang berwarna putih. Nama \"balok menes\" diambil dari nama sebuah daerah daerah yaitu Menes. Menes merupakan salah satu kecamatan di Kabupaten Pandeglang. Selain dikenal sebagai kawasan pendidikan, Kecamatan Menes juga terkenal dengan beberapa panganan tradisional salah satunya balok menes. Ketika Anda berkunjung ke Pandeglang, cobalah makanan khas ini. Masih di Pandeglang, kue balok memiliki nama daerah lain yaitu gegetuk cioda. Gegetuk cioda untuk membedakan dengan kue getuk biasa berwarna cokelat campuran gula merah. Keduanya sama-sama makanan tradisional olahan singkong. Di beberapa wilayah, kue balok menes tetap dengan nama getuk.					'),
(116, 'makanan', 'Pasung Merah', 16, 5000, 400, 'pasung merah.jpg', 'Kue pasung juga dibuat dari adonan tepung beras dan gula merah. Berbeda dengan kue jojorong yang hanya menggunakan satu adonan, kue pasung ini memakai dua adonan. '),
(117, 'makanan', 'Laksa Tangerang', 10, 15000, 700, 'Laksa Tangerang.jpg', 'Makanan khas Tangerang Laksa merupakan sajian makanan berbahan baku mie putih yang dibuat dari beras. Mie yang digunakan seperti mie bihun namun ukurannya lebih besar dari sphagetti. Tekstur mie nya cenderung kasar dan tidak lentur. Mie ini disajikan dengan tambahan kuah gurih yang dibuat dari santan. Tidak lupa tambahan kacang hijau dan taburan daun kucai serta tambahan potongan daging ayam atau telur ayam agar rasanya lebih nikmat.'),
(118, 'makanan', 'Sate Bebek Cibeber', 22, 22000, 700, 'satebebekcibeber.jfif', 'Sate bebek yang berasal dari wilayan Cibeber, sebuah daerah yang berada di kabupaten Cilegon, provinsi Banten									'),
(119, 'makanan', 'Ketan Bintul', 7, 7000, 300, 'ketanbintul.jfif', 'Kudapan yang satu ini banyak disukai oleh masyarakat. Sepeti namanya pasti makanan ini dibuat dari ketan yang diolah sedemikian rupa sehingga berhenti disitu. Harga jual ketan bintul memang terjangkau dan biasanya dijadikan menu sarapan oleh warga masyarakat Tangerang karena mengandung banyak karbohidrat yang mampu menambah tenaga anda untuk beraktifitas.												'),
(120, 'makanan', 'Rengginang', 50, 10000, 150, 'rengginang.jfif', 'Rengginang  merupakan makanan khas Banten yang dibuat dari bahan dasar beras ketan atau nasi yang telah dikeringkan dengan cara dijemur di bawah panas matahari						'),
(121, 'makanan', 'Opak', 40, 5000, 100, 'opak.jfif', 'Opak khas Banten mempunyai tekstur yang kering renyah seperti kerupuk. Bedanya, opak mempunyai cita rasa yang lebih khas.														'),
(122, 'makanan', 'Kue Jojorong', 15, 8000, 200, 'kue jojorong.jfif', 'Makanan khas Tangerang Banten yang satu ini tidak boleh terlewatkan untuk dicoba. Kue jojorong masih dibuat secara tradisional dengan cita rasa manis dan tekstur yang kenyal. Berbahan dasar tepung beras, tepung kanji, dan juga gula merah yang dicampur menjadi satu kemudian dituang pada cetakan kecil dan dikukus selama beberapa menit sebelum siap disajikan.						'),
(123, 'makanan', 'Gipang', 12, 4000, 200, 'Gipang.jpg', 'Gipang mempunyai cita rasa yang manis dengan tekstur yang renyah dan sedikit lengket. Kue khas Banten ini bisa dibuat dari beras ketan merah atau ketan putih.			'),
(124, 'makanan', 'leumeung', 20, 6000, 500, 'leumeung.jfif', 'Leumeung atau lemang bisa ditemukan di daerah Malingping, Lebak Selatan. Makanan tradisional khas Banten yang satu ini terbuat dari campuran beras ketan berbumbu santan kelapa kentan.		'),
(131, 'aksesoris', 'Gelang Simpai', 18, 50000, 100, 'gelang simpai.jfif', 'Terbuat dari kaya jati dan di anyam sebagus mungkin				'),
(132, 'aksesoris', 'Miniatur Menara Banten', 10, 75000, 300, 'miniatur masjid banten.jpg', 'Miniatur Menara Banten merupakan aksesoris Banten										'),
(133, 'aksesoris', 'Miniatur Badak bercula satu ', 5, 100000, 250, 'aksesoris.jpg', 'Salah satu hewan yang berada di Banten				'),
(134, 'aksesoris', 'Asbak', 30, 25000, 500, 'aksesoris.jpg', 'Asbak Banten			'),
(135, 'aksesoiris', 'Miniatur Jawara Banten', 2, 35000, 500, 'aksesoris.jpg', 'Untuk Mengenang Jawara Banten				'),
(136, 'aksesoris', 'Miniatur Orang Baduy', 7, 45000, 600, 'aksesoris.jpg', 'Salah satu suku yang berada di Banten										');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `nama_perum`
--
ALTER TABLE `nama_perum`
  ADD PRIMARY KEY (`id_perum`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_ibfk_1` (`id_pembelian`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `pembelian_produk_ibfk_2` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nama_perum`
--
ALTER TABLE `nama_perum`
  MODIFY `id_perum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`id_ongkir`) REFERENCES `nama_perum` (`id_perum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD CONSTRAINT `pembelian_produk_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_produk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
