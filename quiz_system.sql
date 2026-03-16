/* =========================================
   DATABASE CREATION
========================================= */

DROP DATABASE IF EXISTS quizara_db;
CREATE DATABASE quizara_db;
USE quizara_db;


/* =========================================
   TABLE: users
========================================= */

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student') NOT NULL DEFAULT 'student',
    is_blocked TINYINT(1) DEFAULT 0,
    bio TEXT DEFAULT NULL,
    profile_pic VARCHAR(255) DEFAULT NULL,
    reset_token VARCHAR(64) DEFAULT NULL,
    reset_token_expires_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Default Admin User */
INSERT INTO users (username, email, password, role, is_blocked, bio)
VALUES ('Admin', 'quizmastera524@gmail.com', '$2y$10$w6lKvOAg7VlNeKCEOD89Fux3TD/1V6pDJLIKfwJUpdWZ1jaG2HumG', 'admin', 0, 'Default Admin User!');


/* =========================================
   TABLE: categories
========================================= */

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Default Categories */
INSERT INTO categories (name, description) VALUES
('General Knowledge', 'General knowledge questions from various fields'),
('Science', 'Physics, Chemistry, Biology and Environmental Science'),
('Mathematics', 'Algebra, Geometry, and Arithmetic'),
('History', 'World History and Historical Events');


/* =========================================
   TABLE: quizzes
========================================= */

CREATE TABLE quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category_id INT,
    time_limit INT DEFAULT 0 COMMENT 'Time in minutes',
    passing_score INT DEFAULT 50 COMMENT 'Percentage',
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: questions
========================================= */

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    question_text TEXT NOT NULL,
    difficulty_level ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'low',
    question_type ENUM('multiple_choice', 'true_false') DEFAULT 'multiple_choice',
    marks INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: options
========================================= */

CREATE TABLE options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    option_text TEXT NOT NULL,
    is_correct TINYINT(1) DEFAULT 0,
    
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: quiz_attempts
========================================= */

CREATE TABLE quiz_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score INT DEFAULT 0,
    highest_mode_completed ENUM('none', 'low', 'medium', 'high') NOT NULL DEFAULT 'none',
    total_questions INT DEFAULT 0,
    correct_answers INT DEFAULT 0,
    started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completed_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: user_quiz_purchases
========================================= */

CREATE TABLE user_quiz_purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    transaction_id VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    purchased_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: user_answers
========================================= */

CREATE TABLE user_answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    attempt_id INT NOT NULL,
    question_id INT NOT NULL,
    selected_option_id INT,
    is_correct TINYINT(1) DEFAULT 0,
    
    FOREIGN KEY (attempt_id) REFERENCES quiz_attempts(id) ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (selected_option_id) REFERENCES options(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   TABLE: settings
========================================= */

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(50) UNIQUE NOT NULL,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/* Default Settings */
INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'Quizara'),
('contact_email', 'support@quizara.com'),
('site_description', 'A premium online quiz platform for elite learning.'),
('items_per_page', '10'),
('maintenance_mode', '0'),
('allow_registration', '1');


/* =========================================
   TABLE: contact_messages
========================================= */

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* =========================================
   1. QUIZZES
========================================= */

INSERT INTO quizzes (title, description, category_id, time_limit, passing_score, created_by)
VALUES
(
    'Ultimate General Knowledge',
    'Test your knowledge about the world with this general trivia quiz. Good luck!',
    1, 15, 60, 1
),
(
    'Science & Nature Explorer',
    'Dive into the wonders of the natural world and scientific discoveries.',
    2, 20, 70, 1
);


/* =========================================
   2. QUESTIONS – QUIZ 1 (Ultimate General Knowledge) - Mixed Difficulties
========================================= */

