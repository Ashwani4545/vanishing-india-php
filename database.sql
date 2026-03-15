-- Vanishing India Database Schema
-- Run this file to set up the database

CREATE DATABASE IF NOT EXISTS vanishing_india CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE vanishing_india;

-- Cultures / Traditions table
CREATE TABLE IF NOT EXISTS traditions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    region VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    category ENUM('folk_arts','festivals','rituals','music','crafts','dance') NOT NULL,
    short_desc TEXT,
    full_desc LONGTEXT,
    image_url VARCHAR(500),
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Festival Calendar
CREATE TABLE IF NOT EXISTS festivals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    month INT NOT NULL,
    description TEXT,
    image_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Community Stories
CREATE TABLE IF NOT EXISTS stories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author_name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    tradition_id INT,
    approved TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tradition_id) REFERENCES traditions(id) ON DELETE SET NULL
);

-- Contributions / Contact
CREATE TABLE IF NOT EXISTS contributions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Newsletter subscriptions
CREATE TABLE IF NOT EXISTS newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Seed data - Traditions
INSERT INTO traditions (title, region, state, category, short_desc, full_desc, image_url, is_featured) VALUES
('Kathputli Puppetry', 'Rajasthan', 'Rajasthan', 'folk_arts', 'The Dying Art of Rajasthan', 'Kathputli is a string puppet tradition of Rajasthan, India, and is the most popular form of traditional puppetry in India. The puppeteers, known as Nat, are itinerant performers who travel from village to village with their colourful puppets made of mango wood. The art form is recognised by UNESCO as an intangible cultural heritage.', 'assets/images/kathputli.jpg', 1),
('Sacred Rituals', 'Himachal Pradesh', 'Himachal Pradesh', 'rituals', 'Ancient Pooja of the Himalayas', 'The sacred rituals of the Himalayan region are deeply rooted in the ancient Vedic tradition and local folk beliefs. These ceremonies involve elaborate preparations, sacred fire rituals (yagnas), and offerings to mountain deities. The priests who perform these rituals carry generations of oral knowledge passed down through families.', 'assets/images/sacred-rituals.jpg', 1),
('Chhath Puja', 'Bihar', 'Bihar', 'festivals', 'The Sun Worship Festival', 'Chhath Puja is an ancient Hindu festival dedicated to the Sun God (Surya) and his wife Usha. It is celebrated with great fervor in Bihar, Jharkhand, and parts of Uttar Pradesh. Devotees stand in rivers at sunrise and sunset offering prayers and arghya to the Sun. The festival spans four days and involves rigorous fasting and rituals.', 'assets/images/chhath-puja.jpg', 1),
('Yakshagana', 'Karnataka', 'Karnataka', 'dance', 'Traditional Theatre of Karnataka', 'Yakshagana is a traditional theatre form that combines dance, music, dialogue, costume, makeup, and stage techniques with a unique style and form. This art form is native to the Tulu Nadu region and some parts of Kerala. It is performed at night and can last till dawn.', 'assets/images/yakshagana.jpg', 0),
('Gond Art', 'Madhya Pradesh', 'Madhya Pradesh', 'folk_arts', 'Tribal Art of Central India', 'Gond art is a form of painting from folk and tribal art that is practiced by one of the largest tribes in India. The Gond are a Dravidian people living in the forests of central India. The Gond artists use colorful representations of the forests and natural elements.', 'assets/images/gond-art.jpg', 0),
('Bihu Dance', 'Assam', 'Assam', 'dance', 'Harvest Festival Dance', 'Bihu dance is a folk dance from Assam performed during the Bihu festival. It is a very lively dance form and holds special significance in Assamese culture. The dance is performed in groups, and the dancers wear traditional Assamese attire.', 'assets/images/bihu.jpg', 0),
('Kalbelia Dance', 'Rajasthan', 'Rajasthan', 'dance', 'Snake Charmer Folk Dance', 'Kalbelia is a folk song and dance from the Kalbelia community of Rajasthan. The Kalbelia are a nomadic tribe known as snake charmers. The dance movements and the costumes resemble that of a serpent. UNESCO recognized it as Intangible Cultural Heritage.', 'assets/images/kalbelia.jpg', 0),
('Theyyam', 'Kerala', 'Kerala', 'rituals', 'Ritual Art Form of Kerala', 'Theyyam is a ritual dance form from the northern part of Kerala. In this ritual, the performer is considered to have become the deity itself. The costume, elaborate and colorful, with tall head-dresses and intricate body paint, is an important aspect of the performance.', 'assets/images/theyyam.jpg', 0);

-- Seed data - Festivals
INSERT INTO festivals (name, state, month, description) VALUES
('Pushkar Camel Fair', 'Rajasthan', 11, 'One of the world''s largest camel fairs with cultural events'),
('Hornbill Festival', 'Nagaland', 12, 'Festival of festivals celebrating Naga heritage'),
('Rann Utsav', 'Gujarat', 1, 'Cultural festival in the white salt desert'),
('Thrissur Pooram', 'Kerala', 4, 'Grand elephant procession and fireworks display'),
('Hemis Festival', 'Ladakh', 6, 'Colorful mask dance festival at Hemis Monastery'),
('Onam', 'Kerala', 8, 'Harvest festival with boat races and floral carpets'),
('Diwali Mela', 'Multiple States', 10, 'Festival of lights celebrated across India'),
('Navratri', 'Gujarat', 9, 'Nine nights of Garba dance and celebration');

-- Seed data - Approved Stories
INSERT INTO stories (author_name, title, content, tradition_id, approved) VALUES
('Priya Sharma', 'My Grandmother''s Puppet Stories', 'Growing up in Jaipur, I watched my grandmother bring Kathputli puppets to life every evening. Her puppets were not just toys; they were characters from the Mahabharata and local folklore...', 1, 1),
('Rajesh Kumar', 'The Last Chhath of Our Village', 'Every year, our entire village would gather at the riverbank for Chhath Puja. The sight of hundreds of devotees standing in the river at sunrise, holding offerings to the Sun God, was magical...', 3, 1),
('Anita Devi', 'Learning Sacred Himalayan Rituals', 'My father was a priest in Himachal Pradesh. From a young age, I would wake up at 4 AM to assist him in the morning prayers. The chants, the incense, the sacred fire...', 2, 1);
