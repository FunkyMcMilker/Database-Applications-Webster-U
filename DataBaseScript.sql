CREATE DATABASE myStudio;

CREATE TABLE Studio_Rooms (
	Studio_id int NOT NULL,
	s_rate double,
	s_avalibility bit,
PRIMARY KEY (Studio_id)
);


CREATE TABLE instruments (
	instruments_id int NOT NULL,
	instruments_name varchar(30),
	type varchar(30),
	i_rate double,
	i_avalibility bit,
PRIMARY KEY (instruments_id)
);

CREATE TABLE Employees (
	Employee_id int NOT NULL,
	Equipment_name varchar(30),
	Possition varchar(30),
	e_avalibility bit,
PRIMARY KEY (Employee_id)

);


CREATE TABLE Equipment (
	Equipment_id int NOT NULL,
	Equipment_name varchar(30),
	Description varchar(30),
	Studio_id int,
PRIMARY KEY (Equipment_id),
FOREIGN KEY (Studio_id) REFERENCES Studio_Rooms(Studio_id)

);


CREATE TABLE Customer (
	c_id int NOT NULL,
	c_name varchar(30) NOT NULL,
	Studio_id int NOT NULL,
	e_avalibility bit,
	Employee_id int,
	instruments_id int,
PRIMARY KEY (c_id),
FOREIGN KEY (Employee_id) REFERENCES Employees(Employee_id),
FOREIGN KEY (Studio_id) REFERENCES Studio_Rooms(Studio_id),
FOREIGN KEY (instruments_id) REFERENCES Instruments(instruments_id)
);

INSERT INTO Studio_Rooms (Studio_id, s_rate, s_avalibility)
VALUES (1, 50.00, 1)

INSERT INTO instruments (instruments_id, instruments_name, type, i_rate, i_avalibility)
VALUES (1, “59 Fender Stratocaster”, “Guitar”, 100.00, 1)

INSERT INTO Employees (Employee_id, Equipment_name, Possition, e_avalibility)
VALUES (1, “Rick Ruben”, “Producer”, 1)


INSERT INTO Equipment (Equipment_id, Equipment_name, Description, Studio_id)
VALUES (1, “Universal Audio 610”, “Anolog Console”, 1)

INSERT INTO Customer (c_id, c_name, Studio_id, e_avalibility, Employee_id, instruments_id )
VALUES (021, 'Smith', 1, 1, 1, NULL)
