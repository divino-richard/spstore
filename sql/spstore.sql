-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 06:10 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` varchar(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phonenumber` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `email`, `password`, `address`, `phonenumber`) VALUES
('6245c1bf627ea', 'Jhone', 'Doe', 'jhone@gmail.com', '$2y$10$XaV6TuI5FCb4O9n1Gnkc/efJ5.3SBr5My6YhUHaPqz9JFK70NY.8O', 'Barobo, S.D.S.', 9506866597),
('6247dd82e1647', 'Richard', 'Divino', 'rich@gmail.com', '$2y$10$YVHToXsCQpXloyn6PCT4XOxY69BJCbjVJrtR1PIGOkTRGcV2/HnFm', 'Barobo, S.D.S.', 9506866597),
('624a678cc4179', 'Jane', 'Doe', 'jane@gmail.com', '$2y$10$iJttxYLAbOhaFtHfYrCPBuXgaM/bbRU1q7jM6VNmbjfXtdoGVi4EG', 'Metro Manila', 9235421456),
('6260ce2044ae5', 'Eugen', 'Talikig', 'eugen@gmail.com', '$2y$10$BDhqaCS2wBFcdEbZQ3g.B.41kX3LD9Fuwu2J2oVZX7n/Jht6mWBjW', 'Marihatag, Surigao del Sur', 9231234412),
('6260ce207dc91', 'Eugen', 'Talikig', 'eugen@gmail.com', '$2y$10$I/ePNoFow/71RHhwZ47PtO.kxMP37Z/Bw4RXNdD4xlYHuQqfVjG06', 'Marihatag, Surigao del Sur', 9231234412);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` varchar(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phonenumber` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `fname`, `lname`, `email`, `password`, `position`, `address`, `phonenumber`) VALUES
('1', 'Richard', 'Divino', 'admin@dev.com', 'admin123', 'admin', 'P-6 Bahi, Barobo, Surigao del Sur', 9506866597),
('62454dbd43961', 'Jack', 'Ma', 'jack123@gmail.com', '123', 'seller', 'Wuhan, China', 9235423789),
('6254057ec2b71', 'Mark', 'Zuckerberg', 'mark@gmail.com', '12345', 'seller', 'Pasay, Metro Manila', 9341256342);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `seller_id` varchar(50) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_amount` int(255) NOT NULL,
  `shipping_fee` int(255) NOT NULL,
  `delivery_status` varchar(50) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `customer_id`, `seller_id`, `payment_method`, `quantity`, `order_amount`, `shipping_fee`, `delivery_status`, `is_paid`, `order_date`) VALUES
('62542654d5e1f', '62541310bb4f3', '6247dd82e1647', '62454dbd43961', 'online_payment', 1, 70319, 120, 'Packed', 1, '2022-04-15 15:28:17'),
('62542722c1873', '62541bd81f9e5', '6245c1bf627ea', '6254057ec2b71', 'cod', 1, 20619, 120, 'Delivered', 1, '2022-04-29 12:06:37'),
('62550401084a6', '62540ed209463', '6247dd82e1647', '62454dbd43961', 'cod', 1, 6470, 120, 'Shipped', 1, '2022-04-15 15:28:24'),
('62553e138ec2b', '62540ed209463', '6245c1bf627ea', '62454dbd43961', 'cod', 1, 6470, 120, 'On Process', 0, '2022-04-12 16:53:39'),
('62553f35976e2', '6254108cb94fa', '6247dd82e1647', '62454dbd43961', 'cod', 1, 76419, 120, 'Packed', 1, '2022-04-16 18:52:56'),
('6260cd82be309', '62541a04205ef', '6245c1bf627ea', '6254057ec2b71', 'cod', 1, 9419, 120, 'On Process', 0, '2022-04-21 11:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(50) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `supplier_id` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `import_price` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty_in_stock` int(11) NOT NULL,
  `is_out_of_stock` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `employee_id`, `supplier_id`, `image`, `name`, `brand`, `import_price`, `price`, `category`, `description`, `qty_in_stock`, `is_out_of_stock`, `is_active`) VALUES
