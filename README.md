# Testing MySQL database

## db_university | Practice Queries

### Query 1: Select students born in 1990

[JSON Results](results/query1.json)

### Query 2: Courses with more than 10 Credits

[JSON Results](results/query2.json)

SELECT `name`, `cfu`
FROM `courses`
WHERE `cfu` > 10;

### Query 3: Students older than 30

TOTAL: 3307 total

Collected Data: 100 in Json

[JSON Results](results/query3.json)

SELECT name, surname, date_of_birth,
TIMESTAMPDIFF(YEAR, date_of_birth, CURRENT_DATE) as age
FROM `students`
WHERE TIMESTAMPDIFF(YEAR, date_of_birth, CURRENT_DATE) > 30;

### Query 4: Select first semester courses from year 1

[JSON Results](results/query4.json)

SELECT `name`, `period`, `year`
FROM `courses`
WHERE `period` = 'I semestre'
AND `year` = 1;

### Query 5: Select exams in the afternoon (after 14:00) of the 20/06/20

[JSON Results](results/query5.json)

SELECT `id`, `date`, `hour`
FROM `exams`
WHERE `date` = '2020-06-20'
AND HOUR(`hour`) >= 14;

### Query 6: Select bachelors 'Magistrale'

[JSON Results](results/query6.json)

SELECT `name`, `level`
FROM `degrees`
WHERE `level` = 'magistrale';

### Query 7: How many departments are there

12

SELECT COUNT(id)
FROM departments;

### Query 8: How many teachers don't have their phone numbers?

50

SELECT COUNT(`id`)
FROM `teachers`
WHERE phone IS NULL;

## More Practice Queries | GROUP BY

### Query 1: Contare quanti iscritti ci sono stati ogni anno

--  Contare quanti iscritti ci sono stati ogni anno
SELECT YEAR(s.enrolment_date) as year, COUNT(s.id) as num_students
FROM students as s
GROUP BY YEAR(s.enrolment_date);

### Query 2: Contare gli insegnanti che hanno l'ufficio nello stesso edificio

--  Contare gli insegnanti che hanno l'ufficio nello stesso edificio
SELECT teachers.office_address, COUNT(teachers.id) as num_teachers
FROM teachers
GROUP BY teachers.office_address;

### Query 3: Calcolare la media dei voti di ogni appello d'esame

--  Calcolare la media dei voti di ogni appello d'esame
SELECT 
	courses.name as course,
  es.exam_id,
  AVG(es.vote) as average_vote
FROM exam_student as es
INNER JOIN exams ON es.exam_id = exams.id
INNER JOIN courses ON exams.course_id = courses.id
GROUP BY courses.name, es.exam_id;

### Query 4: Contare quanti corsi di laurea ci sono per ogni dipartimento

--  Contare quanti corsi di laurea ci sono per ogni dipartimento
SELECT departments.name, COUNT(deg.id) as n_degrees
FROM degrees as deg
INNER JOIN departments ON deg.department_id = departments.id
GROUP BY deg.department_id

## More Practice Queries | JOIN method

### Query 1: Selezionare tutti gli studenti iscritti al Corso di Laurea in Economia

-- Selezionare tutti gli studenti iscritti al Corso di Laurea in Economia
SELECT st.name, st.surname, st.fiscal_code, deg.name
FROM students as st
INNER JOIN degrees as deg
ON st.degree_id = deg.id
WHERE deg.name = "Corso di Laurea in Economia";

### Query 2: Selezionare tutti i Corsi di Laurea Magistrale del Dipartimento di Neuroscienze

-- Selezionare tutti i Corsi di Laurea Magistrale del Dipartimento di Neuroscienze';
SELECT deg.name, deg.level, departments.name as department_name
FROM degrees as deg
INNER JOIN departments ON deg.department_id = departments.id
WHERE departments.name = 'Dipartimento di Neuroscienze'
AND deg.level = "magistrale";

### Query 3: Selezionare tutti i corsi in cui insegna Fulvio Amato (id=44)

-- Selezionare tutti i corsi in cui insegna Fulvio Amato (id=44)
SELECT t.name, t.surname, c.name as course_name, c.id as course_id 
FROM teachers as t
INNER JOIN course_teacher ON t.id = course_teacher.teacher_id
INNER JOIN courses as c ON course_teacher.course_id = c.id
WHERE t.id = 44;

### Query 4: Selezionare tutti gli studenti con i dati relativi al corso di laurea a cui sono iscritti e il relativo dipartimento, in ordine alfabetico per cognome e nome

-- Selezionare tutti gli studenti con i dati relativi al corso di laurea a cui sono iscritti e il relativo dipartimento, in ordine alfabetico per cognome e nome
SELECT 
	st.surname, st.name, st.registration_number, 
	deg.name as degree, deg.address as address, 
    dep.name as department, dep.website, dep.head_of_department   
FROM students as st
INNER JOIN degrees as deg ON st.degree_id = deg.id
INNER JOIN departments as dep ON deg.department_id = dep.id
ORDER BY st.surname ASC, st.name ASC;

### Query 5: Selezionare tutti i corsi di laurea con i relativi corsi e insegnanti

-- Selezionare tutti i corsi di laurea con i relativi corsi e insegnanti
SELECT 
	deg.name as degree, 
  c.name as course,
  CONCAT(t.name, " ", t.surname) as teacher 
FROM degrees as deg 
INNER JOIN courses as c ON deg.id = c.degree_id
INNER JOIN course_teacher ON c.id = course_teacher.course_id
INNER JOIN teachers as t ON course_teacher.teacher_id = t.id
ORDER BY deg.name ASC;

### Query 6: Selezionare tutti i docenti che insegnano nel Dipartimento di Matematica (54)

-- Selezionare tutti i docenti che insegnano nel Dipartimento di Matematica (54)
SELECT 
	dep.name as department,
  CONCAT(t.name, " ", t.surname)
FROM departments as dep 
INNER JOIN degrees ON dep.id = degrees.department_id
INNER JOIN courses ON degrees.id = courses.degree_id
INNER JOIN course_teacher ON courses.id = course_teacher.course_id
INNER JOIN teachers as t ON course_teacher.teacher_id = t.id
WHERE dep.name = "Dipartimento di Matematica";

### Query 7: BONUS: Selezionare per ogni studente quanti tentativi d’esame ha sostenuto per superare ciascuno dei suoi esami

--  BONUS: Selezionare per ogni studente quanti tentativi d’esame ha sostenuto per superare ciascuno dei suoi esami
SELECT 
  es.student_id,
  CONCAT(st.name, " ", st.surname) as student,
  AVG(es.vote) as average_vote,
  COUNT(es.exam_id) as n_exam_attempts,
  es.exam_id, courses.name, degrees.name
FROM exam_student as es 
INNER JOIN students AS st ON es.student_id = st.id
INNER JOIN exams ON es.exam_id = exams.id
INNER JOIN courses ON exams.course_id = courses.id
INNER JOIN degrees ON courses.degree_id = degrees.id
GROUP BY es.student_id, es.exam_id
ORDER BY COUNT(es.exam_id) DESC;

