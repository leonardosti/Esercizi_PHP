create database libreria;

create table libreria.libro(
titolo varchar(100),
autore varchar(100),
genere varchar(100),
prezzo float,
anno_pubblicazione datetime
);

insert into libreria.libro(titolo, autore, genere, prezzo, anno_pubblicazione) values
('Il Signore degli Anelli', 'J.R.R. Tolkien', 'Fantasy', 20.99, '1954-07-29'),
('Harry Potter e la Pietra Filosofale', 'J.K. Rowling', 'Fantasy', 15.50, '1997-06-26'),
('1984', 'George Orwell', 'Distopia', 12.00, '1949-06-08'),
('Orgoglio e pregiudizio', 'Jane Austen', 'Romanzo', 9.99, '1813-01-28'),
('Il codice Da Vinci', 'Dan Brown', 'Thriller', 18.50, '2003-03-18'),
('La Coscienza di Zeno', 'Italo Svevo', 'Psicologico', 14.00, '1923-01-01'),
('Il Piccolo Principe', 'Antoine de Saint-Exupéry', 'Fiaba', 10.99, '1943-04-06'),
('Il Grande Gatsby', 'F. Scott Fitzgerald', 'Romanzo', 13.00, '1925-04-10'),
('Moby Dick', 'Herman Melville', 'Avventura', 17.00, '1851-10-18'),
('Cime tempestose', 'Emily Brontë', 'Romantico', 16.50, '1847-12-01'),
('Don Chisciotte', 'Miguel de Cervantes', 'Satira', 22.00, '1605-01-16'),
('La Divina Commedia', 'Dante Alighieri', 'Poesia', 11.00, '1320-01-01'),
('I Promessi Sposi', 'Alessandro Manzoni', 'Romanzo', 19.00, '1827-01-01'),
('Storia della Letteratura Italiana', 'Giovanni Getto', 'Saggio', 25.00, '1945-01-01'),
('Siddhartha', 'Hermann Hesse', 'Spirituale', 12.50, '1922-01-01');