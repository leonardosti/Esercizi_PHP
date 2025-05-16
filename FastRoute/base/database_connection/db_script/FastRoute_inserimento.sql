-- INSERIMENTO CLIENTI
INSERT INTO fastroute.clienti (nome, cognome, indirizzo, telefono, email, password, punti_fedelta) VALUES
('Mario', 'Rossi', 'Via Roma 10', 123456789, 'mario.rossi@example.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 2), -- 1234
('Luigi', 'Bianchi', 'Via Milano 20', 234567891, 'luigi.bianchi@example.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 5), -- password
('Giulia', 'Verdi', 'Piazza Dante 5', 345678912, 'giulia.verdi@example.com', '8d969eef6ecad3c29a3a629280e686cff8ca7f4e9a5f5c1d2b8b1f7c9e4f0f83', 0), -- 123456
('Anna', 'Neri', 'Corso Vittorio 12', 456789123, 'anna.neri@example.com', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', 1), -- qwerty
('Marco', 'Gialli', 'Via Torino 35', 567891234, 'marco.gialli@example.com', 'bcb2e9015f2f9e05051e13c5c7e4384733e02c875248e8a1ecbb2c8b1fa6e5f8', 3); -- abcd1234

-- INSERIMENTO SEDI
INSERT INTO fastroute.sedi (nome, citta, indirizzo) VALUES
('Sede Centrale', 'Roma', 'Via Nazionale 1'),
('Filiale Milano', 'Milano', 'Viale Italia 10'),
('Filiale Napoli', 'Napoli', 'Via Partenope 15');

-- INSERIMENTO PLICHI
INSERT INTO fastroute.plichi (consegna, spedizione, ritiro, stato, mittente, destinatario, sede_arrivo, sede_partenza) VALUES
('2025-03-20 09:15:00', '2025-03-20 10:00:00', '2025-03-21 12:30:00', 'consegnato',   1, 3, 2, 1),
('2025-03-21 14:00:00', '2025-03-21 15:00:00', NULL,                 'in_transito', 2, 4, 3, 2),
('2025-03-22 08:30:00', NULL,                 NULL,                 'in_partenza', 3, 1, 1, 3),
('2025-03-22 09:00:00', '2025-03-22 10:00:00', '2025-03-22 19:00:00', 'consegnato',   4, 2, 2, 1),
('2025-03-23 10:15:00', '2025-03-23 11:00:00', NULL,                 'in_transito', 1, 4, 3, 1),
('2025-03-23 11:30:00', NULL,                 NULL,                 'in_partenza', 5, 2, 2, 3),
('2025-03-24 08:00:00', '2025-03-24 09:00:00', '2025-03-24 18:30:00', 'consegnato',   2, 5, 3, 2);

-- INSERIMENTO PERSONALE
INSERT INTO fastroute.personale (nome, cognome, email, password, tema) VALUES
('Sara', 'Conti', 'sara.conti@fastroute.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'light'), -- password: 1234
('Luca', 'Moretti', 'luca.moretti@fastroute.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'dark'), -- password: password
('Elena', 'Ferrari', 'elena.ferrari@fastroute.com', '8d969eef6ecad3c29a3a629280e686cff8ca7f4e9a5f5c1d2b8b1f7c9e4f0f83', 'light'), -- password: 123456
('Paolo', 'Ricci', 'paolo.ricci@fastroute.com', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', 'dark'), -- password: qwerty
('Chiara', 'Greco', 'chiara.greco@fastroute.com', 'bcb2e9015f2f9e05051e13c5c7e4384733e02c875248e8a1ecbb2c8b1fa6e5f8', 'light'); -- password: abcd1234


