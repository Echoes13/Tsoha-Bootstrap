INSERT INTO Trainer (name, password, level, caught) VALUES ('Ash', 'Pikachu1', 5, 1);
INSERT INTO Trainer (name, password, level, caught) VALUES ('Misty', 'Togepi2', 7, 3);

INSERT INTO Pokemon (nr, name, type1, type2) VALUES (39, 'Jigglypuff', 'normal', 'fairy');
INSERT INTO Pokemon (nr, name, type1) VALUES (120, 'Staryu', 'water');
INSERT INTO Pokemon (nr, name, type1, description) VALUES (118, 'Goldeen', 'water', 'Is called "The Queen of the Sea".');

INSERT INTO OwnedPokemon (trainer_id, pokemon_id, nick, id)
VALUES ((SELECT id FROM Trainer WHERE name ='Ash'), 39, 'Pulla', 1);
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, nick, id)
VALUES ((SELECT id FROM Trainer WHERE name ='Misty'), 118, 'Goldeen', 1);
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, id)
VALUES ((SELECT id FROM Trainer WHERE name ='Misty'), 120, 2);
INSERT INTO OwnedPokemon (trainer_id, pokemon_id, nick, id)
VALUES ((SELECT id FROM Trainer WHERE name ='Misty'), 120, 'Staryu', 3);

INSERT INTO Pokenest (pokemon_id, location, added)
VALUES ((SELECT nr FROM Pokemon WHERE name ='Staryu'), 'Helsinki, Kumpulan Kampus', NOW());