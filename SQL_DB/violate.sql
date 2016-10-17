-- violate primary key constraints (id is duplicated)
INSERT INTO CS143.Movie VALUES (272,"Baby Take a Bow",1934,"PG","Fox Film Corporation");
-- Teminal output: ERROR 1062 (23000) at line 2: Duplicate entry '272' for key 'PRIMARY'

-- violate CHECK constraints (id > 4750)
INSERT INTO CS143.Movie VALUES (4751,"Baby T",1934,"PG","Fox Film Corporation");