SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `admindata` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `admindata` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$64JLBL9IpH59/yYzwuIIFuev2NAVmwIWPhn0bg6EgAJPhKApC49Su'),
(2, 'admin2', 'admin2@admin.com', '$2y$10$RgcOVMrE8LyPkq3oxjKyTeZON652.lyvh.4Onc89pxRIln0DPxHL6');



CREATE TABLE `yazilar` (
  `id` int(10) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `baslik` varchar(250) NOT NULL,
  `icerik` text NOT NULL,
  `olusturulma_tarihi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `yazilar` (`id`, `admin_id`, `baslik`, `icerik`, `olusturulma_tarihi`) VALUES
(2, 1, 'Deneme', 'Test', '2026-03-14 06:36:27');


ALTER TABLE `admindata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);


ALTER TABLE `yazilar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin_yazi` (`admin_id`);


ALTER TABLE `admindata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `yazilar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `yazilar`
  ADD CONSTRAINT `fk_admin_yazi` FOREIGN KEY (`admin_id`) REFERENCES `admindata` (`id`) ON DELETE CASCADE;
COMMIT;

