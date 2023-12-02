--
-- Table `userinformation`
--
DROP TABLE IF EXISTS `hobbies`;
DROP TABLE IF EXISTS `follows`;
DROP TABLE IF EXISTS `comments`;
DROP TABLE IF EXISTS `blogstags`;
DROP TABLE IF EXISTS `blogs`;
DROP TABLE IF EXISTS `userinformation`;
CREATE TABLE `userinformation` (
  `username` varchar(45)  NOT NULL,
  `password` varchar(45)  NOT NULL,
  `firstName` varchar(45)  DEFAULT NULL,
  `lastName` varchar(45)  DEFAULT NULL,
  `email` varchar(100)  DEFAULT NULL,
  PRIMARY KEY (`username`)
);
LOCK TABLES `userinformation` WRITE;
INSERT INTO `userinformation` VALUES ('batman','1234','bat','bat','nananana@batman.com'),
('bob','12345','bob','bob','bobthatsme@yahoo.com'),
('catlover','abcd','cat','cat','catlover@whiskers.com'),
('doglover','efds','dog','dog','doglover@bark.net'),
('jdoe','25478','joe','jod','jane@doe.com'),
('jsmith','1111','john','smith','jsmith@gmail.com'),
('matty','2222','mat','mat','matty@csun.edu'),
('notbob','5555','not','bob','stopcallingmebob@yahoo.com'),
('pacman','9999','pacman','pacman','pacman@gmail.com'),
('scooby','8888','scoby','scoby','scooby@doo.net');
UNLOCK TABLES;
--
-- Table `blogs`
--
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `blogid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `pdate` date DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`blogid`),
  KEY `FK1_idx` (`description`),
  KEY `FK1` (`created_by`),
  CONSTRAINT `FK1` FOREIGN KEY (`created_by`) REFERENCES `userinformation` (`username`)
);
LOCK TABLES `blogs` WRITE;
INSERT INTO `blogs` VALUES (1,'Hello World','Hey everyone, this is my first blog. 
Hello world and all who inhabit it!','2020-03-15','jsmith'),(2,'I love cats!','Cats
are amazing. Theyre awesome, and fuzzy, and cute. Who DOESNT love cats?','2020-
03-17','catlover'),(3,'Dogs are the best.','So I saw a post the other day talking 
about cats. Now, I love cats. They\'re great. But heres the thing: dogs are just 
the best, okay? Theres no question about it. That is all.','2020-03-
19','doglover'),(4,'I am the night.','To all you lowly criminals out there, this is
a warning to know I am watching. I am justice. I am righteousness. I am the 
NIGHT.','2020-03-24','batman'),(5,'Waka waka','waka waka waka waka waka waka waka 
waka waka waka waka waka waka waka waka waka','2020-03-31','pacman'),(6,'Who is 
this Bob guy?','Decided to start tracking down this mysterious human known 
as Bob. Who is Bob? What does he do? WHY does he do it? There is a lot of 
mystery surrounding this person, and I will be going into detail in future posts. 
Stay tuned!','2020-04-02','notbob'),(7,'Re: I love cats.','A reader recently 
reached out to me about my last post. To be clear, I\'m not dissing our canine 
companions! But weve got to be honest here, why are cats better? Theyre smart, 
affectionate, and great cuddle partners. Cats are better. Its just fact.','2020-
04-04','catlover'),(8,'Scooby Dooby Doo!','The search for scooby snacks: Where did 
they go? I know this whole quarantine thing is affecting businesses, but arent 
scooby snacks counted as an essential service? Please post below if you find 
anything! Im going crazy here!','2020-04-05','scooby'),(9,'Bob Update','Dear 
readers, I know you have been waiting anxiously for an update on Bob, but there is 
not much to share so far. He appears to have little to no online presence. Just a 
clarification: I am decidedly NOT Bob. Thanks all. Stay tuned for more!','2020-04-
06','notbob'),(10,'Lizard People.','What are your guys thoughts on them? I, for 
one, welcome out reptitlian overlords.','2020-04-12','jdoe');
UNLOCK TABLES;
--
-- Table `blogstags`
--
DROP TABLE IF EXISTS `blogstags`;
CREATE TABLE `blogstags` (
  `blogid` int(10) unsigned NOT NULL,
  `tag` varchar(20) NOT NULL,
  PRIMARY KEY (`blogid`,`tag`),
  CONSTRAINT `blogstags_ibfk_1` FOREIGN KEY (`blogid`) REFERENCES `blogs` 
(`blogid`)
);
LOCK TABLES `blogstags` WRITE;
INSERT INTO `blogstags` VALUES (1,'hello world'),(2,'animals'),(2,'cats'),
(3,'animals'),(3,'dogs'),(4,'crime'),(4,'justice'),(5,'cartoon'),(5,'waka'),
(6,'bob'),(6,'update'),(7,'cats'),(7,'dogs'),(8,'dogs'),(8,'quarantine'),(8,'scooby
snacks'),(9,'bob'),(9,'update'),(10,'lizards');
UNLOCK TABLES;
--
-- Table `comments`
--
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `sentiment` varchar(20) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `blogid` int(10) unsigned DEFAULT NULL,
  `posted_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`commentid`),
  KEY `comments_ibfk_1` (`blogid`),
  KEY `comments_ibfk_2` (`posted_by`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blogid`) REFERENCES `blogs` 
(`blogid`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`posted_by`) REFERENCES `userinformation` 
(`username`),
  CONSTRAINT `sentiment_types` CHECK ((`sentiment` in 
(_utf8mb4'negative',_utf8mb4'positive')))
);
LOCK TABLES `comments` WRITE;
INSERT INTO `comments` VALUES (1,'negative','Cats are cool and all, but dogs are 
where its at.','2020-03-17',2,'doglover'),(2,'negative','Whats all the hype 
about? Cats are clearly superior.','2020-03-20',3,'catlover'),
(3,'positive','Nice.','2020-03-20',4,'scooby'),(4,'positive','Who IS Bob? I cant 
wait to find out.','2020-04-02',6,'jsmith'),(5,'negative','I guess cat people just 
dont know what theyre missing.','2020-04-05',7,'doglover'),(6,'positive','This 
is totally unrelated, but I just wanted to say I am a HUGE fan of yours. I love 
your work!','2020-04-05',8,'doglover'),(7,'positive','Have you checked out Dog-
Mart? Theyve got everything.','2020-04-06',8,'matty'),(8,'negative','I was hoping
thered be more of an update. Sorry, Bob.','2020-04-07',9,'jsmith'),
(9,'positive','I think theyre all secretly cats. Open your eyes, sheeple!','2020-
04-13',10,'doglover'),(10,'negative','Who? Me? Multimillionaire philanthropist of 
Arkham? A lizard person? Nope. Nothing to see here!','2020-04-15',10,'batman');
UNLOCK TABLES;
--
-- Table 'follows`
--
DROP TABLE IF EXISTS `follows`;
CREATE TABLE `follows` (
  `leadername` varchar(45) NOT NULL,
  `followername` varchar(45) NOT NULL,
  PRIMARY KEY (`leadername`,`followername`),
  KEY `follows_ibfk_2` (`followername`),
  CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`leadername`) REFERENCES `userinformation` 
(`username`),
  CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`followername`) REFERENCES `userinformation` 
