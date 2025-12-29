-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th12 19, 2025 lúc 09:12 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `trangsuc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created_at`, `updated_at`, `isDeleted`) VALUES
(1, 'Nhẫn ', NULL, '2025-12-12 01:05:26', '2025-12-20 01:00:28', 0),
(2, 'Dây chuyền', NULL, '2025-12-12 01:05:26', '2025-12-12 01:05:26', 0),
(3, 'Bông Tai', NULL, '2025-12-12 01:05:26', '2025-12-12 01:05:26', 0),
(4, 'Lắc Tay', NULL, '2025-12-12 01:05:26', '2025-12-20 01:05:41', 0),
(5, 'Lắc chân', NULL, '2025-12-20 01:07:16', '2025-12-20 01:07:16', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `total_money` decimal(15,0) NOT NULL,
  `status` enum('Chờ xác nhận','Đang xử lý','Đang giao','Đã giao','Đã hủy') DEFAULT 'Chờ xác nhận',
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `phone_number`, `address`, `total_money`, `status`, `note`, `created_at`) VALUES
(1, NULL, 'Mỹ Linh', '089208406', 'Xã Bà Nà, TP Đà Nẵng', 55000000, 'Chờ xác nhận', 'Che tên sản phẩm', '2025-12-20 01:47:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 4, 55000000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(18,0) NOT NULL DEFAULT 0,
  `discount_price` int(11) DEFAULT 0,
  `short_description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `discount_price`, `short_description`, `content`, `main_image`, `category_id`, `stock_quantity`, `status`, `created_at`, `updated_at`, `image1`, `image2`, `isDeleted`) VALUES
(1, 'Lắc Tay Vàng Ý', 132000000, 5, '', 'Chi tiết sản phẩm: Chất liệu Vàng Trắng 18K, trọng lượng Kim Cương chính 0.54ct, độ tinh khiết VVS2. Thiết kế sang trọng, phù hợp cho đi dự tiệc.', 'assets/imgs/1766157289_1766156736_1764695172_1_lt7.2.jpg', 4, 15, 1, '2025-12-12 01:05:26', '2025-12-19 22:41:14', NULL, NULL, 0),
(2, 'Vòng Cổ Ruby Thiên Nhiên', 45000000, 20, 'Vòng cổ vàng 24K đính đá Ruby thiên nhiên màu đỏ huyết.', 'Thiết kế dây chuyền mảnh, mặt đá Ruby 2.5 carats. Phù hợp cho các buổi tiệc sang trọng.', '../assets/imgs/1764694359_Dc_cartier.jpg', 2, 25, 1, '2025-12-12 01:05:26', '2025-12-19 20:27:37', '../assets/imgs/1764694359_1_Dc_cartier1.jpg', '../assets/imgs/1764694359_2_Dc_cartier2.jpg', 0),
(3, 'Bông Tai Ngọc Trai South Sea', 18000000, 0, 'Đôi bông tai ngọc trai South Sea màu vàng kim, sang trọng.', 'Ngọc trai đường kính 12mm, khóa cài bằng vàng 18K. Thiết kế đơn giản nhưng quý phái.', '../assets/imgs/1764691895_bt3.1.jpg', 3, 40, 1, '2025-12-12 01:05:26', '2025-12-17 19:25:15', '../assets/imgs/1764691895_1_bt3.2.jpg', '../assets/imgs/1764691895_2_bt3.jpg', 0),
(4, 'Nhẫn Cưới Kim Cương Trơn Elegance', 55000000, 0, 'Nhẫn cặp vàng trắng 18K thiết kế trơn, đính một viên kim cương nhỏ 3.5 ly.', 'Chi tiết: Chất liệu Vàng Trắng 18K. Thiết kế tối giản, hiện đại, rất phù hợp cho nhẫn cưới và nhẫn đôi.', '../assets/imgs/1764695595_nhan2.jpg', 1, 50, 1, '2025-12-12 01:05:26', '2025-12-17 19:26:05', '../assets/imgs/1764695595_1_nhan2.2.jpg', '../assets/imgs/1764695595_2_N2.jpg', 0),
(5, 'Dây Chuyền Kim Cương Mặt Chữ', 22000000, 10, 'Dây chuyền vàng 14K mặt chữ cái đính kim cương tấm.', 'Chất liệu Vàng Vàng 14K, trọng lượng 1.5 chỉ. Tùy chọn khắc tên hoặc chữ cái theo yêu cầu.', '../assets/imgs/1764694560_dctiffanico.jpg', 2, 35, 1, '2025-12-12 01:05:26', '2025-12-19 21:33:36', '../assets/imgs/1764694560_1_dctiffanico1.jpg', '../assets/imgs/1764694560_2_dctiffanico2.jpg', 0),
(7, 'Lắc Tay Vàng Ý Kim Tiền May Mắn', 12500000, 5, 'Lắc tay Vàng Ý 750, thiết kế mắt xích kim tiền mang lại tài lộc.', 'Thiết kế chuỗi mắt xích tinh xảo, nặng 2 chỉ vàng 18K. Phù hợp cho cả nam và nữ.', '../assets/imgs/1764694892_lt3..jpg', 4, 45, 1, '2025-12-12 01:05:26', '2025-12-19 21:24:35', '../assets/imgs/1764694892_1_lt3.2.jpg', '../assets/imgs/1764694892_2_lt3.jpg', 0),
(8, 'Dây Chuyền Họa Tiết Cỏ Bốn Lá', 15500000, 10, 'Dây chuyền vàng trắng 14K mặt cỏ bốn lá đính kim cương nhân tạo.', 'Tượng trưng cho may mắn và hy vọng. Độ dài dây 45cm, có thể điều chỉnh.', '../assets/imgs/1764694403_DCngoctrai.jpg', 2, 30, 1, '2025-12-12 01:05:26', '2025-12-19 21:22:10', '../assets/imgs/1764694403_1_dcngoctrai.webp', '../assets/imgs/1764694403_2_dcngoctrai1.jpg', 0),
(12, 'Dây Chuyền Kim Cương Mặt Chữ', 20000000, 0, NULL, 'Dây chuyền đẹp, sang trọng.', 'assets/imgs/1766158695_1764695108_1_lt6.webp', 2, 0, 1, '2025-12-19 22:38:15', '2025-12-19 22:38:15', 'assets/imgs/1766158695_1764695108_2_lt62.webp', 'assets/imgs/1766158695_1764695108_lt6.1.webp', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isDeleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `isDeleted`) VALUES
(1, 'Quản lý', 0),
(2, 'Nhân viên', 0),
(3, 'Khách hàng', 0),
(4, 'Admin', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `phone_number`, `password`, `role_id`, `created_at`, `updated_at`, `deleted`, `reset_token`, `token_expiry`) VALUES
(1, 'Mỹ Linh', 'mylinh1305@gmail.com', '0347367621', '$2a$12$L4AwLzAJb662zW1CD/tpHOVRnFIYQbj2q8rd.fdTrOk9Ccq0S7H82', 1, '2025-11-20', NULL, 0, NULL, NULL),
(2, 'Như Trâm', 'nhutram1234@gmail.com', '0999999999', '$2y$10$4lW6JvVvrf7tP7hampacceZ0W4cAZv/1Ym5oQTyJBc7oju45Gi5U.', 3, '2025-11-20', '2025-12-19', 0, NULL, NULL),
(3, 'Cẩm Vân', 'camvan@gmail.com', '0888888888', '$2a$12$vpRbjSQCAOpjP7lg0NOrmOs9vzPF67GTjrC1AddtCea60HtuWloJK', 2, '2025-11-20', NULL, 0, NULL, NULL),
(4, 'Huyền Trâm', 'huyentram@gmail.com', '0777777777', '$2a$12$vpRbjSQCAOpjP7lg0NOrmOs9vzPF67GTjrC1AddtCea60HtuWloJK', 3, '2025-11-20', NULL, 0, NULL, NULL),
(5, 'Diệu Thảo', 'dieuthao@gmail.com', '0987654321', '$2y$10$fFuAwRxTuKvjvBWQS/S2l.VuU9J8YST7RVdgboZb6oTOlW6YTngl6', 3, '2025-12-03', '2025-12-20', 0, NULL, NULL),
(6, 'Hoài Trâm', 'hoaitram123@gmail.com', '0888888888', '$2y$10$Q5wAA/dPyvpoweQuStgz2OugqRqbZOU5qvmmiREHcNypqVevj2CCK', 2, '2025-12-06', '2025-12-20', 0, NULL, NULL),
(7, 'Hoài Vyy', 'hoaivy123@gmail.com', '08888888', '$2y$10$rOuOJ0/lvqEKotYDLhYMDe4Zw5coSEfwL7cKK8sXi6Y0cbwGXspbO', 3, '2025-12-12', '2025-12-20', 0, NULL, NULL),
(8, 'Kiều Trang', 'kieutrang12@gmail.com', '0787873674', '$2y$10$N7Z/nP8lCGtkyZBqALPZ7OsNmA9LAC8vsxwsNrk2ykU37PSuNC6XS', 3, '2025-12-17', '2025-12-20', 0, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_order` (`order_id`),
  ADD KEY `fk_detail_product` (`product_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_fk` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_detail_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detail_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
