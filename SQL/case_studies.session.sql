-- Erstellen der Datenbank
CREATE DATABASE IF NOT EXISTS case_studies_db;
USE case_studies_db;

-- Tabelle für Redakteure
CREATE TABLE IF NOT EXISTS editors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Tabelle für Kunden
CREATE TABLE IF NOT EXISTS customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  logo VARCHAR(255) NOT NULL,
  status ENUM('aktiv', 'inaktiv') NOT NULL DEFAULT 'aktiv'
);

-- Tabelle für Case Studies
CREATE TABLE IF NOT EXISTS case_studies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  customer_id INT NOT NULL,
  FOREIGN KEY (customer_id) REFERENCES customers(id)
);

-- Datensätze für Redakteure
INSERT INTO editors (first_name, last_name, email, username, password) VALUES
  ('Nattapat', 'Pongsuwan', 'markungphim@gmail.com', 'Mark', '$2y$10$iI16x02CI/hdn.AeWPNVouqsvNHEfwDGvpx5b/DzkGaTi8wkmY88O');

-- Datensätze für Kunden
INSERT INTO customers (name, logo, status) VALUES
  ('Kunde A', '/webnetz/Images/customers/Kunde.png', 'aktiv'),
  ('Kunde B', '/webnetz/Images/customers/Kunde.png', 'inaktiv');

-- Datensätze für Case Studies
INSERT INTO case_studies (image, title, description, customer_id) VALUES
  ('/webnetz/Images/case_studies/case.png', 'Fallstudie 1', 'Beschreibung der Fallstudie 1', (SELECT id FROM customers WHERE name = 'Kunde A'));
