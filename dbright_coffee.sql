-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tugasnela_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Database: `tugasnela_db`
--
CREATE DATABASE IF NOT EXISTS `tugasnela_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tugasnela_db`;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kategori_label` varchar(50) NOT NULL,
  `badge` varchar(50) NOT NULL,
  `subjudul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Americano (Hot/ice)','coffee','Coffee','Hot / Ice','Espresso Murni','Seduhan espresso murni dengan air panas atau es batu segar, rasa kopi kuat dan pekat tanpa ampas.',10000,0),(2,'Kopi Susu Klasik','coffee','Coffee','Favorit','Kopi & Kental Manis','Perpaduan seimbang antara racikan kopi hitam mantap dengan gurihnya susu kental manis klasik.',13000,0),(3,'Signature D\'Bright','coffee','Coffee','Best Seller','Racikan Khas D\'Bright','Menu kopi andalan khas D\'Bright Coffee dengan formulasi rahasia yang creamy, gurih, dan nikmat.',15000,1),(4,'Kopi Pandan','coffee','Coffee','Aromatik','Kopi Susu & Sari Pandan','Sensasi kopi susu creamy berpadu keharuman aroma pandan wangi yang segar dan khas di lidah.',15000,0),(5,'Caramel Coffee','coffee','Coffee','Manis Gurih','Espresso & Saus Karamel','Kombinasi espresso mantap berbalut saus karamel manis legit dan susu dingin yang gurih menggugah selera.',15000,0),(6,'Butterscoth','coffee','Coffee','Creamy Butter','Butterscotch & Coffee','Cita rasa unik sirup butterscotch berpadu susu segar dan espresso, memberikan sensasi buttery manis lembut.',15000,0),(7,'Coffee Latte','coffee','Coffee','Klasik','Espresso & Steamed Milk','Keseimbangan sempurna single shot espresso berkualitas dengan susu segar gurih yang lembut di lidah.',15000,0),(8,'Matcha Latte','non-coffee','Non Coffe','Matcha Asli','Teh Hijau Jepang & Susu','Bubuk teh hijau matcha murni berkualitas dipadu dengan susu murni segar, harum dan kaya antioksidan.',18000,0),(9,'Matcha Strawberry','non-coffee','Non Coffe','Spesial','Matcha & Buah Strawberry','Perpaduan estetik matcha hijau pekat dengan layer selai strawberry asam manis yang segar menggoda.',23000,0),(10,'Choco Matcha','non-coffee','Non Coffe','Dual Flavour','Cokelat & Teh Hijau','Kombinasi kaya rasa cokelat premium pekat berpadu kelembutan matcha dalam satu tegukan istimewa.',23000,0),(11,'Matcha Oreo','non-coffee','Non Coffe','Topping Oreo','Matcha & Biskuit Oreo','Matcha latte creamy dengan limpahan remahan biskuit Oreo renyah yang gurih manis di setiap sedotan.',23000,0),(12,'Chocolate','non-coffee','Non Coffe','Cokelat Murni','Dark Chocolate Kental','Minuman cokelat murni kaya rasa dengan tekstur lembut yang manis pas dan sangat memanjakan lidah.',13000,0),(13,'Red Velvet','non-coffee','Non Coffe','Manis Gurih','Red Velvet & Susu Segar','Karakter rasa kue red velvet dengan hint cocoa manis gurih berpadu susu murni dingin yang menyegarkan.',13000,0),(14,'Thai Tea','non-coffee','Non Coffe','Teh Rempah','Teh Asli Thailand','Seduhan teh daun rempah Thailand asli dipadukan kental manis dan susu evaporasi yang gurih lezat.',13000,0),(15,'Taro latte','non-coffee','Non Coffe','Taro Lembut','Taro Ungu & Fresh Milk','Minuman taro ungu harum dengan rasa manis gurih lembut berpadu susu murni yang nikmat dan mengenyangkan.',13000,0),(16,'Lemon/Lyche Tea','non-coffee','Non Coffe','Super Segar','Pilihan Lemon atau Leci','Pilihan teh dingin segar rasa lemon citrus asam segar atau buah leci manis harum penghilang dahaga seketika.',13000,0),(17,'Kentang Goreng','snack','Menu Snack','Renyah','French Fries Gurih','Potongan kentang goreng renyah di luar dan lembut di dalam, disajikan hangat lengkap dengan saus sambal dan mayones.',13000,0),(18,'Ubi Goreng','snack','Menu Snack','Tradisional','Ubi Manis Renyah','Camilan ubi goreng khas yang renyah gurih di luar dan pulen manis di dalam, teman sempurna ngopi santai.',13000,0),(19,'Roti Bakar','snack','Menu Snack','Topping Melimpah','Roti Panggang Krispi','Roti bakar empuk dipanggang wangi mentega dengan pilihan isian manis lumer yang memanjakan lidah.',15000,0),(20,'Banana Stick (choco& Tiramisu)','snack','Menu Snack','Manis Lumer','Pisang Cokelat Tiramisu','Stik pisang krispi dengan limpahan glaze cokelat tebal dan aroma tiramisu yang lezat menggoda selera.',13000,0),(21,'Platter (kentang,sosis,nugget)','snack','Menu Snack','Paling Komplit','Kombinasi 3 Camilan','Paket komplit berisi kentang goreng gurih, potongan sosis panggang empuk, dan nugget ayam renyah.',22000,1),(22,'Dimsum Mentai','snack','Menu Snack','Saus Mentai','Dimsum Lembut & Saus Mentai','Olahan dimsum lembut isi padat disiram saus mentai gurih creamy yang dibakar aromatik khas kafe.',20000,0),(23,'Indomie Biasa','snack','Menu Snack','Cepat Saji','Goreng atau Kuah','Sajian mie instan Indomie favorit dimasak hangat dengan tingkat kematangan pas untuk pengganjal lapar.',8000,0),(24,'Indomie Komplit','snack','Menu Snack','Telur & Sayur','Paket Telur & Topping','Indomie lezat disajikan komplit dengan tambahan telur matang/setengah matang dan pelengkap sayur segar.',13000,0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesanan`
--

DROP TABLE IF EXISTS `pesanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemesan` varchar(100) NOT NULL,
  `menu_pilihan` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `ukuran` varchar(50) DEFAULT 'Regular',
  `level_gula` varchar(50) DEFAULT 'Normal',
  `topping` varchar(50) DEFAULT 'Tanpa Topping',
  `catatan` text DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `waktu_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesanan`
--

LOCK TABLES `pesanan` WRITE;
/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-04 15:14:22
