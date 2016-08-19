INSERT INTO Trainer (name, password, level, caught) VALUES ('Ash', 'Pikachu1', 5, 1);
INSERT INTO Trainer (name, password, level, caught) VALUES ('Misty', 'Togepi2', 5, 3);
INSERT INTO Trainer (name, password, level, caught) VALUES ('Brock', 'Onix3', 7, 5);


INSERT INTO Pokemon(nr, name, type1, type2, description) VALUES (1, 'Bulbasaur', 'grass', 'poison', 'An adorably cute little starter pokémon.');
INSERT INTO Pokemon(nr, name, type1, description) VALUES (7, 'Squirtle', 'water', 'An adorably cute little starter pokémon.');
INSERT INTO Pokemon(nr, name, type1, description) VALUES (8, 'Wartortle', 'water', 'A tough-looking turtle.');
INSERT INTO Pokemon(nr, name, type1, description) VALUES (10, 'Caterpie', 'bug', 'An adorable little bug-pokémon.');
INSERT INTO Pokemon(nr, name, type1, description) VALUES (11, 'Metapod', 'bug', 'An adorable little cocoon.');
INSERT INTO Pokemon(nr, name, type1, type2, description) VALUES (12, 'Butterfree', 'bug', 'flying', 'An adorable little butterfly.');


INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (1, 1, 1, 'Bulbasaur');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (2, 7, 1, 'Squirtle');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (2, 7, 2, 'Squip');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (2, 8, 3, 'Warry');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (3, 10, 1, 'Caterpie');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (3, 11, 2, 'Meta');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (3, 12, 3, 'Butterfly');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (3, 1, 4, 'Bubby');
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id, nick) VALUES (3, 7, 5, 'Squiido');


INSERT INTO Pokenest (pokemon_id, location, added) VALUES (1, 'Porvoo, Runebergin puistossa patsaan kohdalla', NOW());
INSERT INTO Pokenest (pokemon_id, location, added) VALUES (7, 'Porvoo, Glückauf-laivan edessä', NOW());
