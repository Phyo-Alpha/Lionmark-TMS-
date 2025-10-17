USE lionmarks_tms;

CREATE TABLE workshop_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    countryCode VARCHAR(10) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    nationality VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    qualification VARCHAR(100) DEFAULT NULL,
    englishCompetency VARCHAR(50) DEFAULT NULL,
    vaccinated ENUM('Yes', 'No') DEFAULT NULL,
    workshop VARCHAR(255) DEFAULT NULL,
    classStartDate DATE DEFAULT NULL,
    salesperson VARCHAR(100) DEFAULT NULL,
    hearAboutUs VARCHAR(100) DEFAULT NULL,
    registrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    notes TEXT DEFAULT NULL,
    INDEX idx_email (email),
    INDEX idx_phone (phone),
    INDEX idx_registration_date (registrationDate),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
