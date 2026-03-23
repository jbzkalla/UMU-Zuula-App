-- Clear item list
DELETE FROM item_list;

-- Insert 15 lost items
INSERT INTO `item_list` (`id`, `category_id`, `fullname`, `title`, `description`, `contact`, `image_path`, `status`) VALUES 
(1, 5, 'System', 'Lost HP Elitebook', 'Black laptop with university stickers.', '0700000001', 'uploads/items/1.png', 0),
(2, 7, 'System', 'Lost UMU ID', 'Student ID card found near secondary gate.', '0700000002', 'uploads/items/2.png', 0),
(3, 5, 'System', 'Lost iPhone 13', 'Blue iPhone with cracked screen.', '0700000003', 'uploads/items/3.png', 0),
(4, 6, 'System', 'Lost Calculus Book', 'Blue textbook for engineering.', '0700000004', 'uploads/items/4.png', 0),
(5, 8, 'System', 'Lost Denim Jacket', 'Blue jacket left in Main Hall.', '0700000005', 'uploads/items/5.png', 0),
(6, 5, 'System', 'Lost Wireless Earbuds', 'White earbuds in a black case.', '0700000006', 'uploads/items/6.avif', 0),
(7, 7, 'System', 'Lost Leather Wallet', 'Brown wallet with some receipts.', '0700000007', 'uploads/items/7.jpg', 0),
(8, 5, 'System', 'Lost Power Bank', '10000mAh black power bank.', '0700000008', 'uploads/items/8.jpg', 0),
(9, 6, 'System', 'Lost Notebook', 'Spiral notebook with lecture notes.', '0700000009', 'uploads/items/9.jpg', 0),
(10, 8, 'System', 'Lost Water Bottle', 'Steel bottle with a dent.', '0700000010', 'uploads/items/10.jpg', 0),
(11, 5, 'System', 'Lost USB Drive', '128GB SanDisk drive.', '0700000011', 'uploads/items/11.jpg', 0),
(12, 7, 'System', 'Lost National ID', 'ID for a male student.', '0700000012', 'uploads/items/12.jpg', 0),
(13, 8, 'System', 'Lost Sunglasses', 'Black Ray-Ban style glasses.', '0700000013', 'uploads/items/13.jpg', 0),
(14, 5, 'System', 'Lost Digital Watch', 'Black sport watch.', '0700000014', 'uploads/items/14.webp', 0),
(15, 6, 'System', 'Lost Folder', 'Yellow folder with printouts.', '0700000015', 'uploads/items/15.jpg', 0);
