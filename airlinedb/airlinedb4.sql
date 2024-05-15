create database airlinedb4;
use airlinedb4;
CREATE TABLE Airports (
    AirportCode VARCHAR(3) PRIMARY KEY,
    AirportName VARCHAR(100),
    City VARCHAR(100),
    Country VARCHAR(100)
);
CREATE TABLE Flights (
    FlightNumber VARCHAR(10) PRIMARY KEY ,
    DepartureAirportCode VARCHAR(3),
    ArrivalAirportCode VARCHAR(3),
    DepartureTime TIME,
    ArrivalTime TIME,
    JourneyDate date,
    AircraftType VARCHAR(50),
    FOREIGN KEY (DepartureAirportCode) REFERENCES Airports(AirportCode),
    FOREIGN KEY (ArrivalAirportCode) REFERENCES Airports(AirportCode)
);

CREATE TABLE Passengers (
    PassengerID INT PRIMARY KEY auto_increment,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Email VARCHAR(100),
    PhoneNumber VARCHAR(20),
    Username VARCHAR(50),
    Password VARCHAR(100)
);
CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY auto_increment,
    PassengerID INT,
    FlightNumber VARCHAR(10),
    BookingDate DATETIME,
    SeatNumber VARCHAR(10),
    FOREIGN KEY (PassengerID) REFERENCES Passengers(PassengerID),
    FOREIGN KEY (FlightNumber) REFERENCES Flights(FlightNumber)
);

select * from Passengers;
INSERT INTO Airports (AirportCode, AirportName, City, Country) VALUES
    ('JFK', 'John F. Kennedy International Airport', 'New York City', 'United States'),
    ('LAX', 'Los Angeles International Airport', 'Los Angeles', 'United States'),
    ('LHR', 'London Heathrow Airport', 'London', 'United Kingdom'),
    ('CDG', 'Charles de Gaulle Airport', 'Paris', 'France'),
    ('SYD', 'Sydney Kingsford Smith Airport', 'Sydney', 'Australia'),
    ('PEK', 'Beijing Capital International Airport', 'Beijing', 'China'),
    ('DXB', 'Dubai International Airport', 'Dubai', 'United Arab Emirates'),
    ('HND', 'Tokyo Haneda Airport', 'Tokyo', 'Japan'),
    ('AMS', 'Amsterdam Airport Schiphol', 'Amsterdam', 'Netherlands'),
    ('SIN', 'Singapore Changi Airport', 'Singapore', 'Singapore'),
    ('FRA', 'Frankfurt Airport', 'Frankfurt', 'Germany'),
    ('IST', 'Istanbul Airport', 'Istanbul', 'Turkey'),
    ('ATL', 'Hartsfield-Jackson Atlanta International Airport', 'Atlanta', 'United States'),
    ('ORD', 'O\'Hare International Airport', 'Chicago', 'United States');
INSERT INTO Airports (AirportCode, AirportName, City, Country) VALUES
    ('DEL', 'Indira Gandhi International Airport', 'Delhi', 'India'),
    ('BOM', 'Chhatrapati Shivaji Maharaj International Airport', 'Mumbai', 'India'),
    ('MAA', 'Chennai International Airport', 'Chennai', 'India'),
    ('BLR', 'Kempegowda International Airport', 'Bangalore', 'India'),
    ('HYD', 'Rajiv Gandhi International Airport', 'Hyderabad', 'India');
CREATE TABLE Aircrafts (
    AircraftID INT PRIMARY KEY,
    AircraftType VARCHAR(50),
    RegistrationNumber VARCHAR(20),
    Capacity INT
);


