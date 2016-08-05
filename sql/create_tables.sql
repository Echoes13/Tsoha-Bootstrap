CREATE TABLE Trainer(
	id SERIAL PRIMARY KEY,
	name varchar(20) NOT NULL,
	password varchar(50) NOT NULL,
	level INTEGER NOT NULL,
	caught INTEGER NOT NULL
);

CREATE TABLE Pokemon(
	nr INTEGER PRIMARY KEY,
	name varchar(12) NOT NULL,
	type1 varchar(8) NOT NULL,
	type2 varchar(8),
	description varchar(400)
);

CREATE TABLE OwnedPokemon(
	trainer_id INTEGER REFERENCES Trainer(id),
	id INTEGER NOT NULL,
	pokemon_id INTEGER REFERENCES Pokemon(nr) NOT NULL,
	nick varchar(12),
	PRIMARY KEY(trainer_id,id)
);

CREATE TABLE Pokenest(
	pokemon_id INTEGER REFERENCES Pokemon(nr),
	location varchar(100),
	added DATE,
	PRIMARY KEY(pokemon_id, location)
);