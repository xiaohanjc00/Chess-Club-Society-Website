CREATE DATABASE chessSociety;

-- create users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  id INT(11) NOT NULL AUTO_INCREMENT,
  admin BIT(1) NOT NULL, -- 1 for admins
  first_name VARCHAR(255),
  last_name VARCHAR(255),
  dob DATE NOT NULL,
  gender CHAR(1) NOT NULL,
  phone VARCHAR(15) NOT NULL,
  address VARCHAR(255),
  email VARCHAR(255),
  username VARCHAR(255),
  hashed_password VARCHAR(255),
  PRIMARY KEY (id)
);

ALTER TABLE users ADD INDEX index_username (username);


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
