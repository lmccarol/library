CREATE DATABASE library_db;
USE library_db;
CREATE TABLE employee
	(employee_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	full_name VARCHAR(30) NOT NULL,
	type ENUM('regular','admin') NOT NULL , 
	password VARCHAR(30) NOT NULL
	);

ALTER TABLE employee AUTO_INCREMENT = 100;

CREATE TABLE member
	(member_code INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	full_name VARCHAR(30) NOT NULL,
	address VARCHAR(50) NOT NULL,
    city VARCHAR(30) NOT NULL,
    province VARCHAR(30) NOT NULL,
	phone VARCHAR(30) NOT NULL,
	email VARCHAR(30),
	password VARCHAR(30) NOT NULL
	);
	
ALTER TABLE member AUTO_INCREMENT = 1000;

CREATE TABLE document 
	(document_code INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(50) NOT NULL,
	author VARCHAR(30) NOT NULL,
	publication_year YEAR NOT NULL,
	category_id int NOT NULL REFERENCES category(category_id),
	type_id int NOT NULL REFERENCES type(type_id),
	genre_id int NOT NULL REFERENCES genre(genre_id),
	description VARCHAR(200),
	ISBN VARCHAR(15),
    status ENUM('available','loaned','reserved') NOT NULL
	);
	
CREATE TABLE loan 
	(loan_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	member_code INT NOT NULL REFERENCES member(member_code),
	document_code INT NOT NULL REFERENCES document(document_code),
	loan_date DATE NOT NULL,
	expected_return_date DATE NOT NULL,
	returned_date DATE,
    canceled DATE
	);
	
CREATE TABLE request
	(document_code INT NOT NULL REFERENCES document(document_code),
	member_code INT NOT NULL REFERENCES member(member_code),
	request_date DATE NOT NULL,
	status ENUM('pending', 'accepted', 'canceled') NOT NULL
	);
	
CREATE TABLE category
	(category_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	category VARCHAR(20) NOT NULL
	);
 
CREATE TABLE type
	(type_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	type VARCHAR(10) NOT NULL
	);
	
CREATE TABLE Genre
	(genre_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	genre VARCHAR(25) NOT NULL
	);

ALTER TABLE document ADD CONSTRAINT FK_category FOREIGN KEY(category_id) REFERENCES category(category_id);
ALTER TABLE document ADD CONSTRAINT FK_type FOREIGN KEY(type_id) REFERENCES type(type_id);
ALTER TABLE document ADD CONSTRAINT FK_genre FOREIGN KEY(genre_id) REFERENCES genre(genre_id);

ALTER TABLE request ADD CONSTRAINT PRIMARY KEY(document_code, member_code);
ALTER TABLE request ADD CONSTRAINT FK_document FOREIGN KEY(document_code) REFERENCES document(document_code);
ALTER TABLE request ADD CONSTRAINT FK_member FOREIGN KEY(member_code) REFERENCES member(member_code);

ALTER TABLE loan ADD CONSTRAINT FK_document_loan FOREIGN KEY(document_code) REFERENCES document(document_code);
ALTER TABLE loan ADD CONSTRAINT FK_member_loan FOREIGN KEY(member_code) REFERENCES member(member_code);

GRANT all	
	ON library_db.*
	TO 'admin'@'localhost' IDENTIFIED BY '6070';

INSERT INTO member(full_name, address, city, province, phone, email, password)
VALUES ('Sophie Dumas', '75 Main St.', 'Montreal', 'Quebec', '(514)756-9021', 'sophie@gmail.com', 1234);

INSERT INTO employee(full_name, type, password)
VALUES('Marie Jones', 'regular', '1111');

INSERT INTO type(type)
VALUES('children'), ('teens'), ('adult');

INSERT INTO genre(genre)
VALUES('comedy'), ('drama'), ('fantasy'), ('documentary'), ('action'), ('pop rock'), ('musical');

INSERT INTO category(category)
VALUES('novel'), ('comic'), ('video game'), ('DVD'), ('Blu-ray'), ('CD');	

INSERT INTO document(title, author, publication_year, category_id, type_id, genre_id, description, ISBN, status)
VALUES('Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', '1997',  1, 2, 3, 'The first novel in the Harry Potter series and Rowling\'s debut novel. It follows Harry Potter, a young wizard who discovers his magical heritage.', '978-0-7475-3269-9', 'available');

INSERT INTO employee(full_name, type, password)
VALUES('Sam Ward', 'admin', '3333');

GRANT all	
	ON library_db.*
	TO 'Sam Ward'@'localhost' IDENTIFIED BY '3333';	