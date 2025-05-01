CREATE DATABASE IF NOT EXISTS market;
USE market;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    display_order INT DEFAULT 0
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(255) DEFAULT 'placeholder.png',
    price DECIMAL(10, 2) NOT NULL,
    category_id INT NOT NULL,
    rating DECIMAL(3, 1) DEFAULT 4.0,
    stock INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO categories (id, name, display_order) VALUES 
(1, 'Fresh Fruit', 1),
(2, 'Vegetables', 2),
(3, 'Cooking', 3),
(4, 'Snacks', 4),
(5, 'Beverages', 5),
(6, 'Bread & Bakery', 6),
(7, 'Beauty & Health', 7);

INSERT INTO products (name, image, price, category_id) VALUES
('Organic Red Apples', 'organic_red_apples.png', 3.99, 1),
('Fresh Bananas', 'fresh_bananas.png', 2.49, 1),
('Valencia Oranges', 'valencia_oranges.png', 4.29, 1),
('Seedless Green Grapes', 'seedless_green_grapes.png', 5.99, 1),
('New Zealand Kiwi', 'new_zealand_kiwi.png', 6.49, 1),
('Fresh Pineapple', 'fresh_pineapple.png', 4.99, 1),
('Ripe Mangoes', 'ripe_mangoes.png', 7.99, 1),
('Local Strawberries', 'local_strawberries.png', 3.99, 1),
('Blueberries', 'blueberries.png', 6.99, 1),
('Sweet Peaches', 'sweet_peaches.png', 4.79, 1),
('Fresh Pears', 'fresh_pears.png', 3.89, 1),
('Pomegranate', 'pomegranate.png', 5.49, 1),
('Seasonal Figs', 'seasonal_figs.png', 8.99, 1),
('Hass Avocados', 'hass_avocados.png', 6.99, 1),
('Fresh Lemons', 'fresh_lemons.png', 2.99, 1),
('Watermelon', 'watermelon.png', 5.99, 1),
('Fresh Guava', 'fresh_guava.png', 4.49, 1);

INSERT INTO products (name, image, price, category_id) VALUES
('Potatoes', '../images/veg/potato.jpg', 3.99, 2),
('Chinese Cabbage', 'chinese_cabbage.png', 4.99, 2),
('Golden Corn', 'golden_corn.png', 3.99, 2),
('Eggplant', 'eggplant.png', 4.99, 2),
('Fresh Cauliflower', 'fresh_cauliflower.png', 5.99, 2),
('Green Apples', 'green_apples.png', 4.99, 2),
('Green Bell Pepper', 'green_bell_pepper.png', 3.99, 2),
('Green Chili', 'green_chili.png', 2.99, 2),
('Green Cucumber', 'green_cucumber.png', 3.99, 2),
('Green Lettuce', 'green_lettuce.png', 3.99, 2),
('Green Onion', 'green_onion.png', 1.99, 2),
('Sweet Capsicum', 'sweet_capsicum.png', 4.99, 2),
('Red Chili', 'red_chili.png', 3.99, 2),
('Red Tomato', 'red_tomato.png', 3.99, 2),
('Fresh Mango', 'fresh_mango.png', 5.99, 2);

INSERT INTO products (name, image, price, category_id) VALUES
('Extra Virgin Olive Oil', 'extra_virgin_olive_oil.png', 12.99, 3),
('Natural Tomato Sauce', 'natural_tomato_sauce.png', 3.99, 3),
('Basmati Rice', 'basmati_rice.png', 9.99, 3),
('Mixed Spices', 'mixed_spices.png', 7.49, 3),
('Organic Apple Cider Vinegar', 'organic_apple_cider_vinegar.png', 5.99, 3),
('Tomato Paste', 'tomato_paste.png', 2.49, 3),
('Pink Himalayan Salt', 'pink_himalayan_salt.png', 6.99, 3);

INSERT INTO products (name, image, price, category_id) VALUES
('Natural Mixed Nuts', 'natural_mixed_nuts.png', 8.99, 4),
('Organic Vegetable Chips', 'organic_vegetable_chips.png', 4.99, 4),
('Oatmeal Cookies', 'oatmeal_cookies.png', 3.99, 4),
('Dried Dates', 'dried_dates.png', 6.49, 4),
('Natural Raisins', 'natural_raisins.png', 3.99, 4),
('Organic Dark Chocolate', 'organic_dark_chocolate.png', 5.49, 4),
('Microwave Popcorn', 'microwave_popcorn.png', 2.99, 4),
('Rice Cakes', 'rice_cakes.png', 3.49, 4),
('Mixed Dried Fruits', 'mixed_dried_fruits.png', 7.99, 4);

INSERT INTO products (name, image, price, category_id) VALUES
('Organic Green Tea', 'organic_green_tea.png', 6.99, 5),
('Freshly Ground Coffee', 'freshly_ground_coffee.png', 9.99, 5),
('Natural Orange Juice', 'natural_orange_juice.png', 4.99, 5),
('Coconut Water', 'coconut_water.png', 3.99, 5),
('Mixed Herbal Tea', 'mixed_herbal_tea.png', 7.49, 5),
('Natural Apple Juice', 'natural_apple_juice.png', 4.49, 5);

INSERT INTO products (name, image, price, category_id) VALUES
('Whole Grain Bread', 'whole_grain_bread.png', 3.99, 6),
('Wheat Bread', 'wheat_bread.png', 3.49, 6),
('Fresh Croissants', 'fresh_croissants.png', 5.99, 6),
('Olive Bread', 'olive_bread.png', 4.99, 6),
('Cranberry Muffins', 'cranberry_muffins.png', 6.49, 6),
('Banana Cake', 'banana_cake.png', 8.99, 6),
('Zaatar Bread', 'zaatar_bread.png', 4.49, 6),
('Brown Pita', 'brown_pita.png', 3.29, 6),
('French Baguette', 'french_baguette.png', 2.99, 6),
('Oat Bread', 'oat_bread.png', 4.79, 6),
('Flaxseed Bread', 'flaxseed_bread.png', 5.49, 6),
('Apple Pies', 'apple_pies.png', 7.99, 6);

INSERT INTO products (name, image, price, category_id) VALUES
('Natural Herbal Shampoo', 'natural_herbal_shampoo.png', 8.99, 7),
('Argan Oil Conditioner', 'argan_oil_conditioner.png', 9.49, 7),
('Natural Honey Soap', 'natural_honey_soap.png', 4.99, 7),
('Aloe Vera Moisturizer', 'aloe_vera_moisturizer.png', 12.99, 7),
('Organic Coconut Oil', 'organic_coconut_oil.png', 7.99, 7),
('Coffee Face Scrub', 'coffee_face_scrub.png', 10.49, 7),
('Natural Deodorant', 'natural_deodorant.png', 5.99, 7),
('Green Tea Face Wash', 'green_tea_face_wash.png', 8.49, 7),
('Vegan Toothpaste', 'vegan_toothpaste.png', 7.49, 7),
('Natural Sunscreen', 'natural_sunscreen.png', 14.99, 7),
('Lavender Essential Oil', 'lavender_essential_oil.png', 11.99, 7),
('Avocado Hair Mask', 'avocado_hair_mask.png', 9.99, 7),
('Green Tea Body Lotion', 'green_tea_body_lotion.png', 13.49, 7),
('Natural Room Spray', 'natural_room_spray.png', 7.49, 7);
