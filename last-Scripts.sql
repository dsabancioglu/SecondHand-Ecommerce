-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 Oca 2022, 16:09:02
-- Sunucu sürümü: 10.4.21-MariaDB
-- PHP Sürümü: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dolap`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `brands`
--

CREATE TABLE `brands` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `brands`
--

INSERT INTO `brands` (`Id`, `Name`) VALUES
(1, 'Bershka'),
(2, 'Zara'),
(3, 'Diğer'),
(4, 'Stradivarius');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`Id`, `Name`) VALUES
(1, 'Sweatshirt'),
(2, 'Şapka'),
(3, 'Kaban'),
(4, 'Eşofman Altı'),
(5, 'Gözlük');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CardNo` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `CardName` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `Cvc` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `ExpirationDate` text COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`Id`, `UserId`, `CardNo`, `CardName`, `Cvc`, `ExpirationDate`) VALUES
(8, 27, '111 5555 1111 5555', 'Dilara Sabancıoğlu', '111', '09/28'),
(9, 34, '7777 8888 7777 8888', 'Merve Yıldız', '454', '02/23'),
(10, 1, '1234 1234 1234 1234', 'Ayşe Yıldız', '123', '06/25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `Id` int(11) NOT NULL,
  `CategoriesId` int(200) NOT NULL,
  `Price` double NOT NULL,
  `BrandId` int(11) NOT NULL,
  `Text` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `Image` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `Size` varchar(5) COLLATE utf8mb4_turkish_ci NOT NULL,
  `Stock` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`Id`, `CategoriesId`, `Price`, `BrandId`, `Text`, `Image`, `Size`, `Stock`, `UserId`) VALUES
(1, 1, 75, 1, 'Küçük geldiği için satmak istiyorum', '\'https://cdn.dolap.com/product/org/erkek/sweatshirt/xl-diger_650094676.jpg\'', 'M', 1, 2),
(2, 2, 30, 2, 'Ürün güzelce paketlenip yollanacaktır', '\'https://cdn.dolap.com/product/org/erkek/sapka/goorin-bros_651128776.jpg\'', 'M', 1, 1),
(6, 3, 180, 4, 'Tertemiz kullanılmıştır', '\'https://cdn.dolap.com/product/org/kadin/yagmurluk/tek-ebat-zara_649225859.jpg\'', 'L', 1, 1),
(7, 4, 95, 1, '%100 Pamuk İçi Polar Dışı Lamine 🤍 Zara Taş Rengi Polarlı Jogger Eşofman🤍 🔝 Kalın ve Rahattır. 3 iplik kumaştır. * 📐 Bel; 30 cmUzunluk; 91 cm', '\'https://cdn.dolap.com/product/org/kadin/esofman/s-36-zara_653362138.jpg\'', 'S', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL,
  `Surname` varchar(300) COLLATE utf8mb4_turkish_ci NOT NULL,
  `Mail` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `Password` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `Biography` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `Address` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `Username` varchar(200) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`Id`, `Name`, `Surname`, `Mail`, `Password`, `Biography`, `Address`, `Username`) VALUES
(1, 'Ayşe', 'Yılmaz', 'ayseyilmaz@gmail.com', '1234', 'Kıyafetlerimi satıyorum', 'A sokak B mahallesi', 'ayseyilmaz'),
(2, 'Fatma', 'Ak', 'fatmaak@gmail.com', '1234', 'Kıyafetlerimi satıyorum', 'A sokak B mahallesi', 'fatmaak'),
(27, 'Dilara', 'Sabancıoğlu', 'dilarasabanciogl@gmail.com', '123', 'Merhabalar, en yakın zamanda yeni ürünlerle sizlerle olacağım. Beklemede kalın :)', 'Burdur', 'dsabancioglu'),
(34, 'Merve', 'Yıldız', 'merveyildiz@hotmail.com', 'merve123', 'Az kullanılmış kıyafetlerimi satıyorum.', 'Çankaya/Ankara', 'merveyildiz');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `CategoriesId` (`CategoriesId`),
  ADD KEY `BrandId` (`BrandId`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `brands`
--
ALTER TABLE `brands`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`);

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`CategoriesId`) REFERENCES `categories` (`Id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`BrandId`) REFERENCES `brands` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
