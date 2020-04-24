-- Create and populate tables
-- https://docs.google.com/document/d/1GcQTdP4tdWakXyjDmUXz2QnnzqDd228vHhhRqt60NrY/edit

-- login(student_id, hash, salt)
CREATE TABLE IF NOT EXISTS login(
    student_id VARCHAR(7) NOT NULL UNIQUE,
    hash VARCHAR(255) NOT NULL,
    PRIMARY KEY (student_id)
);

-- student(student_id, phone_number, first_name, last_name, venmo_id)
CREATE TABLE IF NOT EXISTS student (
  student_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz' UNIQUE,
  phone_number VARCHAR(20) DEFAULT '123-456-7890',
  first_name VARCHAR(20) NOT NULL DEFAULT 'first_name',
  last_name VARCHAR(20) NOT NULL DEFAULT 'last_name', 
  venmo_id VARCHAR(20) NOT NULL DEFAULT 'venmo',
  PRIMARY KEY (student_id)
);

INSERT INTO student (student_id, phone_number, first_name, last_name, venmo_id) VALUES
('jy2gm', '555-555-5555', 'James', 'Yun', 'james-yun'),
('jp8su', '123-456-7890', 'Jeevna', 'Prakash', 'jeevna-prakash'),
('up3f', '911', 'Upsorn', 'Praphamontripong', 'upsorn'),
('rb2eu', '123-456-7890', 'Rahul', 'Batra', 'rb'),
('jp5qw', '123-456-7890', 'Lindsay', 'Park', 'lp');


-- course(course_number, course_name)
CREATE TABLE IF NOT EXISTS course (
  course_number VARCHAR(10) NOT NULL DEFAULT 'XX 0000',
  course_name VARCHAR(100) NOT NULL DEFAULT 'Intro to Intros', 
  PRIMARY KEY (course_number)
);

INSERT INTO course (course_number, course_name) VALUES
('CS 4750', 'Database Systems'),
('CS 3250', 'Software Testing'),
('CS 4102', 'Algorithms'),
('STS 4600', 'The Engineer, Ethics, and Professional Responsibility'),
('CS 3330', 'Computer Architecture');

-- takes(student_id, course_number, course_name)
CREATE TABLE IF NOT EXISTS takes (
  student_id VARCHAR(7) NOT NULL DEFAULT 'ab0cd',
  course_number VARCHAR(10) NOT NULL DEFAULT 'XX 0000',
  PRIMARY KEY (student_id, course_number),
  FOREIGN KEY (course_number) REFERENCES course(course_number),
  FOREIGN KEY (student_id) REFERENCES student(student_id)
);

INSERT INTO takes (student_id, course_number) VALUES
('jy2gm', 'CS 4750'),
('jy2gm', 'STS 4600'),
('up3f', 'CS 4750'),
('up3f', 'CS 3250'),
('jp8su', 'CS 4750'),
('jp8su', 'CS 3330'),
('rb2eu', 'CS 4750'),
('rb2eu', 'STS 4600'),
('jp5qw', 'CS 4750'),
('jp5qw', 'CS 3330'),
('jp5qw', 'CS 3250');

-- tutor(student_id, isPaid)
CREATE TABLE IF NOT EXISTS tutor (
  student_id VARCHAR(10) NOT NULL DEFAULT 'ab0cd' UNIQUE,
  isPaid TINYINT(1) DEFAULT 0, 
  PRIMARY KEY (student_id)
);

INSERT INTO tutor (student_id, isPaid) VALUES
('jy2gm', 1),
('up3f', 0);

-- locations(tutor_id, location)
CREATE TABLE IF NOT EXISTS locations (
  tutor_id VARCHAR(10) NOT NULL DEFAULT 'xx0xx',
  location VARCHAR(20) DEFAULT '', 
  PRIMARY KEY (tutor_id, location),
  FOREIGN KEY (tutor_id) REFERENCES tutor(student_id)
);

INSERT INTO locations (tutor_id, location) VALUES
('jy2gm', 'Rice Hall'),
('jy2gm', 'Clark Hall'),
('up3f', 'Mech 205');

-- teaches(tutor_id, course_number, course_name)
CREATE TABLE IF NOT EXISTS teaches (
	tutor_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  course_number VARCHAR(10) NOT NULL DEFAULT 'ECON9999',
  PRIMARY KEY (tutor_id, course_number),
  FOREIGN KEY (tutor_id) REFERENCES student(student_id),
  FOREIGN KEY (course_number) REFERENCES course(course_number)
);

INSERT INTO teaches (tutor_id, course_number) VALUES
('jy2gm', 'CS 4102'),
('up3f', 'CS 4750'),
('up3f', 'CS 3250');

-- availability_slot(tutor_id, start_time, duration)
-- FDs = {tutor_id -> start_time, duration}
CREATE TABLE IF NOT EXISTS availability_slot (
  tutor_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  start_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  duration INT NOT NULL DEFAULT 60,
  PRIMARY KEY (tutor_id, start_time, duration),
  FOREIGN KEY (tutor_id) REFERENCES student(student_id)
);

