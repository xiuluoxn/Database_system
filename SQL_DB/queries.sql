-- select all the actors in the movie 'Die Another Day' and print their first name and last name seperate by a single space.
SELECT CONCAT(first,' ',last) Name FROM CS143.MovieActor MA, CS143.Movie M, CS143.Actor A WHERE MA.mid =M.id AND MA.aid = A.id AND M.title = 'Die Another Day';
-- the count of all the actors who acted in multiple movies
SELECT COUNT(*) FROM (SELECT COUNT(*) FROM CS143.MovieActor MA GROUP BY aid HAVING COUNT(mid) > 1) actors;
-- the count of all the director who conducts less than 3 movies
SELECT COUNT(*) FROM (SELECT COUNT(*) FROM CS143.MovieDirector MD GROUP BY did HAVING COUNT(mid) < 3) directors;
-- list the name of moive both director and actors are known
SELECT title FROM CS143.MovieActor MA, CS143.MovieDirector MD, CS143.Movie M WHERE MA.mid = MD.mid AND M.id = MA.mid AND M.id = MD.mid; 