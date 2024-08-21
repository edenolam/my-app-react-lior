USE rendezvous;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL
);

CREATE TABLE timeslots (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           start_time TIME NOT NULL,
                           end_time TIME NOT NULL
);

CREATE TABLE appointments (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              user_id INT NOT NULL,
                              name VARCHAR(100) NOT NULL,
                              email VARCHAR(100) NOT NULL,
                              appointment_date DATETIME NOT NULL,
                              timeslot INT NOT NULL,
                              FOREIGN KEY (user_id) REFERENCES users(id),
                              FOREIGN KEY (timeslot) REFERENCES timeslots(id)
);
