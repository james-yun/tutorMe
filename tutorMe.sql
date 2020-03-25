-- https://docs.google.com/document/d/1GcQTdP4tdWakXyjDmUXz2QnnzqDd228vHhhRqt60NrY/edit
-- student(student_id, phone_number, first_name, last_name, venmo_id)
CREATE TABLE IF NOT EXISTS student (
  student_id varchar(7) NOT NULL DEFAULT 'abc2xyz' UNIQUE,
  phone_number varchar(20) DEFAULT 123-456-7890,
  first_name varchar(20) NOT NULL DEFAULT 'first_name',
  last_name varchar(20) NOT NULL DEFAULT 'last_name', 
  venmo_id varchar(20) NOT NULL DEFAULT 'venmo',
  PRIMARY KEY (student_id)
);

INSERT INTO student (student_id, phone_number, first_name, last_name, venmo_id) VALUES
('jy2gm', '555-555-5555', 'James', 'Yun', 'james-yun'),
('jy2gm', '555-555-5555', 'James', 'Yun', 'james-yun'),
('jy2gm', '555-555-5555', 'James', 'Yun', 'james-yun'),

-- course(course_number, course_name)
CREATE TABLE IF NOT EXISTS course (
  course_number INT NOT NULL DEFAULT NULL,
  course_name varchar(20) DEFAULT NULL, 
  PRIMARY KEY (course_number)
);

-- takes(student_id, course_number, course_name)
CREATE TABLE IF NOT EXISTS takes (
  course_number varchar(10) NOT NULL DEFAULT '',
  course_name varchar(100) NOT NULL DEFAULT '', 
  PRIMARY KEY (course_number)
);

-- tutor(student_id, isPaid)
CREATE TABLE IF NOT EXISTS tutor (
  student_id varchar(10) NOT NULL DEFAULT NULL UNIQUE,
  isPaid bool DEFAULT False, 
  PRIMARY KEY (student_id)
);

-- locations(tutor_id, location)
CREATE TABLE IF NOT EXISTS locations (
  tutor_id INT NOT NULL DEFAULT NULL,
  location varchar(20) DEFAULT NULL, 
  PRIMARY KEY (tutor_id)
);

-- teaches(tutor_id, course_number, course_name) lindsay
CREATE TABLE IF NOT EXISTS teaches (
	tutor_id varchar(7) NOT NULL DEFAULT 'abc2xyz',
  course_number varchar(10) NOT NULL DEFAULT 'ECON9999',
	course_name varchar(100) DEFAULT 'Markets, Mechanisms, and Models',
  PRIMARY KEY (tutor_id, course_number, course_name)
);
-- reviews(student_id, tutor_id, star_rating, comment) lindsay
CREATE TABLE IF NOT EXISTS reviews (
	student_id varchar(7) NOT NULL DEFAULT 'abc2xyz',
  tutor_id varchar(7) NOT NULL DEFAULT 'abc2xyz',
  star_rating int(5) NOT NULL DEFAULT 5,
  comment varchar(250) DEFAULT '',
  PRIMARY KEY (student_id, tutor_id)
);
-- requests(request_id, student_id, tutor_id, location, start_time, end_time, price, isAccepted)
CREATE TABLE IF NOT EXISTS requests(
	request_id varchar(7) NOT NULL DEFAULT 'abc2xyz',
  student_id varchar(7) NOT NULL DEFAULT 'abc2xyz',
  tutor_id varchar(7) NOT NULL DEFAULT 'abc2xyz',
  location varchar(20) NOT NULL DEFAULT '',
  start_time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  end_time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  price float(3,2) DEFAULT 000.00, 
  isAccepted bool DEFAULT False,
  PRIMARY KEY (request_id)
);

-- tutor_me_in(request_id, course_number, course_name)
CREATE TABLE IF NOT EXISTS tutor_me_in (
  request_id varchar(7) NOT NULL DEFAULT 'abc2xyz',
  course_number varchar(10) NOT NULL DEFAULT 'ECON9999',
  course_name varchar(100) NOT NULL DEFAULT 'Markets, Mechanisms, and Models',
  PRIMARY KEY (request_id)
);