('62540b0041e76', '62454dbd43961', '625402c3202ee', 'product_62540b00414813.64296708.jpg', 'Vivo Y91', 'vivo', 7000, 7499, 'android', 'The Vivo Y91 features a 6.22-inch display, 13 MP f/2.2 + 2 MP depth f/2.4 rear cameras, 3GB RAM, and a 4,030mAh battery capacity. Overall, the Vivo Y91 is a decent device that boasts a sturdy design and long battery life. Without its marquee features, it ', 100, 0, 1),
('62540cec95f58', '62454dbd43961', '62540831f1f50', 'product_62540cec90f6e1.99300498.jpg', 'Samsung Galaxy S10', 'samsung', 29000, 29699, 'android', 'The cheapest price of Samsung Galaxy S10 in Philippines is PHP29688 from Galleon. The Samsung Galaxy S10 features a 6.1\" display, 12 + 12MP back camera, 10MP front camera, and a 3400mAh battery capacity. It also comes with Octa Core CPU and runs on Androi', 150, 0, 1),
('62540ddcb8ad0', '62454dbd43961', '62540223e00e7', 'product_62540ddcb78516.39367431.jpg', 'HUAWEI P30 Pro', 'huawei', 32500, 33250, 'android', 'The cheapest price of Huawei P30 Pro in Philippines is PHP31727.81 from Amazon. The Huawei P30 Pro features a 6.5\" display, 40 + 20MP back camera, 32MP front camera, and a 4200mAh battery capacity. It also comes with Octa Core CPU and runs on Android.', 125, 0, 1),
('62540ed209463', '62454dbd43961', '625403a3e00ff', 'product_62540ed2089aa0.92880054.jpg', 'OPPO A16', 'oppo', 6000, 6350, 'android', 'The cheapest price of OPPO A16 in Philippines is PHP6190 from Shopee. The OPPO A16 features a 6.52\" display, 13 + 2 + 2MP back camera, 8MP front camera, and a 5000mAh battery capacity. It also comes with Octa Core CPU and runs on Android', 100, 0, 1),
('6254108cb94fa', '62454dbd43961', '6254031e09b0b', 'product_6254108cb50c67.72902662.jpg', 'Apple iPhone 12 Pro Max', 'apple', 75600, 76299, 'ios', 'The cheapest price of Apple iPhone 12 Pro Max in Philippines is PHP71990 from Shopee. The Apple iPhone 12 Pro Max features a 6.7\" display, 12 + 12 + 12MP back camera, 12MP front camera, and a 4100mAh battery capacity. It also comes with Octa Core CPU and ', 50, 0, 1),
('62541262bb44a', '62454dbd43961', '625403f514ed6', 'product_62541262ba5a88.93015122.jpg', 'Realme 6S', 'realme', 48350, 49299, 'android', 'The cheapest price of Realme 6S in Philippines is PHP48138 from Shopee. The Realme 6S features a 6.5\" display, 48 + 8 + 2 + 2MP back camera, 16MP front camera, and a 4300mAh battery capacity. It also comes with Octa Core CPU and runs on Android.', 120, 0, 1),
('62541310bb4f3', '62454dbd43961', '625403f514ed6', 'product_6260cffb697a26.04805915.jpeg', 'Realme V25', 'realme', 69599, 70199, 'android', 'The cheapest price of realme V25 in Philippines is PHP69999 from Lazada. The realme V25 features a 6.6\" display, 64 + 2 + 2MP back camera, 16MP front camera, and a 5000mAh battery capacity. It also comes with Octa Core CPU and runs on Android. Release dat', 200, 0, 1),
('62541a04205ef', '6254057ec2b71', '625402c3202ee', 'product_62541a041fb9d5.31273684.jpg', 'Vivo Y20S', 'vivo', 8399, 9299, 'android', 'The cheapest price of Vivo Y20s in Philippines is PHP9850 from Lazada. The Vivo Y20s features a 6.51\" display, 13 + 2 + 2MP back camera, 8MP front camera, and a 5000mAh battery capacity. It also comes with Octa Core CPU and runs on Android. Release date o', 125, 0, 1),
('62541b1a47481', '6254057ec2b71', '625403a3e00ff', 'product_62541b1a468300.49556348.jpg', 'OPPO Find X2 Pro', 'oppo', 45399, 46399, 'android', 'The cheapest price of OPPO Find X2 Pro in Philippines is PHP45990 from LazMall by Lazada. The OPPO Find X2 Pro features a 6.7\" display, 48 + 48 + 13MP back camera, 32MP front camera, and a 4260mAh battery capacity. It also comes with Octa Core CPU and run', 120, 0, 1),
('62541bd81f9e5', '6254057ec2b71', '62540223e00e7', 'product_62541bd81dad20.46790832.jpg', 'Huawei nova 7', 'huawei', 19499, 20499, 'android', 'The cheapest price of Huawei nova 7 5G in Philippines is PHP19499 from Shopee. The Huawei nova 7 5G features a 6.53\" display, 64 + 8 + 8 + 2MP back camera, 32MP front camera, and a 4000mAh battery capacity. It also comes with Octa Core CPU and runs on And', 110, 0, 1),
('6259228b338b9', '6254057ec2b71', '62540223e00e7', 'product_62594ec4e47101.39503851.jpeg', 'Huawei nova 7i', 'huawei', 12399, 12799, 'android', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, tenetur aliquid. Nobis minima cumque ullam officia dolorum repellat, harum ex illo fuga ipsam id sunt.', 120, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `seller_id` varchar(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `order_id`, `seller_id`, `quantity`, `total_amount`, `sales_date`) VALUES
('62542654ef06b', '62542654d5e1f', '62454dbd43961', 1, 70319, '2022-04-11 13:00:04'),
('6256bf07ca9e6', '62550401084a6', '62454dbd43961', 1, 6470, '2022-04-13 12:16:07'),
('6256c629e3426', '62553f35976e2', '62454dbd43961', 1, 76419, '2022-04-13 12:46:33'),
('626b6449f251e', '62542722c1873', '6254057ec2b71', 1, 20619, '2022-04-29 04:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` varchar(50) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phonenumber` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `company_name`, `address`, `phonenumber`) VALUES
('62540223e00e7', 'Huawei Philippines', 'Taguig, Metro Manila', 9203451284),
('625402c3202ee', 'Vivo Philippines', 'Pasay, Metro Manila', 9342176751),
('6254031e09b0b', 'Apple Philippines', 'Quezon City, Metro Manila', 9231453112),
('625403a3e00ff', 'Oppo Philippines', 'Mandaluyong, Metro Manila', 9475123412),
('625403f514ed6', 'Realme Philippines', 'Valenzuela', 9586321454),
('62540831f1f50', 'Samsung Philippines', 'Taguig, Metro Manila', 9473645288);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_product`
--

CREATE TABLE `supplier_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `supplier_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_product`
--

INSERT INTO `supplier_product` (`id`, `product_id`, `supplier_id`) VALUES
(6, '62540b0041e76', ' 625402c3202ee'),
(7, '62540cec95f58', ' 62540831f1f50'),
(8, '62540ddcb8ad0', ' 62540223e00e7'),
(10, '62540ed209463', ' 625403a3e00ff'),
(11, '6254108cb94fa', ' 6254031e09b0b'),
(12, '62541262bb44a', ' 625403f514ed6'),
(13, '62541310bb4f3', ' 625403f514ed6'),
(14, '62541a04205ef', ' 625402c3202ee'),
(16, '62541b1a47481', ' 625403a3e00ff'),
(17, '62541bd81f9e5', ' 62540223e00e7'),
(18, '6259228b338b9', ' 62540223e00e7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `supplier_product`
--
ALTER TABLE `supplier_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
