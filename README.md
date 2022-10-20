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

### Query 4: Select first semester courses from year 1

[JSON Results](results/query4.json)

SELECT `name`, `period`, `year`
FROM `courses`
WHERE `period` LIKE 'I semestre'
AND `year` = 1;

### Query 5: Select exams in the afternoon (after 14:00) of the 20/06/20

[JSON Results](results/query5.json)

SELECT `id`, `date`, `hour`
FROM `exams`
WHERE `date` = '2020-06-20'
AND `hour` >= '14:00:00';

### Query 6: Select bachelors 'Magistrale'

### Query 7: How many departments are there

### Query 8: How many teachers don't have their phone numbers?