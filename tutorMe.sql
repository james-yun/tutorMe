-- https://docs.google.com/document/d/1GcQTdP4tdWakXyjDmUXz2QnnzqDd228vHhhRqt60NrY/edit
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
  course_name VARCHAR(100) NOT NULL DEFAULT 'INTro to INTros', 
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

-- reviews(student_id, tutor_id, star_rating, comment, timestamp)
CREATE TABLE IF NOT EXISTS reviews (
  student_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  tutor_id VARCHAR(7) NOT NULL DEFAULT 'xyz2abc',
  star_rating INT(5) NOT NULL DEFAULT 5,
  comment VARCHAR(250) DEFAULT '',
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (student_id, tutor_id, `timestamp`),
  FOREIGN KEY (student_id) REFERENCES student(student_id),
  FOREIGN KEY (tutor_id) REFERENCES tutor(student_id)
);

INSERT INTO reviews (student_id, tutor_id, star_rating, comment, `timestamp`) VALUES
('jp8su', 'jy2gm', 5, 'smort', CURRENT_TIMESTAMP),
('rb2eu', 'jy2gm', 2, 'not the best tutor out there', CURRENT_TIMESTAMP),
('jp8su', 'up3f', 5, 'cool prof', CURRENT_TIMESTAMP),
('jy2gm', 'up3f', 4, 'always friendly', CURRENT_TIMESTAMP),
('jp5qw', 'up3f', 5, 'good explanations', CURRENT_TIMESTAMP);

-- requests(request_id, student_id, tutor_id, location, start_time, end_time, price, isAccepted)
CREATE TABLE IF NOT EXISTS requests(
  request_id INT NOT NULL AUTO_INCREMENT,
  student_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  tutor_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  location VARCHAR(20) NOT NULL DEFAULT '',
  start_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  duration INT NOT NULL DEFAULT 60,
  price DECIMAL(5,2) DEFAULT 000.00, 
  isAccepted TINYINT(1) DEFAULT 0,
  PRIMARY KEY (request_id),
  FOREIGN KEY (student_id) REFERENCES student(student_id),
  FOREIGN KEY (tutor_id, location) REFERENCES locations(tutor_id, location)
);

INSERT INTO requests (student_id, tutor_id, location, start_time, duration, price, isAccepted) VALUES
('jp8su', 'jy2gm', 'Rice Hall', CURRENT_TIMESTAMP, 60, 20, 0),
('jp5qw', 'up3f', 'Mech 205', CURRENT_TIMESTAMP, 60, 20, 1),
('rb2eu', 'jy2gm', 'Clark Hall', CURRENT_TIMESTAMP, 60, 20, 0);

-- tutor_me_in(student_id, course_number, course_name)
CREATE TABLE IF NOT EXISTS tutor_me_in (
  student_id VARCHAR(7) NOT NULL DEFAULT 'abc2xyz',
  course_number VARCHAR(10) NOT NULL DEFAULT 'ECON9999',
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
