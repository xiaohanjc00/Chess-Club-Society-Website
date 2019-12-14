-- Set up the database:
CREATE DATABASE chessSociety;
USE chessSociety;

-- create users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `admin` BIT(1) NOT NULL DEFAULT 0, -- 1 for admins
  `first_name` VARCHAR(255),
  `last_name` VARCHAR(255),
  `dob` DATE NOT NULL,
  `gender` CHAR(1) NOT NULL, -- 'F' OR 'M' OR 'O'
  `phone` VARCHAR(15) NOT NULL,
  `address` VARCHAR(255),
  `rating` INT(3) NOT NULL DEFAULT 100, -- chess rating
  `email` VARCHAR(255),
  `username` VARCHAR(255),
  `hashed_password` VARCHAR(255),
  PRIMARY KEY (`id`)
);

ALTER TABLE users ADD INDEX index_username (username);

-- add data to users table
INSERT INTO users(admin, first_name, last_name, dob, gender, phone, address, email, username, hashed_password) VALUES
    (1, 'Joe','Baker','1998-03-02','M',02086221092,'20 Richmond Avenue, Croydon CR46YW','jo@bakercake.com','joebaker', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (1, 'Jane','Black','1978-03-10','F',02086777092,'21 Richmond Avenue, Croydon CR4 6YW','up@down.com','chessMaster', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (1, 'Jenny','Marston','1938-05-20','F',02086228762,'345 Violet Street Mitcham MH4 6YW','jjjj_y@last.com','chessJJ', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'Jack','Wilson','1989-04-22','M',07908365587,'29 West Street, Barnet N66YW','stoyupol@aol.com','JudeKnight', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'John','Stom','1999-04-22','M',0790836541,'31 New Close, Barnet NW4 TSW','stomjo@aol.com','stomjohn', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'Zayn','Marsh','1999-04-22','M',07908365889,'19 Lumlay Drive, Kensington K1T 4FR','marsh@hotmail.com','zaynmarsh', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'Harry','Stiles','1999-04-22','O',07908365654,'20 Fort Lane, West Dulwich','direction@bt.com','harryKnight', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'Paul','North','2002-04-22','M',07907365321,'20 West Street, Birmingham B66YW','paul@gmail.com','BishopWin', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'Anna','West','1984-04-22','F',07908365123,'Flat 35, 1 Storm Drain, East Ruislip','anna.1234@kcl.ac.uk','WestBestRook', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'Paula','Smith','2000-04-22','F',07966345687,'4 Knight Close, East Ham E11 4TT','psmith@bt.com','SmithCheckMate', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi'),
    (0, 'Michelle','Xu','1991-08-22','F',07449665587,'2 North Close, West Brompton NW1 6WQ','xum@gmail.com','QueenOfChess', '$2y$10$1CgBgnp06.htQ2psJ/j7puESFfhVDz6OKR4SBRXDZV3Vzhtgt1rJi');

-- table to record banned user emails
CREATE TABLE `bannedEmails` (
  `emailID` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255),
  PRIMARY KEY (`emailID`)
);

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
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", CURRENT_DATE(), "https://cdn.pixabay.com/photo/2018/06/10/22/48/pawns-3467512_1280.jpg");


insert into posts(articleTitle, articleDesc, articleDate, articleImage, articleExpiry) values ("News article 2", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", CURRENT_DATE(), "https://cdn.pixabay.com/photo/2017/09/08/02/24/chess-2727443__480.jpg", "2019-11-30 13:00:00");

insert into posts(articleTitle, articleDesc, articleDate) values ("News article 3", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", "2019-11-10");

insert into posts(articleTitle, articleDesc, articleDate, articleExpiry) values ("News article 4", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", "2019-17-10", "2019-17-10");


CREATE TABLE `tournament` (
  `tournamentID` int(11) NOT NULL AUTO_INCREMENT,
  `tournamentOrganizer` int(11) DEFAULT NULL,
  `tournamentName` varchar(255) DEFAULT NULL,
  `tournamentDate` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `winnerID` int(11) DEFAULT NULL,
  `firstRunnerUpID` int(11) DEFAULT NULL,
  `ratingsUpdated` BIT(1) DEFAULT 0, -- 1 if ratings updated
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
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (organizerID)
    REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE `tournamentMatches` (
  `firstparticipantID` int(11) NOT NULL,
  `secondparticipantID`int(11) NOT NULL,
  `tournamentID`int(11) NOT NULL,
  `roundNumber` varchar(255) NOT NULL,
  `roundWinner`int(11) NULL,
  `roundLoser`int(11) NULL,
  PRIMARY KEY (`firstparticipantID`, `secondparticipantID`, `tournamentID`, `roundNumber`),
  FOREIGN KEY (`tournamentID`)
    REFERENCES `tournament`(`tournamentID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (firstparticipantID)
    REFERENCES users(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (`secondparticipantID`)
    REFERENCES `tournament`(`tournamentID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- create event table
DROP TABLE IF EXISTS `events`;
 CREATE TABLE `events` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `eventTitle` varchar(255) DEFAULT NULL,
  `eventDesc` TEXT DEFAULT NULL,
  `eventDate` varchar(255) DEFAULT NULL,
  `eventImage` varchar(255) DEFAULT "https://www.kclsu.org/asset/Event/6013/DisabilityHIstoryMonth2019-EventIcon-590x706.png?thumbnail_width=720&thumbnail_height=720&resize_type=ResizeWidth",
  `eventExpiry` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`eventID`)
);

CREATE TRIGGER expiryDateEvent BEFORE INSERT ON events
    FOR EACH ROW SET NEW.eventExpiry = IFNULL(NEW.eventExpiry,DATE_ADD(STR_TO_DATE(NEW.eventDate, '%Y-%m-%d'), INTERVAL 14 DAY));

--add data to events table
insert into events(eventTitle, eventDesc, eventDate, eventExpiry,eventImage) values ("Opening Event 1", "Introducing the Guys Bar Sports Night Membership Card 19/20!
From 30 pounds this membership card provides free entry to every sports night throughout the year and a free filter coffee/breakfast tea in The Shed every Thursday following a Sports Night.", "2019-09-01 21:00:00", "2019-09-01 22:00:00","https://www.kclsu.org/asset/Event/8770/membership-card-002.jpg?thumbnail_width=720&thumbnail_height=720&resize_type=ResizeWidth");

insert into events(eventTitle, eventDesc, eventDate, eventExpiry,eventImage) values ("Opening Event 2", "There are a huge number of ways that you could give your time to disability support charities across London,
and so to celebrate Disability History Month, here are three SPOTLIGHT opportunities to take a look at!
You can find even more on our Volunteering Log or get in touch with volunteering@kclsu.org if there’s something else you’re interested in.", "2019-11-22 00:00:00", "2019-11-23 00:00:00","https://www.kclsu.org/asset/Event/6013/DisabilityHIstoryMonth2019-EventIcon-590x706.png?thumbnail_width=720&thumbnail_height=720&resize_type=ResizeWidth");

insert into events(eventTitle, eventDesc, eventDate, eventExpiry,eventImage) values ("Opening Event 3", "In recognition of Disability awareness month, we would like to warmly invite you to our upcoming event
The Strive to Survive .We understand how tough it is for many first Generation/ WP students to have to go through unseen disabilities, mental health issues topped with further pressures of being
 the first in their family to go to uni or coming from a WP background. We understand the struggle! The event will be an opportunity to share your experiences and be engulfed in the warm embrace of
 those who have survived. This is also an opportunity to detox from work and relax an a warm and friendly environment with fellow students who understand your struggles.", "2019-12-04 16:00:00", "2019-12-04 18:00:00","https://www.kclsu.org/asset/Event/6013/DisabilityHIstoryMonth2019-EventIcon-590x706.png?thumbnail_width=720&thumbnail_height=720&resize_type=ResizeWidth");

