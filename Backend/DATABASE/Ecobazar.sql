CREATE DATABASE if not exists eco_bazar;
USE eco_bazar;

CREATE TABLE if not exists users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE if not exists categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE if not exists products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    category_id INT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE if not exists orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE if not exists order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE if not exists reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ||||||||||||||||||||||||||||||||||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


INSERT INTO users (name, email, password, role) 
VALUES 
  ('Ahmed Ali', 'ahmed@example.com', '123456', 'customer'),
  ('Sara Mohamed', 'sara@example.com', 'abcdef', 'customer'),
  ('Admin User', 'admin@example.com', 'admin123', 'admin'),
  ('Mohamed Ali', 'mohamed@example.com', 'pass123', 'customer');


INSERT INTO categories (name)
VALUES 
('Electronics'),
('Clothing'),
('Home & Garden');


INSERT INTO products (name, description, price, stock, category_id, image_url)
VALUES
('iPhone 14', 'Latest Apple smartphone.', 29999.00, 10, 1, 'iphone.jpg'),
('Men T-Shirt', 'Cotton t-shirt.', 250.00, 50, 2, 'tshirt.jpg'),
('Garden Chair', 'Comfortable chair for garden.', 750.00, 20, 3, 'chair.jpg');


INSERT INTO orders (user_id, total_price, status)
VALUES
(1, 30500.00, 'pending'),
(2, 250.00, 'completed');


INSERT INTO order_items (order_id, product_id, quantity, price)
VALUES
(1, 1, 1, 29999.00),  -- أحمد اشترى آيفون
(1, 3, 1, 750.00),    -- أحمد اشترى كرسي جنينة
(2, 2, 1, 250.00);    -- سارة اشترت تي شيرت

INSERT INTO reviews (user_id, product_id, rating, comment)
VALUES
(1, 1, 5, 'Amazing phone!'),
(2, 2, 4, 'Good quality t-shirt.'),
(1, 3, 3, 'Chair is okay but could be better.');


SELECT * FROM users;












