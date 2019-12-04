
-- Using MySQL on Codenvy:

<<<<<<< HEAD
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
<<<<<<< HEAD
=======
  `picture` varchar(255) DEFAULT "https://cdn3.f-cdn.com/contestentries/1376995/30494909/5b566bc71d308_thumb900.jpg",
>>>>>>> d2616689dc419f47d310f61dd7e558336c91d7b4
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
<<<<<<< HEAD
    REFERENCES `tournament`(`tournamentID`)
=======
    REFERENCES `tournament`(`tournamentID`) 
>>>>>>> d2616689dc419f47d310f61dd7e558336c91d7b4
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

CREATE TRIGGER expiryEventDate BEFORE INSERT ON opening_event
    FOR EACH ROW SET NEW.eventExpiry = IFNULL(NEW.eventExpiry,DATE_ADD(STR_TO_DATE(NEW.eventDate, '%Y-%m-%d'), INTERVAL 14 DAY));
