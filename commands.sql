-------------------------------------- Non-advanced SQL commands --------------------------------------

-- Making a student profile
INSERT INTO student
  (student_id, phone_number, first_name, last_name, venmo_id)
VALUES
  ('jy2gm', '555-555-5555', 'James', 'Yun', 'james-yun');

-- Edit a student profile
UPDATE student
SET phone_number = '703-123-4567' 
WHERE student_id = 'rb2eu';

-- Making a tutor profile
INSERT INTO tutor
  (student_id, isPaid)
VALUES
  ('up3f', 0);

-- Edit a tutor profile
UPDATE tutor
SET isPaid = 1 
WHERE student_id = 'up3f';


--Deleting Account
DELETE FROM student WHERE user = 'jp5qw';

-- Make a request
INSERT INTO requests
  (student_id, tutor_id, course_number, location, start_time, duration, price, isAccepted)
VALUES
  ('rb2eu', 'up3f', 'CS 4750', 'Mech 205', '2020-01-01 14:00:00', 60, 20, 0);

-- Sort tutors by (x)

-- group them by the course that is taught or look for a specific course
SELECT tutor.student_id, teaches.course_number
FROM tutor LEFT JOIN teaches
  ON tutor.student_id = teaches.tutor_id
WHERE teaches.course_number = 'CS2150'
GROUP BY teaches.course_number;

-- location
SELECT tutor.student_id, locations.location
FROM tutor LEFT JOIN locations
  ON tutor.student_id = locations.tutor_id
WHERE locations.location = 'Clark'
GROUP BY locations.location;

-- Average star rating
SELECT tutor.student_id,
  (SELECT AVG(star_rating)
  FROM reviews
  WHERE reviews.tutor_id = tutor.student_id) AS avg_star_rating
FROM tutor
ORDER BY avg_star_rating DESC;


-- availability sorted by ascending start time
SELECT tutor.student_id, availability_slot.start_time, availability_slot.duration
FROM tutor LEFT JOIN availability_slot
  ON tutor.student_id = availability_slot.tutor_id
WHERE -- optional
  availability_slot.start_time >= 1130 -- change this to some start time
  AND
  availability_slot.start_time <= 1430 -- change this to some start time
  AND
  availability_slot.duration > 30
ORDER BY availability_slot.start_time ASC;


-- Sort requests by (x)

SELECT *
FROM requests
WHERE
  requests.isAccepted = 0
  AND
  requests.course_number = 'CS 4750'
  AND
  requests.start_time >= 1130 -- change this to some start time
  AND
  requests.start_time <= 1430
-- change this to some start time
GROUP BY requests.price;

-- Accept request (match) with a student
UPDATE requests
SET isAccepted = '1', student_id = 'rb2eu' 
WHERE request_id = 'some-request-id';

-- Write a review
INSERT INTO reviews
  (student_id, tutor_id, course_number, star_rating, comment, `timestamp`)
VALUES
  ('rb2eu', 'jy2gm', 'CS 4102', 2, 'not the best tutor out there', CURRENT_TIMESTAMP);
