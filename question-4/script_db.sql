CREATE SCHEMA `test_db` ;

CREATE TABLE `test_db`.`task` (
  `idtask` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  `priority` INT NULL,
  PRIMARY KEY (`idtask`));

INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 1', 'Description 1', 1);
INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 2', 'Description 2', 2);
INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 3', 'Description 3', 3);
INSERT INTO `test_db`.`task` (title, description, priority) VALUES ('Task 4', 'Description 4', 4);