alter table Bookings modify column SeatNumber int ;
desc Bookings;
-- Insert flights
INSERT INTO Flights (FlightNumber, DepartureAirportCode, ArrivalAirportCode, DepartureTime, ArrivalTime, JourneyDate, AircraftType)
VALUES
('AA101', 'JFK', 'LAX', '09:00:00', '12:00:00', '2024-04-29', 'Boeing 777'),
('BA202', 'LHR', 'CDG', '11:30:00', '13:30:00', '2024-04-30', 'Airbus A320'),
('QF303', 'SYD', 'PEK', '16:00:00', '22:00:00', '2024-05-01', 'Boeing 787'),
('EK404', 'DXB', 'HND', '08:30:00', '20:00:00', '2024-05-02', 'Airbus A380'),
('KL505', 'AMS', 'SIN', '13:15:00', '07:45:00', '2024-05-03', 'Boeing 777'),
('LH606', 'FRA', 'IST', '10:45:00', '14:15:00', '2024-05-04', 'Airbus A330'),
('DL707', 'ATL', 'ORD', '07:00:00', '09:00:00', '2024-05-05', 'Boeing 737'),
('AI808', 'DEL', 'BOM', '12:00:00', '14:00:00', '2024-05-06', 'Airbus A320'),
('AI909', 'BOM', 'MAA', '15:30:00', '17:30:00', '2024-05-07', 'Boeing 737'),
('AI101', 'MAA', 'BLR', '18:00:00', '19:30:00', '2024-05-08', 'Airbus A320'),
('AI111', 'BLR', 'HYD', '20:00:00', '21:30:00', '2024-05-09', 'Boeing 737');
INSERT INTO Flights (FlightNumber, DepartureAirportCode, ArrivalAirportCode, DepartureTime, ArrivalTime, JourneyDate, AircraftType)
VALUES
('UA1001', 'ORD', 'LHR', '17:30:00', '08:00:00', '2024-04-29', 'Boeing 787'),
('CX1002', 'HND', 'SIN', '09:15:00', '12:45:00', '2024-04-30', 'Airbus A350'),
('EY1003', 'AMS', 'DEL', '02:00:00', '07:30:00', '2024-05-01', 'Boeing 777'),
('QR1004', 'HND', 'SYD', '08:00:00', '06:00:00', '2024-05-02', 'Airbus A380'),
('TK1005', 'IST', 'AMS', '11:45:00', '15:15:00', '2024-05-03', 'Boeing 777'),
('SQ1006', 'SIN', 'LAX', '23:59:00', '21:00:00', '2024-05-04', 'Airbus A350'),
('JL1007', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-05', 'Boeing 787'),
('KE1008', 'LAX', 'JFK', '13:20:00', '16:20:00', '2024-05-06', 'Boeing 777'),
('AI1009', 'HYD', 'DEL', '06:00:00', '09:00:00', '2024-05-07', 'Airbus A320');

desc Bookings;
select * from Bookings;
SELECT Flights.FlightNumber, Flights.DepartureAirportCode, Flights.ArrivalAirportCode, Flights.DepartureTime, Flights.ArrivalTime, Flights.JourneyDate, Flights.AircraftType 
        FROM Bookings 
        INNER JOIN Flights ON Bookings.FlightNumber = Flights.FlightNumber 
        WHERE Bookings.PassengerID = 4;
        select * from Bookings;
        select * from Passengers;
INSERT INTO Flights (FlightNumber, DepartureAirportCode, ArrivalAirportCode, DepartureTime, ArrivalTime, JourneyDate, AircraftType)
VALUES

('JL1001', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-04-29', 'Boeing 787'),
('JL1002', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-04-30', 'Boeing 787'),
('JL1003', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-01', 'Boeing 787'),
('JL1004', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-02', 'Boeing 787'),
('JL1006', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-03', 'Boeing 787'),
('JL1005', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-04', 'Boeing 787'),
('JL1008', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-06', 'Boeing 787'),
('JL1009', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-07', 'Boeing 787');

INSERT INTO Flights (FlightNumber, DepartureAirportCode, ArrivalAirportCode, DepartureTime, ArrivalTime, JourneyDate, AircraftType)
VALUES

('JL1001', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-04-29', 'Boeing 787'),
('JL1002', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-04-30', 'Boeing 787'),
('JL1003', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-01', 'Boeing 787'),
('JL1004', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-02', 'Boeing 787'),
('JL1006', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-03', 'Boeing 787'),
('JL1005', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-04', 'Boeing 787'),
('JL1008', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-06', 'Boeing 787'),
('JL1009', 'DEL', 'BLR', '10:30:00', '13:30:00', '2024-05-07', 'Boeing 787');
select * from Passengers;
select * from Bookings;
select * from Flights;
select * from Airports;



        