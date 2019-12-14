-- Set up the database:
CREATE DATABASE chessSociety;
USE chessSociety;

-- create users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `admin` BIT(1) NOT NULL DEFAULT 0, -- 1 for admins
  `system_admin` BIT(1) NOT NULL DEFAULT 0, -- 1 for system-admin
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

insert into posts(articleTitle, articleDesc, articleDate, articleExpiry) values ("Indian Chess legend Vishy Anand turns 50", "Viswanathan Anand turned 50 today, Wednesday 11th December 2019. To celebrate, chess24’s FM Joachim Iglesias takes a look at some of the highlights of the incredible career of the Indian superstar, who became his country’s first grandmaster before going on to win the World Championship title in all possible formats. \n 50 His age
11 December 1969 His date of birth \n
6 The age at which Vishy learned to play chess \n
1988 The year he earned the grandmaster title \n
5 The number of World Championship titles he's won \n
4 The number of times he reached the World Championship final but didn't win \n
2817 His peak rating \n
15th His current world ranking \n 
(Source: https://chess24.com/en/read/news/indian-chess-legend-vishy-anand-turns-50)", CURRENT_DATE(), "2020-10-20");

insert into posts(articleTitle, articleDesc, articleDate, articleExpiry) values ("Magnus Carlsen wins Chess World Championship 2018 after beating Fabiano Caruana in tie-breakers",
"Magnus Carlsen retained his world chess crown after finally seeing off the challenge of American Fabiano Caruana in a best-of-four tie-breakers. \n
Carlsen won the first three tie-breakers to end the impasse after the pair had drawn all 12 of their matches, something unprecedented in the 132-year history of the competition. \n
The Norwegian grandmaster sealed the third defence of a world title that he first won in 2013, dominated the much faster format used to decide a drawn match. \n
Carlsen also takes away the €1m (£880,000) top prize. \n
(Source: https://www.independent.co.uk/sport/general/world-chess-championship-2018-magnus-carlsen-fabiano-caruana-a8656916.html)", CURRENT_DATE(), "2020-10-20");

insert into posts(articleTitle, articleDesc, articleDate, articleExpiry) values ("World Chess Championship: All you need to know about the most nail-biting sporting event right now", "Why should I care? \n
The world’s poster boy of chess is taking on a Kremlin-backed Russian grandmaster on Wednesday in a match that is already stoking Cold War sentiment. \n
Norwegian world No 1 Magnus Carlsen will play Sergey Karjakin for the 2016 World Chess Championship crown. But this isn’t just any old chess match. Pundits are drawing, and overhyping, parallels with the legendary 1972 “match of the century” between American Bobby Fischer and the Soviet Union’s Boris Spassky. \n
Fischer’s defeat of Spassky, which made front pages around the world, was seen as a blow to the Soviet Union’s intellectual superiority at the height of the Cold War.  \n
Now, the denouement of professional chess will be played in the US for the first time since the 1995 final. \n
Who are the players? \n
Karjakin, who was born in the Ukrainian Crimea, became a Russian citizen in 2009 and has shown support for President Vladimir Putin. The 26-year-old posted a photo on his Instagram account in 2014 showing him wearing a T-shirt with Mr Putin’s face on it and a message reading: We do not let our people down. \n
'I would describe him as a political opportunist,' said British grandmaster Nigel Short, speaking to The Guardian. 'Karjakin is totally backed by Putin and the Russian machine. The state wants him to do well.' \n
Carlsen, who became a grandmaster at 13, won his first world championship in 2013, and has the highest chess rating in history. \n
The 25-year-old G-Star Raw model, selected as one of Cosmopolitan’s sexiest men of 2013, was asked to be in JJ Abrams’ 2013 Star Trek Into Darkness movie, but could not get a US work permit in time for shooting. \n
(Source: https://www.independent.co.uk/news/world/world-chess-championship-everything-need-to-know-explained-magnus-carlsen-a7447331.html)", CURRENT_DATE(), "2020-10-20");



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
  `firstparticipantoldelo`INT(3) NOT NULL,
  `secondparticipantoldelo`INT(3) NOT NULL,
  `firstparticipantnewelo`INT(3) NULL,
  `secondparticipantnewelo`INT(3) NULL,
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

-- Source: https://www.kclsu.org/ents/event/7069/
insert into events(eventTitle, eventDesc, eventDate, eventExpiry,eventImage) values ("Upcoming Event: Sports Night!", "Introducing the Guys Bar Sports Night Membership Card 19/20!
From 30 pounds this membership card provides free entry to every sports night throughout the year and a free filter coffee/breakfast tea in The Shed every Thursday following a Sports Night.", "2019-09-01 21:00:00", "2019-09-01 22:00:00","https://www.kclsu.org/asset/Event/8770/membership-card-002.jpg?thumbnail_width=720&thumbnail_height=720&resize_type=ResizeWidth");

-- Source: https://www.kclsu.org/ents/event/7694/
insert into events(eventTitle, eventDesc, eventDate, eventExpiry,eventImage) values ("Upcoming Event: SPOTLIGHT", "There are a huge number of ways that you could give your time to disability support charities across London,
and so to celebrate Disability History Month, here are three SPOTLIGHT opportunities to take a look at!
You can find even more on our Volunteering Log or get in touch with volunteering@kclsu.org if there’s something else you’re interested in.", "2019-11-22 00:00:00", "2019-11-23 00:00:00","https://www.kclsu.org/asset/Event/6013/DisabilityHIstoryMonth2019-EventIcon-590x706.png?thumbnail_width=720&thumbnail_height=720&resize_type=ResizeWidth");

-- Source: https://www.kclsu.org/ents/event/7069/
insert into events(eventTitle, eventDesc, eventDate, eventExpiry,eventImage) values ("Upcoming Event: Strive to Survive", "In recognition of Disability awareness month, we would like to warmly invite you to our upcoming event
The Strive to Survive .We understand how tough it is for many first Generation/ WP students to have to go through unseen disabilities, mental health issues topped with further pressures of being
 the first in their family to go to uni or coming from a WP background. We understand the struggle! The event will be an opportunity to share your experiences and be engulfed in the warm embrace of
 those who have survived. This is also an opportunity to detox from work and relax an a warm and friendly environment with fellow students who understand your struggles.", "2019-12-04 16:00:00", "2019-12-04 18:00:00","https://www.kclsu.org/asset/Event/6013/DisabilityHIstoryMonth2019-EventIcon-590x706.png?thumbnail_width=720&thumbnail_height=720&resize_type=ResizeWidth");

