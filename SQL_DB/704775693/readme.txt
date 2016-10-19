Our team seperate the tasks as follew:
    Ning : create,load and violates.sql
    Aozhu: query.php and queries.sql

query.php:
  1. the page is directly connected to CS143 table with user name "cs143" and empty password.
  2. when no record found, the page will show No Record Found.
  3. The page only supports SELECT statement.
  4. I assume that users will always issue correct SELECT queries and all user inputs can be trusted

create.sql:
  1. All the tables are created based on the information given.
  2. I include some NOT NULL constraints, three primary key constraints, six referential integrity 	    	 constraints, and four CHECK constraints.

load.sql:
  1. for this part, I assume that all the data files are located in ~/data/ folder. Therefore if the file need 	    to be tested, please have files in ~/data/. THIS IS THE ONLY ABSOLUTE DIREC.
  2. The value 69000 and 4750 is inserted into table MaxPersonID and MaxMovieID.

queries.sql
  1. I included 3 queries. Two queries answer the questions. The third one is to obtain names of moives that 	  both director(s) and actors are known.
  2. The english description is above the queries.  

violate.sql:
  1. didn't give the query for NOT NULL constraints.
  2. the comments above the queries are the constraints that the statements violated and the explain why it 	 violate the constraint.
  3. the comments below the queries are the output from the mysql. For CHECK constraints, I made up the output 	    because mysql doesn't support CHECK constraints.
  4. The file is not excutable.
