
CREATE DATABASE IF NOT EXISTS Ashdeals;
USE Ashdeals;

DROP TABLE IF EXISTS deals;

CREATE TABLE IF NOT EXISTS deals (
	deal_id int(4) ZEROFILL NOT NULL AUTO_INCREMENT,
    location varchar(40) NOT NULL,
    day char(2) NOT NULL,
    catagory varchar(20) NOT NULL,
    deal varchar(140) NOT NULL,
    primary key (deal_id));

INSERT INTO deals (location, day, catagory, deal) VALUES

('Juicy Lucy', 'Mo', 'Burger', 'All Beer $2 / $1 off Build Your Own Burger'),
('Juicy Lucy', 'Tu', 'Burger', '$2 off pitcher / $2 off rack of ribs $2 PBR’s / Trivia @ 8pm'),
('Juicy Lucy', 'We', 'Burger', '$2 off 14oz Ribeye / $10 off Bottles of Wine / Buy a Pint Keep the Glass / Live Music @ 6pm'),
('Juicy Lucy', 'Th', 'Burger', '$2 off Pitchers of Beer / $5 Margaritas / $5 LIT’s / $5 Fried Pickles / $5 Pimento Cheese'),
('Juicy Lucy', 'Fr', 'Burger', '$1 off Flights of Beer'),
('Juicy Lucy', 'Sa', 'Burger', '$1 off Lucy’s Signature Spiked Teas & Moscow Mules'),
('Juicy Lucy', 'Su', 'Burger', '$5 Bloody Mary’s / $5.50 Lucy’s Bloody Mary / $6.00 Bacon Bloody Maria / $7.95 16oz Man-mosa / $5 8oz Mimosa'),

('Asheville Pizza & Brewing', 'Mo', 'Pizza', '$4 Grey Goose $6 Moonshine Lemonade $6 Moonshine Julep'),
('Asheville Pizza & Brewing', 'Tu', 'Pizza', '$2.50 Cans of Shiva IPA, Ninja Porter, and Rocket Girl Lager $2.50 One Topping Pizza Slices'),
('Asheville Pizza & Brewing', 'We', 'Pizza', '$4 1800 (Gold or Silver) $5 Margaritas'),
('Asheville Pizza & Brewing', 'Th', 'Pizza', '$5 Ninja Bombs $4 Jameson'),
('Asheville Pizza & Brewing', 'Fr', 'Pizza', '$4 Jagermeister $5 Baby Guinness '),
('Asheville Pizza & Brewing', 'Sa', 'Pizza', '$5 Skyy Bombs $5 Sangria (Red or White) '),
('Asheville Pizza & Brewing', 'Su', 'Pizza', '$5 Bloody Marys $5 Mimosas');


