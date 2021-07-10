CREATE DATABASE myStudio;

CREATE TABLE Studio_Rooms (
	studio_id int NOT NULL,
	studio_rate double,
	studio_avalibility bit,
PRIMARY KEY (studio_id)
);


CREATE TABLE instruments (
	instrument_id int NOT NULL,
	instrument_name varchar(30),
	instrument_type varchar(30),
	instrument_rate double,
	instrument_avalibility bit,
PRIMARY KEY (instrument_id)
);

CREATE TABLE Employees (
	employee_id int NOT NULL,
	equipment_name varchar(30),
	possition varchar(30),
  employee_avalibility bit,
PRIMARY KEY (employee_id)

);


CREATE TABLE Equipment (
	equipment_id int NOT NULL,
	equipment_name varchar(30),
	description varchar(30),
	studio_id int,
PRIMARY KEY (equipment_id),
FOREIGN KEY (studio_id) REFERENCES studio_Rooms(studio_id)

);


CREATE TABLE Customer (
	customer_id int NOT NULL,
	customer_name varchar(30) NOT NULL,
	studio_id int NOT NULL,
	employee_id int,
	instrument_id int,
PRIMARY KEY (customer_id),
FOREIGN KEY (employee_id) REFERENCES Employees(employee_id),
FOREIGN KEY (studio_id) REFERENCES Studio_Rooms(studio_id),
FOREIGN KEY (instrument_id) REFERENCES Instruments(instrument_id)
);

INSERT INTO Studio_Rooms (studio_id, studio_rate, studio_avalibility)
VALUES (1, 50.00, 1)

INSERT INTO Studio_Rooms (studio_id, studio_rate, studio_avalibility)
VALUES (2, 75.00, 1)

INSERT INTO Studio_Rooms (studio_id, studio_rate, studio_avalibility)
VALUES (3, 100.00, 1)

INSERT INTO instruments (instrument_id, instrument_name, instrument_type, instrument_rate, instrument_avalibility)
VALUES (1, "59 Fender Stratocaster", "Guitar", 100.00, 1)

INSERT INTO instruments (instrument_id, instrument_name, instrument_type, instrument_rate, instrument_avalibility)
VALUES (2, "63 Fender P-Bass", "Bass Guitar", 100.00, 1)

INSERT INTO instruments (instrument_id, instrument_name, instrument_type, instrument_rate, instrument_avalibility)
VALUES (3, "67 Pearl Drumset", "Drumset", 200.00, 1)

INSERT INTO Employees (employee_id, equipment_name, possition, employee_avalibility)
VALUES (1, "Rick Ruben", "Producer", 1)

INSERT INTO Employees (employee_id, equipment_name, possition, employee_avalibility)
VALUES (2, "Rapheal Sadiq", "Producer", 2)

INSERT INTO Equipment (equipment_id, equipment_name, description, studio_id)
VALUES (1, "Universal Audio 610", "Anolog Console", 1)

INSERT INTO Equipment (equipment_id, equipment_name, description, studio_id)
VALUES (2, "Sure Dynamic Mic", "Vocal Microphone", 1)

INSERT INTO Equipment (equipment_id, equipment_name, description, studio_id)
VALUES (3, "63 Vox AC30", "Guitar Amplifier", 1)

INSERT INTO Customer (customer_id, customer_name, studio_id, employee_avalibility, employee_id, instrument_id )
VALUES (021, 'Smith', 1, 1, 1, NULL)

INSERT INTO Customer (customer_id, customer_name, studio_id, employee_avalibility, employee_id, instrument_id )
VALUES (022, 'Dirty Magic', 1, 1, 1, NULL)

INSERT INTO Customer (customer_id, customer_name, studio_id, employee_avalibility, employee_id, instrument_id )
VALUES (023, 'Vulfpeck', 1, 1, 1, NULL)
