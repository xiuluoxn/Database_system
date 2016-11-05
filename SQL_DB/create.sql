-- create movie table
CREATE TABLE Movie(
	-- Every movie has a unique identification number
	id         INTEGER NOT NULL,
	-- Every movie must have a title
	title      VARCHAR(100) NOT NULL,
	year       INTEGER,
	rating     VARCHAR(10),
	company    VARCHAR(50),
	-- Every movie has a unique identification number
	PRIMARY KEY (id),
	-- Movie number should not less than 0 or larger than 4750
	CHECK(0 <= id AND id <= 4750)
);
-- create actor table
CREATE TABLE Actor(
	-- Every actor has a unique identification number
	id         INTEGER NOT NULL,
	-- Every actor must has last name
	last       VARCHAR(20) NOT NULL,
	-- Every actor must has first name
	first      VARCHAR(20) NOT NULL,
	-- Every actor must identify sex
	sex        VARCHAR(6) NOT NULL,
	-- Every actor must have a date of birth
	dob        DATE NOT NULL,
	dod        DATE,
	-- Every actor has a unique identification number
	PRIMARY KEY (id),
	-- person ID number should not less than 0 or larger than 69000
	CHECK(0 <= id AND id <= 69000)
);
-- create director table
CREATE TABLE Director(
	-- Every director has a unique identification number
	id         INTEGER NOT NULL,
	-- Every director must has last name
	last       VARCHAR(20) NOT NULL,
	-- Every director must has last name
	first      VARCHAR(20) NOT NULL,
	-- Every director must have a date of birth
	dob        DATE NOT NULL,
	dod        DATE,
	-- Every director has a unique identification number
	PRIMARY KEY (id),
	-- person ID number should not less than 0 or larger than 69000
	CHECK(0 <= id AND id <= 69000)
) ENGINE=INNODB;
-- create moviegenre table
CREATE TABLE MovieGenre(
	-- Every movie has a unique identification number 
	mid        INTEGER NOT NULL,
	-- Every movie belongs to a genre 
	genre      VARCHAR(20) NOT NULL,
	-- Every movie has a unique identification number 
	FOREIGN KEY (mid) references Movie(id)
) ENGINE=INNODB;
-- create movieDirector table
CREATE TABLE MovieDirector(
	-- Every movie has a unique identification number
	mid        INTEGER NOT NULL,
	-- Every director has a unique identification number
	did        INTEGER NOT NULL,
	-- Every movie has a unique identification number
	FOREIGN KEY (mid) references Movie(id),
	-- Every director has a unique identification number
	FOREIGN KEY (did) references Director(id)
) ENGINE=INNODB;
-- create movieActor table
CREATE TABLE MovieActor(
	-- Every movie has a unique identification number
	mid        INTEGER NOT NULL,
	-- Every actor has a unique identification number
	aid        INTEGER NOT NULL,
	-- Every actor must has a role
	role       VARCHAR(50) NOT NULL,
	-- Every movie has a unique identification number
	FOREIGN KEY (mid) references Movie(id),
	-- Every actor has a unique identification number
	FOREIGN KEY (aid) references Actor(id)
) ENGINE=INNODB;
-- create review table
CREATE TABLE Review(
	name       VARCHAR(20),
	time       TIMESTAMP,
	-- Every movie has a unique identification number
	mid        INTEGER NOT NULL,
	rating     INTEGER,
	comment    VARCHAR(500),
	-- Every movie has a unique identification number
	FOREIGN KEY (mid) references Movie(id),
	-- Rating should start from 0 to 5
	CHECK(0 <= rating AND rating <= 5)
) ENGINE=INNODB;
-- create MaxPersonID table
CREATE TABLE MaxPersonID(
	id         INTEGER
);
-- create MaxMovieID table
CREATE TABLE MaxMovieID(
	id         INTEGER
);