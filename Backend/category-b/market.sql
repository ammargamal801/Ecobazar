CREATE DATABASE IF NOT EXISTS market;
USE market;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    display_order INT DEFAULT 0,
    image VARCHAR(255) DEFAULT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    logo VARCHAR(255) DEFAULT NULL,
    description TEXT,
    website VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT NOT NULL,
    brand_id INT,
    main_image VARCHAR(255) DEFAULT 'placeholder.png',
    original_price DECIMAL(10, 2) NOT NULL,
    discounted_price DECIMAL(10, 2),
    stock_quantity INT DEFAULT 100,
    weight VARCHAR(50),
    color VARCHAR(50),
    type VARCHAR(50),
    features TEXT,
    description TEXT,
    tags VARCHAR(255),
    sold_count INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT FALSE,
    is_new BOOLEAN DEFAULT FALSE,
    is_organic BOOLEAN DEFAULT FALSE,
    status ENUM('active', 'inactive', 'out_of_stock') DEFAULT 'active',
    video_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (brand_id) REFERENCES brands(id)
);

CREATE TABLE product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    profile_image VARCHAR(255) DEFAULT 'default_user.png',
    phone VARCHAR(20),
    address TEXT,
    city VARCHAR(50),
    country VARCHAR(50),
    postal_code VARCHAR(20),
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    user_name VARCHAR(100),
    rating DECIMAL(3, 1) NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE product_tags (
    product_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (product_id, tag_id),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE related_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    related_product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (related_product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    shipping_address TEXT NOT NULL,
    billing_address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    payment_method VARCHAR(50) NOT NULL,
    payment_status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    tracking_number VARCHAR(100),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO categories (id, name, display_order, image, description) VALUES 
(1, 'Fresh Fruit', 1, 'category_fruit.png', 'Fresh and delicious fruits from local and international farms'),
(2, 'Vegetables', 2, 'category_vegetables.png', 'Organic and fresh vegetables for your healthy lifestyle'),
(3, 'Cooking', 3, 'category_cooking.png', 'Essential ingredients for your cooking needs'),
(4, 'Snacks', 4, 'category_snacks.png', 'Healthy and tasty snacks for any time of day'),
(5, 'Beverages', 5, 'category_beverages.png', 'Refreshing drinks and beverages'),
(6, 'Bread & Bakery', 6, 'category_bakery.png', 'Fresh breads and bakery items baked daily'),
(7, 'Beauty & Health', 7, 'category_beauty.png', 'Natural and organic beauty and health products');

INSERT INTO brands (name, logo, description, website) VALUES
('Organic Farms', 'organic_farms_logo.png', 'Leading producer of organic fruits and vegetables', 'https://organicfarms.com'),
('Natural Foods', 'natural_foods_logo.png', 'Quality natural food products', 'https://naturalfoods.com'),
('GreenLife', 'greenlife_logo.png', 'Eco-friendly food and household products', 'https://greenlife.com'),
('Fresh Harvest', 'fresh_harvest_logo.png', 'Farm to table fresh produce', 'https://freshharvest.com'),
('Healthy Choice', 'healthy_choice_logo.png', 'Premium health-conscious products', 'https://healthychoice.com');

INSERT INTO tags (name) VALUES
('Organic'), ('Fresh'), ('Natural'), ('Vegan'), ('Gluten-Free'), 
('Non-GMO'), ('Local'), ('Seasonal'), ('Imported'), ('Premium'), 
('Discount'), ('New Arrival'), ('Best Seller'), ('Low Calorie'), ('Healthy');

CREATE TABLE product_videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    video_id VARCHAR(50) NOT NULL,
    video_platform ENUM('youtube', 'vimeo', 'other') DEFAULT 'youtube',
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE product_features (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    icon VARCHAR(50) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO users (username, email, password, first_name, last_name, is_admin) VALUES
('admin', 'admin@example.com', '$2y$10$9YvtdgLu5GzMuG/3Qr3pW.wdIFYeNJuI6MzFkWXrLtt.QrIcV/Cg2', 'Admin', 'User', TRUE),
('user1', 'user1@example.com', '$2y$10$aEGtLg987ygS7gH3jKl4Wu8E4uVRBfLPCGIcdSKMw0HQ0Ojc/jjmO', 'John', 'Doe', FALSE),
('user2', 'user2@example.com', '$2y$10$bGhJ8ylQK3LmKjP1qL5sReQcN0LaH7HSHFYdXKrOANUUJYyV6AGMC', 'Jane', 'Smith', FALSE);

INSERT INTO products (
    name, 
    category_id, 
    brand_id, 
    main_image, 
    original_price, 
    discounted_price, 
    stock_quantity, 
    weight, 
    color, 
    type, 
    features, 
    description, 
    tags, 
    sold_count, 
    is_featured, 
    is_new, 
    is_organic
) VALUES

('Green Apples', 1, 1, 'green_apples.png', 8.99, 4.99, 120, '1 kg', 'Green', 'Fruit', 'Rich in vitamins\nLow in calories\nGreat for baking\nGood for digestive health', 'Fresh and juicy green apples rich in vitamins and minerals. Perfect for snacking or baking delicious apple pies.', 'Organic, Fresh, Fruit', 350, TRUE, FALSE, TRUE),
('Red Apples', 1, 1, 'red_apples.png', 7.99, 3.99, 150, '1 kg', 'Red', 'Fruit', 'High in antioxidants\nSweet flavor\nRich in vitamin C\nHelps with weight loss', 'Sweet and crisp red apples packed with nutrients and antioxidants. A perfect healthy snack for any time of day.', 'Organic, Fresh, Fruit', 450, FALSE, FALSE, TRUE),
('Fresh Bananas', 1, 4, 'fresh_bananas.png', 4.49, 2.49, 200, '1 kg', 'Yellow', 'Fruit', 'Rich in potassium\nNatural energy source\nAids digestion\nImproves heart health', 'Perfectly ripened yellow bananas. Great source of potassium and natural energy. Ideal for breakfast or as a quick snack.', 'Fresh, Fruit', 680, FALSE, FALSE, FALSE),
('Valencia Oranges', 1, 1, 'valencia_oranges.png', 6.99, 4.29, 180, '1 kg', 'Orange', 'Fruit', 'High in vitamin C\nBoosts immune system\nAntioxidant properties\nLow in calories', 'Juicy, sweet Valencia oranges with high vitamin C content. Perfect for fresh juice or as a healthy snack.', 'Organic, Fresh, Fruit', 320, TRUE, FALSE, TRUE),
('Seedless Green Grapes', 1, 4, 'seedless_green_grapes.png', 8.99, 5.99, 100, '500 g', 'Green', 'Fruit', 'Seedless variety\nNaturally sweet\nLow in calories\nRich in antioxidants', 'Sweet and juicy seedless green grapes. Perfect for snacking, adding to salads, or freezing for a refreshing treat.', 'Fresh, Fruit', 250, FALSE, TRUE, FALSE),
('New Zealand Kiwi', 1, 3, 'new_zealand_kiwi.png', 9.99, 6.49, 90, '500 g', 'Brown/Green', 'Fruit', 'High in vitamin C\nRich in dietary fiber\nLow in calories\nAids digestion', 'Premium New Zealand kiwi fruits. Rich in vitamin C and dietary fiber. Delicious eaten on its own or added to fruit salads.', 'Fresh, Imported, Premium', 180, FALSE, TRUE, FALSE),
('Fresh Pineapple', 1, 4, 'fresh_pineapple.png', 7.99, 4.99, 70, '1 unit', 'Yellow', 'Fruit', 'Sweet and tangy flavor\nRich in vitamins\nAnti-inflammatory properties\nDigestive enzymes', 'Sweet and tangy fresh pineapple. Rich in vitamins and digestive enzymes. Great for desserts, smoothies, or eating fresh.', 'Fresh, Fruit, Tropical', 210, FALSE, FALSE, FALSE),
('Ripe Mangoes', 1, 3, 'ripe_mangoes.png', 12.99, 7.99, 80, '1 kg', 'Yellow/Orange', 'Fruit', 'Sweet aromatic flavor\nRich in vitamins A and C\nAntioxidant properties\nBoosts immunity', 'Sweet and aromatic ripe mangoes. Rich in vitamins A and C. Perfect for eating fresh, in smoothies, or desserts.', 'Fresh, Tropical, Seasonal', 290, TRUE, TRUE, FALSE),
('Local Strawberries', 1, 1, 'local_strawberries.png', 5.99, 3.99, 120, '250 g', 'Red', 'Fruit', 'Locally grown\nSweet and juicy\nRich in antioxidants\nHigh in vitamin C', 'Sweet and juicy locally grown strawberries. Perfect for desserts, smoothies, or enjoying on their own.', 'Organic, Local, Fresh, Seasonal', 380, TRUE, TRUE, TRUE),
('Blueberries', 1, 1, 'blueberries.png', 9.99, 6.99, 100, '250 g', 'Blue', 'Fruit', 'Superfood\nHigh in antioxidants\nImproves brain function\nAnti-aging properties', 'Fresh blueberries packed with antioxidants. Known for their brain health benefits and anti-aging properties.', 'Organic, Fresh, Superfood', 240, FALSE, FALSE, TRUE),
('Sweet Peaches', 1, 4, 'sweet_peaches.png', 6.99, 4.79, 90, '500 g', 'Yellow/Orange', 'Fruit', 'Sweet and juicy\nRich in vitamins\nDietary fiber\nLow in calories', 'Sweet and juicy peaches rich in vitamins and dietary fiber. Perfect for snacking, baking, or adding to salads.', 'Fresh, Seasonal, Fruit', 180, FALSE, TRUE, FALSE),
('Fresh Pears', 1, 4, 'fresh_pears.png', 5.99, 3.89, 110, '500 g', 'Green/Yellow', 'Fruit', 'Smooth and sweet\nDietary fiber\nHypoallergenic\nHydrating fruit', 'Sweet and juicy pears. Rich in dietary fiber and hypoallergenic. Great for snacking or adding to salads.', 'Fresh, Fruit', 170, FALSE, FALSE, FALSE),
('Pomegranate', 1, 3, 'pomegranate.png', 7.99, 5.49, 60, '1 unit', 'Red', 'Fruit', 'Superfood\nRich in antioxidants\nAnti-inflammatory\nImproves heart health', 'Juicy pomegranate filled with antioxidant-rich seeds. Known for its heart health benefits and delicious flavor.', 'Fresh, Superfood, Seasonal', 150, TRUE, FALSE, FALSE),
('Seasonal Figs', 1, 1, 'seasonal_figs.png', 12.99, 8.99, 50, '500 g', 'Purple', 'Fruit', 'Seasonal delicacy\nRich in minerals\nNatural sweetness\nDietary fiber', 'Sweet and tender seasonal figs. Rich in minerals and dietary fiber. Perfect for desserts or paired with cheese.', 'Organic, Seasonal, Premium', 120, FALSE, TRUE, TRUE),
('Hass Avocados', 1, 3, 'hass_avocados.png', 9.99, 6.99, 100, '500 g', 'Green/Black', 'Fruit', 'Healthy fats\nRich in potassium\nHigh in fiber\nVersatile use', 'Creamy Hass avocados rich in healthy fats. Perfect for guacamole, toast toppings, or adding to salads.', 'Fresh, Superfood', 310, TRUE, FALSE, FALSE),
('Fresh Lemons', 1, 4, 'fresh_lemons.png', 4.99, 2.99, 150, '500 g', 'Yellow', 'Fruit', 'Tangy flavor\nRich in vitamin C\nDetoxifying properties\nVersatile in cooking', 'Fresh tangy lemons rich in vitamin C. Perfect for cooking, baking, making lemonade, or adding to water.', 'Fresh, Citrus', 230, FALSE, FALSE, FALSE),
('Watermelon', 1, 4, 'watermelon.png', 8.99, 5.99, 40, '1 unit', 'Green/Red', 'Fruit', 'Sweet and refreshing\nHydrating fruit\nLow in calories\nRich in lycopene', 'Sweet and refreshing watermelon. Hydrating and perfect for hot summer days. Great for snacking or in fruit salads.', 'Fresh, Seasonal, Fruit', 180, TRUE, TRUE, FALSE),
('Fresh Guava', 1, 3, 'fresh_guava.png', 6.99, 4.49, 80, '500 g', 'Green', 'Fruit', 'Tropical fruit\nVitamin C rich\nSweet aroma\nDietary fiber', 'Aromatic fresh guava with sweet flesh. Rich in vitamin C and dietary fiber. Perfect for eating fresh or in smoothies.', 'Fresh, Tropical, Fruit', 140, FALSE, TRUE, FALSE),
-- /////////////////////////////////////
('Potatoes', 2, 4, 'potatoes.png', 5.99, 3.99, 200, '1 kg', 'Brown', 'Root Vegetable', 'Versatile cooking use\nRich in potassium\nGood source of vitamin C\nStaple food', 'Fresh farm potatoes perfect for roasting, mashing, or frying. A versatile kitchen staple rich in nutrients.', 'Fresh, Vegetable', 420, FALSE, FALSE, FALSE),
('Chinese Cabbage', 2, 1, 'chinese_cabbage.png', 7.99, 4.99, 90, '1 unit', 'Green/White', 'Leafy Vegetable', 'Mild flavor\nLow in calories\nRich in vitamins\nVersatile in cooking', 'Crisp and mild flavored Chinese cabbage. Perfect for stir-fries, soups, or as a salad base.', 'Organic, Fresh, Vegetable', 160, FALSE, FALSE, TRUE),
('Golden Corn', 2, 4, 'golden_corn.png', 6.99, 3.99, 120, '500 g', 'Yellow', 'Vegetable', 'Sweet and juicy\nSource of fiber\nRich in vitamins\nVersatile cooking options', 'Sweet and juicy golden corn. Perfect for grilling, boiling, or adding to salads and soups.', 'Fresh, Vegetable, Seasonal', 250, FALSE, TRUE, FALSE),
('Eggplant', 2, 1, 'eggplant.png', 6.99, 4.99, 100, '500 g', 'Purple', 'Vegetable', 'Meaty texture\nLow in calories\nHigh in antioxidants\nVersatile in cooking', 'Glossy purple eggplants with meaty texture. Perfect for roasting, grilling, or in Mediterranean dishes.', 'Organic, Fresh, Vegetable', 170, FALSE, FALSE, TRUE),
('Fresh Cauliflower', 2, 1, 'fresh_cauliflower.png', 7.99, 5.99, 80, '1 unit', 'White', 'Cruciferous Vegetable', 'Low in calories\nHigh in fiber\nRich in vitamins\nVersatile cooking options', 'Fresh and crisp white cauliflower. Great for roasting, steaming, or making cauliflower rice.', 'Organic, Fresh, Vegetable', 190, FALSE, FALSE, TRUE),
('Green Bell Pepper', 2, 1, 'green_bell_pepper.png', 5.99, 3.99, 120, '500 g', 'Green', 'Vegetable', 'Crisp texture\nMild flavor\nRich in vitamin C\nVersatile in recipes', 'Crisp green bell peppers. Perfect for salads, stir-fries, stuffing, or eating raw with dips.', 'Organic, Fresh, Vegetable', 230, FALSE, FALSE, TRUE),
('Green Chili', 2, 4, 'green_chili.png', 4.99, 2.99, 100, '250 g', 'Green', 'Pepper', 'Medium heat\nFresh flavor\nRich in vitamins\nVersatile in cooking', 'Fresh green chilies with medium heat. Perfect for adding spice to curries, soups, or sauces.', 'Fresh, Vegetable', 180, FALSE, FALSE, FALSE),
('Green Cucumber', 2, 1, 'green_cucumber.png', 5.99, 3.99, 150, '500 g', 'Green', 'Vegetable', 'Hydrating vegetable\nCrisp texture\nRefreshing flavor\nLow in calories', 'Crisp and refreshing green cucumbers. Perfect for salads, sandwiches, or infused water.', 'Organic, Fresh, Vegetable', 290, FALSE, FALSE, TRUE),
('Green Lettuce', 2, 1, 'green_lettuce.png', 5.99, 3.99, 100, '1 unit', 'Green', 'Leafy Vegetable', 'Crisp texture\nLow in calories\nRich in vitamins\nPerfect for salads', 'Fresh and crisp green lettuce. Perfect base for salads or as a sandwich garnish.', 'Organic, Fresh, Vegetable', 240, FALSE, FALSE, TRUE),
('Green Onion', 2, 4, 'green_onion.png', 3.99, 1.99, 150, '100 g', 'Green/White', 'Herb', 'Mild onion flavor\nVersatile herb\nRich in vitamins\nPerfect garnish', 'Fresh green onions with mild flavor. Perfect for garnishing soups, salads, and Asian dishes.', 'Fresh, Herb', 220, FALSE, FALSE, FALSE),
('Sweet Capsicum', 2, 1, 'sweet_capsicum.png', 6.99, 4.99, 100, '500 g', 'Red/Yellow', 'Vegetable', 'Sweet flavor\nCrisp texture\nRich in vitamins\nColorful addition', 'Sweet and colorful capsicum mix. Perfect for salads, stir-fries, or roasting.', 'Organic, Fresh, Vegetable', 210, FALSE, FALSE, TRUE),
('Red Chili', 2, 4, 'red_chili.png', 5.99, 3.99, 90, '250 g', 'Red', 'Pepper', 'Hot and spicy\nRich in capsaicin\nBright color\nFlavor enhancer', 'Hot red chilies perfect for adding heat to your dishes. Use in curries, sauces, or make homemade chili oil.', 'Fresh, Vegetable', 160, FALSE, FALSE, FALSE),
('Red Tomato', 2, 1, 'red_tomato.png', 5.99, 3.99, 150, '500 g', 'Red', 'Vegetable', 'Sweet and tangy\nVersatile in cooking\nRich in lycopene\nEssential ingredient', 'Ripe and juicy red tomatoes. Perfect for salads, sandwiches, sauces, or cooking.', 'Organic, Fresh, Vegetable', 380, TRUE, FALSE, TRUE),
('Fresh Mango', 2, 3, 'fresh_mango.png', 8.99, 5.99, 100, '500 g', 'Yellow/Green', 'Fruit', 'Sweet tropical flavor\nJuicy texture\nRich in vitamins\nVersatile use', 'Sweet and juicy fresh mangoes. Perfect for desserts, smoothies, or enjoying fresh.', 'Fresh, Tropical, Fruit', 320, TRUE, TRUE, FALSE),
-- ////////////////////////////////////
('Extra Virgin Olive Oil', 3, 5, 'extra_virgin_olive_oil.png', 18.99, 12.99, 50, '500 ml', 'Golden', 'Oil', 'Cold pressed\nRich flavor\nHigh in antioxidants\nHealthy cooking oil', 'Premium cold-pressed extra virgin olive oil. Perfect for cooking, dressings, or as a bread dip.', 'Organic, Premium, Cooking', 180, TRUE, FALSE, TRUE),
('Natural Tomato Sauce', 3, 5, 'natural_tomato_sauce.png', 5.99, 3.99, 100, '500 g', 'Red', 'Sauce', 'No artificial additives\nMade from fresh tomatoes\nVersatile cooking ingredient\nRich flavor', 'Natural tomato sauce made from fresh tomatoes with no artificial additives. Perfect base for pasta sauces and stews.', 'Organic, Natural, Cooking', 240, FALSE, FALSE, TRUE),
('Basmati Rice', 3, 2, 'basmati_rice.png', 12.99, 9.99, 80, '1 kg', 'White', 'Grain', 'Premium quality\nLong grain\nAromatic\nFluffy texture', 'Premium long-grain basmati rice with aromatic flavor. Perfect for pilafs, biryani, or as a side dish.', 'Premium, Cooking', 210, FALSE, FALSE, FALSE),
('Mixed Spices', 3, 5, 'mixed_spices.png', 9.99, 7.49, 70, '100 g', 'Mixed', 'Spice', 'Aromatic blend\nEnhances flavor\nNo artificial additives\nVersatile use', 'Aromatic blend of mixed spices. Perfect for enhancing flavor in a variety of dishes.', 'Organic, Premium, Cooking', 150, FALSE, FALSE, TRUE),
('Organic Apple Cider Vinegar', 3, 5, 'organic_apple_cider_vinegar.png', 8.99, 5.99, 60, '500 ml', 'Amber', 'Vinegar', 'Raw and unfiltered\nWith the mother\nVersatile use\nHealth benefits', 'Raw and unfiltered organic apple cider vinegar with the mother. Perfect for dressings, marinades, or health remedies.', 'Organic, Natural, Cooking', 190, TRUE, FALSE, TRUE),
('Tomato Paste', 3, 2, 'tomato_paste.png', 3.99, 2.49, 120, '200 g', 'Red', 'Paste', 'Concentrated flavor\nVersatile cooking ingredient\nLong shelf life\nEssential pantry item', 'Concentrated tomato paste perfect for adding rich tomato flavor to sauces, soups, and stews.', 'Cooking, Essential', 220, FALSE, FALSE, FALSE),
('Pink Himalayan Salt', 3, 5, 'pink_himalayan_salt.png', 9.99, 6.99, 90, '250 g', 'Pink', 'Salt', 'Natural mineral content\nDelicate flavor\nNo additives\nPremium quality', 'Natural pink Himalayan salt with rich mineral content. Perfect for cooking or as a finishing salt.', 'Premium, Natural, Cooking', 170, TRUE, FALSE, FALSE),
-- ///////////////////////////////////
('Natural Mixed Nuts', 4, 1, 'natural_mixed_nuts.png', 8.99, 6.99, 120, '250 g', 'Mixed', 'Nuts', 'Protein rich\nHealthy fats\nNo added salt\nEnergy boosting', 'Premium blend of natural mixed nuts with no added salt. Rich in protein and healthy fats. Perfect healthy snack.', 'Natural, Protein, Healthy Snack', 260, TRUE, FALSE, TRUE),
('Organic Vegetable Chips', 4, 1, 'organic_vegetable_chips.png', 4.99, 3.79, 150, '150 g', 'Mixed', 'Chips', 'Made from vegetables\nLow in salt\nNo artificial colors\nBaked not fried', 'Crispy organic vegetable chips made from real vegetables. Baked not fried for a healthier snacking option.', 'Organic, Healthy Snack, Natural', 230, FALSE, FALSE, TRUE),
('Oatmeal Cookies', 4, 2, 'oatmeal_cookies.png', 3.99, 2.99, 180, '200 g', 'Brown', 'Cookies', 'Made with whole oats\nLow in sugar\nFiber rich\nWholesome ingredients', 'Delicious oatmeal cookies made with whole oats and wholesome ingredients. Lower in sugar than regular cookies.', 'Healthy Snack, Wholesome', 290, FALSE, FALSE, FALSE),
('Dried Dates', 4, 3, 'dried_dates.png', 6.49, 4.99, 100, '250 g', 'Brown', 'Dried Fruit', 'Natural sweetness\nFiber rich\nEnergy boosting\nNo added sugar', 'Premium dried dates with natural sweetness. Rich in fiber and energy-boosting. Perfect healthy alternative to candy.', 'Natural, Healthy Snack, Energy', 210, TRUE, FALSE, FALSE),
('Natural Raisins', 4, 1, 'natural_raisins.png', 3.99, 2.99, 150, '250 g', 'Brown', 'Dried Fruit', 'No added sugar\nRich in antioxidants\nIron source\nNaturally sweet', 'Sweet natural raisins with no added sugar. Rich in antioxidants and iron. Great for snacking or baking.', 'Natural, Healthy Snack', 180, FALSE, FALSE, TRUE),
('Organic Dark Chocolate', 4, 1, 'organic_dark_chocolate.png', 5.49, 4.29, 120, '100 g', 'Brown', 'Chocolate', '70% cacao\nAntioxidant rich\nLow in sugar\nOrganic ingredients', 'Premium organic dark chocolate with 70% cacao. Rich in antioxidants with less sugar than milk chocolate.', 'Organic, Premium, Healthy Snack', 250, FALSE, FALSE, TRUE),
('Microwave Popcorn', 4, 2, 'microwave_popcorn.png', 2.99, 1.99, 200, '300 g', 'Yellow', 'Popcorn', 'Whole grain\nLow in fat\nHigh in fiber\nConvenient snack', 'Convenient microwave popcorn made from whole grain kernels. Low in fat and high in fiber for a healthier snack option.', 'Convenient, Healthy Snack', 310, FALSE, FALSE, FALSE),
('Rice Cakes', 4, 2, 'rice_cakes.png', 3.49, 2.79, 180, '150 g', 'White', 'Snack', 'Gluten free\nLow in calories\nLight texture\nVersatile snack', 'Light and crispy rice cakes. Gluten-free and low in calories. Perfect base for healthy toppings or enjoyed plain.', 'Gluten-Free, Healthy Snack', 220, FALSE, FALSE, FALSE),
('Mixed Dried Fruits', 4, 3, 'mixed_dried_fruits.png', 7.99, 5.99, 90, '300 g', 'Mixed', 'Dried Fruit', 'Variety of fruits\nNo added sugar\nRich in nutrients\nConvenient snack', 'Colorful mix of premium dried fruits with no added sugar. Rich in nutrients and fiber for a healthy, convenient snack.', 'Natural, Healthy Snack', 170, TRUE, FALSE, FALSE),
-- ////////////////////////////////////
('Organic Green Tea', 5, 1, 'organic_green_tea.png', 6.99, 5.49, 100, '50 g', 'Green', 'Tea', 'Antioxidant rich\nMetabolism boosting\nCalming effects\nDelicate flavor', 'Premium organic green tea leaves rich in antioxidants. Known for metabolism-boosting and calming properties.', 'Organic, Healthy Beverage, Antioxidants', 230, TRUE, FALSE, TRUE),
('Freshly Ground Coffee', 5, 3, 'freshly_ground_coffee.png', 9.99, 7.99, 120, '250 g', 'Brown', 'Coffee', 'Freshly ground\nRich aroma\nBold flavor\nArabica beans', 'Premium freshly ground coffee with rich aroma and bold flavor. Made from 100% Arabica beans.', 'Premium, Fresh, Beverage', 290, TRUE, FALSE, FALSE),
('Natural Orange Juice', 5, 2, 'natural_orange_juice.png', 4.99, 3.79, 150, '1 L', 'Orange', 'Juice', 'No added sugar\n100% fruit juice\nRich in vitamin C\nRefreshing taste', 'Refreshing natural orange juice with no added sugar. 100% fruit juice rich in vitamin C.', 'Natural, No Added Sugar, Beverage', 320, FALSE, FALSE, FALSE),
('Coconut Water', 5, 3, 'coconut_water.png', 3.99, 2.99, 180, '500 ml', 'Clear', 'Water', 'Natural electrolytes\nHydrating drink\nLow in calories\nRefreshing taste', 'Natural coconut water rich in electrolytes. Low in calories and perfect for hydration after exercise.', 'Natural, Hydrating, Beverage', 280, FALSE, FALSE, FALSE),
('Mixed Herbal Tea', 5, 1, 'mixed_herbal_tea.png', 7.49, 5.99, 90, '50 g', 'Mixed', 'Tea', 'Caffeine free\nCalming blend\nAromatic flavor\nDigestive benefits', 'Soothing blend of mixed herbal teas. Caffeine-free with aromatic flavor and digestive benefits.', 'Natural, Caffeine-Free, Beverage', 190, FALSE, FALSE, TRUE),
('Natural Apple Juice', 5, 2, 'natural_apple_juice.png', 4.49, 3.49, 140, '1 L', 'Yellow', 'Juice', 'No added sugar\n100% fruit juice\nRefreshing flavor\nRich in nutrients', 'Crisp natural apple juice with no added sugar. 100% fruit juice packed with refreshing flavor.', 'Natural, No Added Sugar, Beverage', 260, FALSE, FALSE, FALSE),
-- //////////////////////////////////
('Whole Grain Bread', 6, 2, 'whole_grain_bread.png', 3.99, 2.99, 150, '500 g', 'Brown', 'Bread', 'Whole grains\nHigh in fiber\nNutrient rich\nHearty flavor', 'Nutritious whole grain bread made with 100% whole grains. High in fiber with hearty flavor.', 'Wholesome, Fresh Baked, Fiber', 290, FALSE, FALSE, FALSE),
('Wheat Bread', 6, 2, 'wheat_bread.png', 3.49, 2.69, 180, '500 g', 'Light Brown', 'Bread', 'Made with wheat flour\nSoft texture\nLightly sweet\nVersatile staple', 'Soft wheat bread with light, fluffy texture. Perfect for sandwiches or toast.', 'Fresh Baked, Staple', 320, FALSE, FALSE, FALSE),
('Fresh Croissants', 6, 3, 'fresh_croissants.png', 5.99, 4.49, 100, '4 units', 'Golden', 'Pastry', 'Flaky layers\nButtery flavor\nFreshly baked\nPerfect breakfast', 'Light, flaky croissants with buttery flavor. Freshly baked daily for the perfect breakfast or snack.', 'Fresh Baked, Premium, Breakfast', 260, TRUE, TRUE, FALSE),
('Olive Bread', 6, 1, 'olive_bread.png', 4.99, 3.79, 80, '400 g', 'Brown', 'Bread', 'Real olive pieces\nMediterranean flavor\nArtisanal recipe\nUnique taste', 'Flavorful artisanal olive bread with real olive pieces. Unique Mediterranean flavor.', 'Fresh Baked, Mediterranean, Specialty', 170, FALSE, FALSE, FALSE),
('Cranberry Muffins', 6, 3, 'cranberry_muffins.png', 6.49, 4.99, 90, '6 units', 'Red/Brown', 'Muffin', 'Real cranberries\nLightly sweet\nSoft texture\nPerfect snack', 'Soft, moist cranberry muffins with real cranberries. Lightly sweet and perfect for breakfast or snack.', 'Fresh Baked, Breakfast', 210, FALSE, TRUE, FALSE),
('Banana Cake', 6, 3, 'banana_cake.png', 8.99, 6.99, 60, '1 unit', 'Golden Brown', 'Cake', 'Real banana flavor\nMoist texture\nNatural sweetness\nHomestyle recipe', 'Moist banana cake made with real bananas. Natural sweetness and homestyle flavor.', 'Fresh Baked, Dessert', 150, TRUE, FALSE, FALSE),
('Zaatar Bread', 6, 1, 'zaatar_bread.png', 4.49, 3.49, 110, '2 units', 'Green/Brown', 'Flatbread', 'Traditional herb blend\nMiddle Eastern style\nFlavor packed\nVersatile bread', 'Traditional Middle Eastern flatbread topped with zaatar herb blend. Packed with flavor.', 'Fresh Baked, Middle Eastern, Specialty', 190, FALSE, FALSE, FALSE),
('Brown Pita', 6, 2, 'brown_pita.png', 3.29, 2.49, 140, '6 units', 'Brown', 'Flatbread', 'Whole wheat\nSoft pocket\nPerfect for filling\nHealthy alternative', 'Soft whole wheat pita bread with perfect pockets for filling. Healthier alternative to white pita.', 'Fresh Baked, Middle Eastern', 230, FALSE, FALSE, FALSE),
('French Baguette', 6, 3, 'french_baguette.png', 2.99, 1.99, 120, '1 unit', 'Golden', 'Bread', 'Crispy crust\nSoft interior\nTraditional recipe\nFreshly baked', 'Traditional French baguette with crispy crust and soft interior. Freshly baked daily.', 'Fresh Baked, European', 280, FALSE, FALSE, FALSE),
('Oat Bread', 6, 1, 'oat_bread.png', 4.79, 3.79, 90, '500 g', 'Brown', 'Bread', 'High in fiber\nWhole oats\nNutrient dense\nHearty texture', 'Hearty oat bread packed with whole oats and fiber. Nutritious and satisfying.', 'Wholesome, Fresh Baked, Fiber', 160, FALSE, FALSE, TRUE),
('Flaxseed Bread', 6, 1, 'flaxseed_bread.png', 5.49, 4.29, 70, '450 g', 'Dark Brown', 'Bread', 'Omega-3 rich\nNutty flavor\nLow carb\nDense texture', 'Nutritious flaxseed bread rich in omega-3s. Low-carb with satisfying nutty flavor.', 'Wholesome, Fresh Baked, Specialty', 130, FALSE, FALSE, TRUE),
('Apple Pies', 6, 3, 'apple_pies.png', 7.99, 5.99, 50, '2 units', 'Golden Brown', 'Pie', 'Real apple filling\nFlaky crust\nCinnamon spiced\nClassic dessert', 'Delicious apple pies with flaky crust and cinnamon-spiced real apple filling. Perfect classic dessert.', 'Fresh Baked, Dessert', 180, TRUE, TRUE, FALSE),
-- /////////////////////////////////
('Natural Herbal Shampoo', 7, 1, 'natural_herbal_shampoo.png', 8.99, 6.99, 80, '250 ml', 'Green', 'Hair Care', 'Plant based\nSulfate free\nGently cleansing\nNourishing herbs', 'Natural herbal shampoo with plant-based ingredients. Sulfate-free and gently cleansing with nourishing herbs.', 'Natural, Personal Care, Hair', 190, FALSE, FALSE, TRUE),
('Argan Oil Conditioner', 7, 1, 'argan_oil_conditioner.png', 9.49, 7.49, 70, '250 ml', 'Gold', 'Hair Care', 'Rich in argan oil\nDeep conditioning\nFrizz control\nStrengthen hair', 'Rich conditioner with pure argan oil. Deeply conditions and controls frizz while strengthening hair.', 'Natural, Personal Care, Hair', 170, FALSE, FALSE, TRUE),
('Natural Honey Soap', 7, 1, 'natural_honey_soap.png', 4.99, 3.79, 120, '100 g', 'Yellow', 'Soap', 'Made with real honey\nMoisturizing effect\nGentle cleansing\nNatural scent', 'Gentle cleansing soap made with real honey. Moisturizing effect with natural sweet scent.', 'Natural, Personal Care, Skin', 220, TRUE, FALSE, TRUE),
('Aloe Vera Moisturizer', 7, 3, 'aloe_vera_moisturizer.png', 12.99, 9.99, 60, '200 ml', 'Green', 'Skin Care', 'Rich in aloe vera\nDeep hydration\nSoothing effect\nNon-greasy formula', 'Soothing moisturizer rich in aloe vera. Provides deep hydration with non-greasy formula.', 'Natural, Personal Care, Skin', 150, FALSE, FALSE, FALSE),
('Organic Coconut Oil', 7, 1, 'organic_coconut_oil.png', 7.99, 5.99, 90, '200 ml', 'White', 'Multi-purpose', 'Cold pressed\nMulti-purpose\nSkin and hair care\nNatural moisturizer', 'Versatile organic cold-pressed coconut oil. Perfect for skin, hair, or cooking use.', 'Organic, Personal Care, Multi-use', 210, TRUE, FALSE, TRUE),
('Coffee Face Scrub', 7, 3, 'coffee_face_scrub.png', 10.49, 8.49, 50, '100 g', 'Brown', 'Skin Care', 'Natural exfoliant\nAntioxidant rich\nImproves circulation\nRefreshing effect', 'Invigorating face scrub made with real coffee. Natural exfoliant rich in antioxidants.', 'Natural, Personal Care, Skin', 120, FALSE, TRUE, FALSE),
('Natural Deodorant', 7, 1, 'natural_deodorant.png', 5.99, 4.79, 100, '50 g', 'White', 'Deodorant', 'Aluminum free\nPlant based\nLong lasting\nGentle on skin', 'Effective natural deodorant without aluminum. Plant-based formula gentle on sensitive skin.', 'Natural, Personal Care, Aluminum-Free', 180, FALSE, FALSE, TRUE),
('Green Tea Face Wash', 7, 3, 'green_tea_face_wash.png', 8.49, 6.49, 80, '150 ml', 'Green', 'Skin Care', 'Antioxidant rich\nGentle cleansing\nRefreshing effect\nBalances skin', 'Refreshing face wash infused with green tea antioxidants. Gently cleanses while balancing skin.', 'Natural, Personal Care, Skin', 160, FALSE, FALSE, FALSE),
('Vegan Toothpaste', 7, 1, 'vegan_toothpaste.png', 7.49, 5.99, 110, '100 g', 'White', 'Oral Care', 'Plant based\nFluoride free\nNatural mint flavor\nGentle whitening', 'Plant-based vegan toothpaste without fluoride. Natural mint flavor with gentle whitening properties.', 'Vegan, Personal Care, Natural', 200, FALSE, FALSE, TRUE),
('Natural Sunscreen', 7, 3, 'natural_sunscreen.png', 14.99, 11.99, 60, '150 ml', 'White', 'Sun Care', 'Mineral based\nBroad spectrum\nReef safe\nWater resistant', 'Natural mineral-based sunscreen with broad-spectrum protection. Reef-safe and water-resistant formula.', 'Natural, Personal Care, Outdoor', 130, TRUE, FALSE, FALSE),
('Lavender Essential Oil', 7, 1, 'lavender_essential_oil.png', 11.99, 9.49, 70, '30 ml', 'Purple', 'Essential Oil', 'Pure lavender\nSoothing aroma\nCalming effect\nMultiple uses', 'Pure lavender essential oil with soothing aroma. Perfect for aromatherapy or adding to personal care products.', 'Natural, Aromatherapy, Wellness', 140, FALSE, FALSE, TRUE);