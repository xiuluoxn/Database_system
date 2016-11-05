-- violate primary key constraints (Movie id is duplicated)
INSERT INTO CS143.Movie VALUES (272,"Baby Take a Bow",1934,"PG","Fox Film Corporation");
-- Teminal output: ERROR 1062 (23000) at line 2: Duplicate entry '272' for key 'PRIMARY'
-- violate CHECK constraints (Movie id > 4750 (max))
INSERT INTO CS143.Movie VALUES (4751,"Baby T",1934,"PG","Fox Film Corporation");
-- Teminal output: ERROR 1062 (23000) at line 2: wrong entry '4751' 'id' is larger than 4750
-- violate primary key constraints (Actor id is duplicated)
INSERT INTO CS143.Actor VALUES (1,"AB","Isaabelle","Female",19750525,\N); 
-- Teminal output: ERROR 1062 (23000): Duplicate entry '1' for key 'PRIMARY'
-- violate CHECK constraints (Actor id > 69000 (max))
INSERT INTO CS143.Actor VALUES (69001,"AB","Isaabelle","Female",19750525,\N);
-- Teminal output: ERROR 1062 (23000) at line 2: wrong entry '69001' 'id' is larger than 69000
-- violate primary key constraints (Director id is duplicated)
INSERT INTO CS143.Director VALUES (37146,"Ning","Xin",19921015,\N); 
-- Teminal output: ERROR 1062 (23000): Duplicate entry '37146' for key 'PRIMARY'
-- violate CHECK constraints (Director id > 69000 (max))
INSERT INTO CS143.Director VALUES (-1,"Ning","Xin",19921015,\N); 
-- Teminal output: ERROR 1062 (23000) at line 2: wrong entry '-1' 'id' is less than 0
-- violate Foreign Key constraints (Movie id '4113' is referenced by MovieGenre)
DELETE FROM CS143.Movie WHERE id = 4113;
-- Teminal output: ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
-- violate Foreign Key constraints (mid '1' is reference to id in Movie table however id 1 does not exists)
INSERT INTO CS143.MovieGenre VALUES (1,"Drama");
-- Teminal output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
-- violate Foreign Key constraints (Actor id '10208' is referenced by MovieActor)
DELETE FROM CS143.Actor WHERE id = 10208;
-- Teminal output: ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))
-- violate Foreign Key constraints (aid '2' is reference to id in Actor table however id 2 does not exists)
INSERT INTO CS143.MovieActor VALUES (100,2,"Alian");
-- Teminal output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))
-- violate Foreign Key constraints (mid '1' is reference to id in Movie table however id 1 does not exists)
INSERT INTO CS143.MovieActor VALUES (1,10208,"Doorman");
-- Teminal output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
-- violate Foreign Key constraints (Director id '112' is referenced by MovieDirector)
DELETE FROM CS143.Director WHERE id = 112;
-- Teminal output: ERROR 1451 (23000): Cannot delete or update a parent row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))
-- violate Foreign Key constraints (did '3' is reference to id in Director table however id 3 does not exists)
INSERT INTO CS143.MovieDirector VALUES (3,3);
-- Teminal output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))
-- violate Foreign Key constraints (mid '1' is reference to id in Movie table however id 1 does not exists)
INSERT INTO CS143.MovieDirector VALUES (1,112);
-- Teminal output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
-- violate Foreign Key constraints (mid '1' is reference to id in Movie table however id 1 does not exists)
INSERT INTO CS143.Review VALUES ("review1", "2016-10-18 13:23:44", 1, 4, "none");
-- Teminal output: ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails (`CS143`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))
-- violate Ckeck constraints ('rating' 10 is larger than 5)
INSERT INTO CS143.Review VALUES ("review1", "2016-10-18 13:23:44", 3, 10, "none");
-- Teminal output: ERROR 1452 (23000): wrong entry '10' 'rating' is larger than 5