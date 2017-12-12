CREATE DATABASE Assignment1;

CREATE TABLE Department (
	dept_id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) UNIQUE NOT NULL,
	description VARCHAR(255),
	PRIMARY KEY (dept_id)
);

CREATE TABLE User (
	user_id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(50) NOT NULL UNIQUE,
	username VARCHAR(20) NOT NULL UNIQUE,
	password VARCHAR(20) NOT NULL,
	registration_date DATETIME,
	dept_id INT,
	PRIMARY KEY (user_id),
	FOREIGN KEY (dept_id) REFERENCES Department(dept_id)
);
	
CREATE TABLE Course (
	course_id INT NOT NULL AUTO_INCREMENT,
	course_name VARCHAR(20) NOT NULL,
	course_description VARCHAR(255),
	instructor_name VARCHAR(50),
	credit_hours INT NOT NULL,
	dept_id INT,
	PRIMARY KEY (course_id),
	FOREIGN KEY (dept_id)  REFERENCES Department(dept_id)
);

-- Insert departments
INSERT INTO Department (name)
VALUES ("Computer and Communications Engineering (CCE)"),
("Electromechanical Engineering (EME)"),
("Gas and Petrochemical Engineering (GPE)");
/*
("Architectural and Construction Engineering (CAE)");
*/

-- Insert courses
INSERT INTO Course (course_name, credit_hours, dept_id) 
VALUES ("Programming I", 3, 1), ("Modern Physics", 3, 1), ("Data Structures", 3, 1),
("Programming II", 4, 1), ("Discrete Structures", 3, 1),
("Electric Circuits", 3, 1);

INSERT INTO Course (course_name, credit_hours, dept_id) 
VALUES ("Electronic Devices and Circuits", 3, 2), ("Thermodynamics I", 3, 2), 
("Electric Circuits", 3, 2),("Fluid Mechanics", 3, 2), ("Electrical Machines", 3, 2), 
("Heat Transfer", 3, 2);

INSERT INTO Course (course_name, credit_hours, dept_id) 
VALUES ("Physical Chemistry", 3, 3), ("Organic Chemistry", 3, 3), ("Fluid Mechanics", 3, 3),
("Corrosion Engineering", 3, 3), ("Numerical Methods", 3, 3);