DELIMITER $$
CREATE TRIGGER overlapping_availability
BEFORE INSERT ON availability_slot
FOR EACH ROW
  BEGIN
    IF EXISTS (
      SELECT * FROM availability_slot 
      WHERE new.tutor_id = tutor_id 
      AND new.start_time >= start_time 
      AND new.start_time < DATE_ADD(start_time, INTERVAL duration MINUTE)
      )
    THEN
    SET new.start_time = NULL;
    END IF;
  END
$$
DELIMITER ;

INSERT INTO availability_slot (tutor_id, start_time, duration) VALUES
('jy2gm', '2020-01-01 00:00:00', 1440),
('jy2gm', '2020-01-03 00:00:00', 1440),
('jy2gm', '2020-01-05 00:00:00', 1440),
('up3f', '2020-01-01 00:00:00', 1440);

-- reviews(student_id, tutor_id, course_number, star_rating, comment, timestamp)
CREATE TABLE IF NOT EXISTS reviews (
  student_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  tutor_id VARCHAR(7) NOT NULL DEFAULT 'xyz2abc',
  course_number VARCHAR(10) NOT NULL DEFAULT 'ECON 9999',
  star_rating INT(5) NOT NULL DEFAULT 5,
  comment VARCHAR(250) DEFAULT '',
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (student_id, tutor_id, `timestamp`),
  FOREIGN KEY (student_id) REFERENCES student(student_id),
  FOREIGN KEY (tutor_id) REFERENCES tutor(student_id),
  FOREIGN KEY (course_number) REFERENCES course(course_number),
  CONSTRAINT cannot_review_yourself CHECK (student_id <> tutor_id)
);

INSERT INTO reviews (student_id, tutor_id, course_number, star_rating, comment, `timestamp`) VALUES
('jp8su', 'jy2gm', 'CS 4102', 5, 'smort', CURRENT_TIMESTAMP),
('rb2eu', 'jy2gm', 'CS 4102', 2, 'not the best tutor out there', CURRENT_TIMESTAMP),
('jp8su', 'up3f', 'CS 4750', 5, 'cool prof', CURRENT_TIMESTAMP),
('jy2gm', 'up3f', 'CS 3250', 4, 'always friendly', CURRENT_TIMESTAMP),
('jp5qw', 'up3f', 'CS 4750', 5, 'good explanations', CURRENT_TIMESTAMP);

-- requests(request_id, student_id, tutor_id, course_number, location, start_time, end_time, price, isAccepted)
CREATE TABLE IF NOT EXISTS requests(
  request_id INT NOT NULL AUTO_INCREMENT,
  student_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  tutor_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  course_number VARCHAR(10) NOT NULL DEFAULT 'ECON 9999',
  location VARCHAR(20) NOT NULL DEFAULT '',
  start_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  duration INT NOT NULL DEFAULT 60,
  price DECIMAL(5,2) DEFAULT 000.00, 
  isAccepted TINYINT(1) DEFAULT 0,
  PRIMARY KEY (request_id),
  FOREIGN KEY (student_id) REFERENCES student(student_id),
  FOREIGN KEY (course_number) REFERENCES course(course_number),
  FOREIGN KEY (tutor_id, location) REFERENCES locations(tutor_id, location),
  FOREIGN KEY (tutor_id, course_number) REFERENCES teaches(tutor_id, course_number),
  CONSTRAINT cannot_request_yourself CHECK (student_id <> tutor_id)
);

DELIMITER $$
CREATE TRIGGER tutor_not_available
BEFORE INSERT ON requests
FOR EACH ROW
  BEGIN
    IF NOT EXISTS (
      SELECT * FROM availability_slot 
      WHERE new.tutor_id = tutor_id 
      AND new.start_time >= start_time 
      AND new.start_time <= DATE_ADD(start_time, INTERVAL duration MINUTE)
      AND DATE_ADD(new.start_time, INTERVAL new.duration MINUTE) <= DATE_ADD(start_time, INTERVAL duration MINUTE)
      )
    THEN
    SET new.student_id = NULL;
    END IF;
  END
$$
DELIMITER ;

INSERT INTO requests (student_id, tutor_id, course_number, location, start_time, duration, price, isAccepted) VALUES
('jp8su', 'jy2gm', 'CS 4102', 'Rice Hall', '2020-01-01 09:00:00', 60, 20, 0),
('jp5qw', 'up3f', 'CS 4750', 'Mech 205', '2020-01-01 13:00:00', 60, 20, 1),
('rb2eu', 'up3f', 'CS 4750', 'Mech 205', '2020-01-01 14:00:00', 60, 20, 0);

-- tutor_me_in(student_id, course_number)
CREATE TABLE IF NOT EXISTS tutor_me_in (
  student_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  course_number VARCHAR(10) NOT NULL DEFAULT 'ECON 9999',
  PRIMARY KEY (student_id, course_number),
  FOREIGN KEY (student_id) REFERENCES student(student_id),
  FOREIGN KEY (course_number) REFERENCES course(course_number)
);

INSERT INTO tutor_me_in (student_id, course_number) VALUES
('jy2gm', 'CS 4750'),
('jp5qw', 'CS 4750'),
('jp8su', 'CS 4750'),
('rb2eu', 'CS 4750'),
('jp8su', 'CS 3330'),
('rb2eu', 'STS 4600');