/* --- LOW --- */
INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'What is the tallest mountain in the world?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(1, 'Mount Kilimanjaro', 0),
(1, 'Mount Everest', 1),
(1, 'Mount Fuji', 0),
(1, 'K2', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'How many continents are there on Earth?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(2, '5', 0),
(2, '6', 0),
(2, '7', 1),
(2, '8', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Which ocean is off the California coast?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(3, 'Atlantic', 0),
(3, 'Indian', 0),
(3, 'Pacific', 1),
(3, 'Arctic', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'What is the national sport of Japan?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(4, 'Football', 0),
(4, 'Baseball', 0),
(4, 'Sumo Wrestling', 1),
(4, 'Kendo', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Who was the first President of the United States?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(5, 'Thomas Jefferson', 0),
(5, 'Abraham Lincoln', 0),
(5, 'George Washington', 1),
(5, 'John Adams', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'In which year did the Titanic sink?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(6, '1912', 1),
(6, '1905', 0),
(6, '1920', 0),
(6, '1898', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'The ancient pyramids were built in which country?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(7, 'Greece', 0),
(7, 'Rome', 0),
(7, 'Egypt', 1),
(7, 'Mexico', 0);

/* --- MEDIUM --- */
INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Which country produces the most coffee in the world?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(8, 'Colombia', 0),
(8, 'Brazil', 1),
(8, 'Vietnam', 0),
(8, 'Ethiopia', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Which is the longest river in the world?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(9, 'Amazon River', 0),
(9, 'Yangtze River', 0),
(9, 'Nile River', 1),
(9, 'Mississippi River', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'What is the currency of the United Kingdom?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(10, 'Euro', 0),
(10, 'Dollar', 0),
(10, 'Pound Sterling', 1),
(10, 'Franc', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Who wrote "1984"?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(11, 'Aldous Huxley', 0),
(11, 'Ray Bradbury', 0),
(11, 'George Orwell', 1),
(11, 'J.K. Rowling', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'The Great Wall of China was primarily built to protect against which empire?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(12, 'The Roman Empire', 0),
(12, 'The Mongol Empire', 1),
(12, 'The British Empire', 0),
(12, 'The Ottoman Empire', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'In what year did World War II end?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(13, '1941', 0),
(13, '1943', 0),
(13, '1945', 1),
(13, '1950', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Who was the famous Queen of Ancient Egypt known for her beauty and tragic end?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(14, 'Nefertiti', 0),
(14, 'Hatshepsut', 0),
(14, 'Cleopatra', 1),
(14, 'Isis', 0);

/* --- HIGH --- */
INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Which philosopher wrote "The Republic"?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(15, 'Aristotle', 0),
(15, 'Socrates', 0),
(15, 'Plato', 1),
(15, 'Pythagoras', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'What is the capital city of Australia?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(16, 'Sydney', 0),
(16, 'Melbourne', 0),
(16, 'Canberra', 1),
(16, 'Perth', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'In Roman mythology, who is the god of war?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(17, 'Ares', 0),
(17, 'Apollo', 0),
(17, 'Mars', 1),
(17, 'Jupiter', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Which mountain range separates Europe from Asia?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(18, 'The Alps', 0),
(18, 'The Himalayas', 0),
(18, 'The Ural Mountains', 1),
(18, 'The Andes', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Which treaty officially ended World War I?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(19, 'Treaty of Paris', 0),
(19, 'Treaty of Versailles', 1),
(19, 'Treaty of Ghent', 0),
(19, 'Treaty of Tordesillas', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'Who was the first Emperor of Rome?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(20, 'Julius Caesar', 0),
(20, 'Nero', 0),
(20, 'Augustus', 1),
(20, 'Caligula', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(1, 'The Magna Carta was signed in which year?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(21, '1066', 0),
(21, '1215', 1),
(21, '1492', 0),
(21, '1776', 0);

/* =========================================
   3. QUESTIONS – QUIZ 2 (Science & Math Explorer)
========================================= */

/* --- LOW --- */
INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the chemical symbol for Helium?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(22, 'H', 0),
(22, 'He', 1),
(22, 'Hl', 0),
(22, 'Hm', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'Which planet is closest to the sun?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(23, 'Earth', 0),
(23, 'Mars', 0),
(23, 'Venus', 0),
(23, 'Mercury', 1);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'How many legs does a spider have?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(24, '6', 0),
(24, '8', 1),
(24, '10', 0),
(24, '4', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What do plants need to undergo photosynthesis?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(25, 'Nitrogen', 0),
(25, 'Oxygen', 0),
(25, 'Sunlight and Carbon Dioxide', 1),
(25, 'Soil only', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is 12 x 12?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(26, '124', 0),
(26, '144', 1),
(26, '164', 0),
(26, '120', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'How many degrees are in a full circle?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(27, '90', 0),
(27, '180', 0),
(27, '270', 0),
(27, '360', 1);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the square root of 64?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(28, '6', 0),
(28, '7', 0),
(28, '8', 1),
(28, '9', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'Which shape has five sides?', 'low', 1);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(29, 'Hexagon', 0),
(29, 'Pentagon', 1),
(29, 'Octagon', 0),
(29, 'Decagon', 0);

/* --- MEDIUM --- */
INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the atomic number of Carbon?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(30, '5', 0),
(30, '6', 1),
(30, '7', 0),
(30, '8', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'Who proposed the theory of relativity?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(31, 'Isaac Newton', 0),
(31, 'Nikola Tesla', 0),
(31, 'Albert Einstein', 1),
(31, 'Galileo Galilei', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the hardest naturally occurring substance on Earth?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(32, 'Obsidian', 0),
(32, 'Titanium', 0),
(32, 'Tungsten', 0),
(32, 'Diamond', 1);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'Which organ in the human body produces insulin?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(33, 'Liver', 0),
(33, 'Kidney', 0),
(33, 'Pancreas', 1),
(33, 'Spleen', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'A triangle with all three sides of different lengths is called:', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(34, 'Isosceles', 0),
(34, 'Equilateral', 0),
(34, 'Scalene', 1),
(34, 'Right-angled', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the value of Pi (π) up to two decimal places?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(35, '3.12', 0),
(35, '3.14', 1),
(35, '3.16', 0),
(35, '3.18', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'Solve for x: 5x + 10 = 35', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(36, '4', 0),
(36, '5', 1),
(36, '6', 0),
(36, '7', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the area of a rectangle with length 8 and width 4?', 'medium', 3);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(37, '12', 0),
(37, '24', 0),
(37, '32', 1),
(37, '16', 0);

/* --- HIGH --- */
INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the most abundant gas in the Earth atmosphere?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(38, 'Oxygen', 0),
(38, 'Carbon Dioxide', 0),
(38, 'Nitrogen', 1),
(38, 'Argon', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the name of the phenomenon where light bends as it passes from one medium to another?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(39, 'Reflection', 0),
(39, 'Refraction', 1),
(39, 'Diffraction', 0),
(39, 'Dispersion', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'Which subatomic particle was discovered by J.J. Thomson?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(40, 'Proton', 0),
(40, 'Neutron', 0),
(40, 'Electron', 1),
(40, 'Positron', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the powerhouse of the cell?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(41, 'Golgi Apparatus', 0),
(41, 'Nucleus', 0),
(41, 'Mitochondria', 1),
(41, 'Ribosome', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the derivative of e^x with respect to x?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(42, 'x*e^(x-1)', 0),
(42, 'e^y', 0),
(42, 'e^x', 1),
(42, '1', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the sum of the interior angles of a hexagon?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(43, '360 degrees', 0),
(43, '540 degrees', 0),
(43, '720 degrees', 1),
(43, '900 degrees', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'Which sequence begins 0, 1, 1, 2, 3, 5, 8...?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(44, 'Geometric Sequence', 0),
(44, 'Fibonacci Sequence', 1),
(44, 'Arithmetic Sequence', 0),
(44, 'Prime Sequence', 0);

INSERT INTO questions (quiz_id, question_text, difficulty_level, marks) VALUES 
(2, 'What is the exact value of tan(45 degrees)?', 'high', 5);

INSERT INTO options (question_id, option_text, is_correct) VALUES
(45, '0', 0),
(45, '0.5', 0),
(45, '1', 1),
(45, 'Infinity', 0);
