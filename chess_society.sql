
-- Using MySQL on Codenvy:
-- $ sudo service mysql start
-- > mysql -u root
-- > show databases;
-- > use chessSociety;
-- > show tables;
-- > describe users;
-- > describe posts;
-- > describe tournament;
-- > describe tournamentCoOrganizers;
-- > describe tournamentParticipant;
-- > exit;


-- Set up the database:

CREATE DATABASE chessSociety;
USE chessSociety;

-- create users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `admin` BIT(1) NOT NULL, -- 1 for admins
  `first_name` VARCHAR(255),
  `last_name` VARCHAR(255),
  `dob` DATE NOT NULL,
  `gender` CHAR(1) NOT NULL, -- 'F' OR 'M' OR 'O'
  `phone` VARCHAR(15) NOT NULL,
  `address` VARCHAR(255),
  `rating` INT(3) NOT NULL DEFAULT 0,
  `email` VARCHAR(255),
  `username` VARCHAR(255),
  `hashed_password` VARCHAR(255),
  PRIMARY KEY (`id`)
);

ALTER TABLE users ADD INDEX index_username (username);

-- add some test data to users table
INSERT INTO users(admin, first_name, last_name, dob, gender, phone, address, email, username, hashed_password) VALUES
    (1, 'Joe','Baker','1998-03-30','M',020862210922,'20 Richmond Avenue, Croydon CR46YW','jo@bakercake.com','joebaker','secret'),
    (0, 'Jane','Xu','1978-03-10','F',020867770922,'21 Richmond Avenue, London CWC2R4EW','up@down.com','chessy','password'),
    (0, 'Jenny','Marston','1938-05-20','F',020862287622,'20 Violet Street, Mitcham MH46YW','jjjj_y@last.com','chesser','word'),
    (0, 'Jude','Stoyanov','1999-04-22','M',020845610922,'20 West Street, Barnet N66YW','stoyupol@aol.com','JudeKnight','pass');



-- create posts table
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `articleTitle` varchar(255) DEFAULT NULL,
  `articleDesc` TEXT DEFAULT NULL,
  `articleDate` varchar(255) DEFAULT NULL,
  `articleImage` varchar(255) DEFAULT "https://www.kclsu.org/asset/Organisation/6365/36bed7b8-d864-4aec-bb62-ff643dfb4a6c.jpg?thumbnail_width=280&thumbnail_height=280&resize_type=ResizeFitAll",

  `articleExpiry` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`articleID`)
);

CREATE TRIGGER expiryDate BEFORE INSERT ON posts
    FOR EACH ROW SET NEW.articleExpiry = IFNULL(NEW.articleExpiry,DATE_ADD(STR_TO_DATE(NEW.articleDate, '%Y-%m-%d'), INTERVAL 14 DAY));

-- add data to posts table
insert into posts(articleTitle, articleDesc, articleDate, articleImage) values ("News article 1", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", NOW(), "https://cdn.pixabay.com/photo/2018/06/10/22/48/pawns-3467512_1280.jpg");


insert into posts(articleTitle, articleDesc, articleDate, articleImage, articleExpiry) values ("News article 2", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", NOW(), "https://cdn.pixabay.com/photo/2017/09/08/02/24/chess-2727443__480.jpg", "2019-11-30 13:00:00");

insert into posts(articleTitle, articleDesc, articleDate) values ("News article 3", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", "2019-11-10 13:00:00");

insert into posts(articleTitle, articleDesc, articleDate, articleExpiry) values ("News article 4", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", "2019-17-10 13:00:00", "2019-17-10 13:00:00");


CREATE TABLE `tournament` (
  `tournamentID` int(11) NOT NULL AUTO_INCREMENT,
  `tournamentOrganizer` int(11) DEFAULT NULL,
  `tournamentName` varchar(255) DEFAULT NULL,
  `tournamentDate` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `winnerID` int(11) DEFAULT NULL,
  `firstRunnerUpID` int(11) DEFAULT NULL,
  PRIMARY KEY (`tournamentID`),
  FOREIGN KEY (tournamentOrganizer)
    REFERENCES users(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);

CREATE TABLE `tournamentParticipant` (
  `participantID` int(11) NOT NULL,
  `tournamentID` int(11) NOT NULL,
  PRIMARY KEY (`participantID`, `tournamentID`),
  FOREIGN KEY (`tournamentID`)
    REFERENCES `tournament`(`tournamentID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (participantID)
    REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE `tournamentCoOrganizers` (
  `organizerID` int(11) NOT NULL,
  `tournamentID`int(11) NOT NULL,
  PRIMARY KEY (`organizerID`, `tournamentID`),
  FOREIGN KEY (`tournamentID`)
    REFERENCES `tournament`(`tournamentID`)
    REFERENCES `tournament`(`tournamentID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (organizerID)
    REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);


-- create event table
 CREATE TABLE `opening_event` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `eventTitle` varchar(255) DEFAULT NULL,
  `eventDesc` TEXT DEFAULT NULL,
  `eventDate` varchar(255) DEFAULT NULL,
  `eventImage` varchar(255) DEFAULT "https://www.kclsu.org/asset/Organisation/6365/36bed7b8-d864-4aec-bb62-ff643dfb4a6c.jpg?thumbnail_width=280&thumbnail_height=280&resize_type=ResizeFitAll",
  `eventExpiry` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`eventID`)
);

CREATE TRIGGER expiryDateEvent BEFORE INSERT ON opening_event
    FOR EACH ROW SET NEW.eventExpiry = IFNULL(NEW.eventExpiry,DATE_ADD(STR_TO_DATE(NEW.eventDate, '%Y-%m-%d'), INTERVAL 14 DAY));

--add data to opening_event table
insert into opening_event(eventTitle, eventDesc, eventDate, eventExpiry) values ("News event 1", "Introducing the Guy’s Bar Sports Night Membership Card 19/20!
From £30 this membership card provides free entry to every sports night throughout the year and a free filter coffee/breakfast tea in The Shed every Thursday following a Sports Night.", "2019-01-09 21:00:00", "2019-01-09 22:00:00");

insert into opening_event(eventTitle, eventDesc, eventDate, eventExpiry) values ("News event 2", "There are a huge number of ways that you could give your time to disability support charities across London,
and so to celebrate Disability History Month, here are three SPOTLIGHT opportunities to take a look at!
You can find even more on our Volunteering Log or get in touch with volunteering@kclsu.org if there’s something else you’re interested in.", "2019-22-11 00:00:00", "2019-23-11 00:00:00");

insert into opening_event(eventTitle, eventDesc, eventDate, eventExpiry) values ("News event 3", "Experimental Knitting Workshop: with Knit's College London and artist Rosina Godwin
ming part of ProjectX, the experimental knitting workshop uses the visual language of textile to explore sustainable issues and mental healing.  Suitable for all abilities,
 the session focuses on the potential of simple techniques to create both art and sculpture.", "2019-04-12 13:00:00", "2019-04-12 15:30:00");

insert into opening_event(eventTitle, eventDesc, eventDate, eventExpiry) values ("News event 4", "In recognition of Disability awareness month, we would like to warmly invite you to our upcoming event
‘The Strive to Survive’.We understand how tough it is for many first Generation/ WP students to have to go through unseen disabilities, mental health issues topped with further pressures of being
 the first in their family to go to uni or coming from a WP background. We understand the struggle! The event will be an opportunity to share your experiences and be engulfed in the warm embrace of
 those who have survived. This is also an opportunity to detox from work and relax an a warm and friendly environment with fellow students who understand your struggles.", "2019-04-21 16:00:00", "2019-04-12 18:00:00");
