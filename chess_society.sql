-- Using MySQL on Codenvy:

-- $ sudo service mysql start
-- > mysql -u root
-- > create database chessSociety;
-- > show databases;
-- > use chessSociety;
-- > show tables;
-- > describe users;
-- > describe posts;
-- > exit;

-- Set up the database:

CREATE DATABASE chessSociety;

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
  `picture` varchar(255) DEFAULT "https://cdn3.f-cdn.com/contestentries/1376995/30494909/5b566bc71d308_thumb900.jpg",
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
  PRIMARY KEY (`articleID`)
);

-- add data to posts table

insert into posts(articleTitle, articleDesc, articleDate, articleImage) values ("News article 1", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", NOW(), "https://cdn.pixabay.com/photo/2018/06/10/22/48/pawns-3467512_1280.jpg");

insert into posts(articleTitle, articleDesc, articleDate, articleImage) values ("News article 2", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", "2019-11-13 13:00:00", "https://cdn.pixabay.com/photo/2017/09/08/02/24/chess-2727443__480.jpg");

insert into posts(articleTitle, articleDesc, articleDate) values ("News article 3", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", "2019-11-10 13:00:00");

insert into posts(articleTitle, articleDesc, articleDate) values ("News article 4", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
tincidunt, diam vitae vulputate feugiat, sapien mauris vehicula lectus, ac ornare ligula ante in mi. Nam eget nunc nec nunc auctor scelerisque. Sed
suscipit maximus interdum. Donec suscipit laoreet velit, eu interdum lorem ultrices in. Etiam dapibus dapibus purus, ut imperdiet velit scelerisque e
get. Phasellus consequat massa at eros gravida volutpat. Maecenas sollicitudin pharetra felis, et mattis arcu facilisis eu. Vestibulum vitae magna se
d leo tristique egestas. Phasellus aliquam purus eu justo commodo semper. Morbi sed ipsum tempor, facilisis justo non, facilisis urna. Vivamus lacus
quam, lobortis quis ipsum a, varius tincidunt arcu. Proin eu pretium quam. Mauris commodo mauris eu purus tempor, in rutrum elit gravida.", "2019-17-10 13:00:00");