(`username`)
);
LOCK TABLES `follows` WRITE;
INSERT INTO `follows` VALUES ('jsmith','bob'),('batman','catlover'),
('doglover','catlover'),('pacman','catlover'),('catlover','doglover'),
('jsmith','jdoe'),('bob','notbob'),('jdoe','notbob'),('batman','pacman'),
('scooby','pacman'),('doglover','scooby'),('pacman','scooby');
UNLOCK TABLES;
--
-- Table `hobbies`
--
DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE `hobbies` (
  `username` varchar(45)  NOT NULL,
  `hobby` varchar(20) NOT NULL,
  PRIMARY KEY (`hobby`,`username`),
  KEY `hobbies_ibfk_1` (`username`),
  CONSTRAINT `hobbies_ibfk_1` FOREIGN KEY (`username`) REFERENCES `userinformation` (`username`)
);
LOCK TABLES `hobbies` WRITE;
INSERT INTO `hobbies` VALUES ('batman','movie'),('bob','movie'),
('catlover','movie'),('doglover','hiking'),('jdoe','dancing'),('jdoe','movie'),
('jsmith','hiking'),('matty','bowling'),('notbob','calligraphy'),
('pacman','dancing'),('pacman','movie'),('scooby','cooking');
UNLOCK TABLES;