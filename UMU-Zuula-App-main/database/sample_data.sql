-- Clear previous attempts if any
DELETE FROM item_list WHERE title LIKE '%Lost%' OR title LIKE '%Found%';

-- Sample Items mapping to correct category IDs
-- 5: Electronics, 6: Books, 7: IDs, 8: Clothing
INSERT INTO `item_list` (`category_id`, `fullname`, `title`, `description`, `contact`, `status`) VALUES 
(5, 'John Doe', 'Lost HP Laptop', 'Black HP Elitebook lost in the Library. Has a sticker of a wolf on the lid.', '0701234567', 0),
(7, 'Sarah Nansubuga', 'Found UMU ID Card', 'Found a student ID card for Nansubuga Sarah near the Main Hall.', '0755998877', 1),
(6, 'Ian Kawalya', 'Lost Calculus Textbook', 'Blue covered Calculus textbook lost near the cafeteria.', '0777112233', 0),
(8, 'Admin', 'Found Leather Wallet', 'Brown leather wallet found in the parking lot. Contains no cash but some receipts.', 'System', 1),
(5, 'Mike Ross', 'Lost iPhone 13', 'Blue iPhone 13 with a cracked screen protector. Lost at the sports ground.', '0712345678', 0),
(7, 'Staff User', 'Found Laptop Charger', 'Lenovo 65W USB-C charger found in Block B Room 4.', '0788123456', 1);
