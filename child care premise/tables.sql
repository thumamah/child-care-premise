

CREATE TABLE user(
id INT NOT NULL AUTO_INCREMENT,
username VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
role VARCHAR(50) NOT NULL,
PRIMARY KEY (id)
);

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'member',
  PRIMARY KEY (`user_id`)
)

INSERT INTO user (username, password, role) VALUES ('admin@gmail.com', 'admin@123', 'admin');

DROP TABLE IF EXISTS page;

CREATE TABLE page (
  or_no int(15) NOT NULL AUTO_INCREMENT,
  image varchar(100) DEFAULT NULL,
  title varchar(100) DEFAULT NULL,
  text varchar(2000) DEFAULT NULL,
  link varchar(100) DEFAULT NULL,
  link_text varchar(100) DEFAULT NULL,
  PRIMARY KEY (or_no)
);

LOCK TABLES page WRITE;

INSERT INTO page VALUES (1,'https://knuth.griffith.ie/~s3022041/project/images/pic5.jpg','New Activities',  'Our after school care is full of fun stuff, Arts & Crafts, Games, Music, Dance, Computers and also the space to unwind and relax with their friends or siblings. We know that modern life can get pretty hectic, and for busy parents, Kiddies can offer the flexibility to help out when you need extra support. For early morning starts we’ll provide a nutritious breakfast and can drop your child to school. We will also collect your child after school with a friendly face.', 'https://knuth.griffith.ie/~s3022041/project/login.php', 'join us know');

UNLOCK TABLES;

INSERT INTO page VALUES (2,'https://knuth.griffith.ie/~s3022041/project/images/gif1.gif','Special Offers',  'We aim to provide quality, affordable childcare to families.  We provide special discounts to families of 2 or more children 
                      availing of full time care. Please contact our accounts department for further details on our special family discount. At Links, 
                      we operate a sibling programme where we encourage children from families of two of more to spend valuable time together throughout 
                      the day. We understand how critically important the ‘sibling bond’ is at a young age.  The sibling relationship is one of the most 
                      important relationships in a child’s life. We believe that sibling time, can enhance a child’s sense of safety and well-being and
                      create a home-away-from-home environment within the crèche. If you wish to avail of our special family discount offer please
                      contact us at 1890 93 00 82.', 'https://knuth.griffith.ie/~s3022041/project/contactUs.php', 'Contact for more information');


INSERT INTO page VALUES (3,'https://knuth.griffith.ie/~s3022041/project/images/pic6.png','New Events',  'Each year a Graduation Ceremony is held for children graduating from our Early Childhood Care and Education (ECCE) classes.
                      Having spent several years in Links Childcare your child has embarked on their first steps on the road to developing as an
                       independent person. We believe it is important to recognise these very important steps by holding a Graduation Ceremony.
                       The graduation ceremony, marks another step in your child’s development as he/she transitions into ‘Big School’.  This event 
                       gives our pre-school graduates and opportunity to put on a show for their family and friends to display their confidence and 
                       skills which they have acquired during their time with us. The graduation marks a very special occasion, it will possibly be the first of many graduation ceremonies which you will attend
                        with your child.  Each child receives their first educational parchment to mark their sense of achievement during their time at
                         Links Childcare.  The Ceremony celebrates children’s journey into “Big School” and gives them the opportunity to dress in their 
                         first cap and gown in front of their family and friends.', 'https://knuth.griffith.ie/~s3022041/project/registration.php', 'Register Now');




CREATE TABLE contact_us(
message_id INT(12) NOT NULL AUTO_INCREMENT,
Name VARCHAR(50) NOT NULL,
Email VARCHAR(50) NOT NULL,
phone_no VARCHAR(50) NOT NULL,
Message VARCHAR(500) NOT NULL,
PRIMARY KEY (message_id)
);

CREATE TABLE testimonial(
testimonial_id INT(100) NOT NULL AUTO_INCREMENT,
service_Name VARCHAR(35) NOT NULL,
parent_name VARCHAR(50) NOT NULL,
testi_date Date not null,
comment VARCHAR(500) NOT NULL,
display varchar(4) DEFAULT 'SHOW',
PRIMARY KEY (testimonial_id)
);

CREATE TABLE service(
service_id INT(12) NOT NULL AUTO_INCREMENT,
image VARCHAR(100) NOT NULL,
name VARCHAR(100) NOT NULL,
description VARCHAR(1000) NOT NULL,
link VARCHAR(500) NOT NULL,
PRIMARY KEY (service_id)
);


INSERT INTO service VALUES (1,'https://knuth.griffith.ie/~s3022041/project/images/bus.jpg', 'School Transportation', 'Area transportation is a must for any daycare center.
                            This includes before and after school dropoffs and pickups.
                            This is a service that will save you both time and money', 'https://knuth.griffith.ie/~s3022041/project/bus.php');
INSERT INTO service VALUES (2,'https://knuth.griffith.ie/~s3022041/project/images/educator.jfif', 'Trained Supervision', 'No matter how old your children are it is integral that they are left in
                            the hands of qualified adults
                            who will be able to care for them in all sorts of situations.
                            At Kiddies Cove we have a selected team that is first aid certified and MAT certified', 'https://knuth.griffith.ie/~s3022041/project/supervision.php');
INSERT INTO service VALUES (3,'https://knuth.griffith.ie/~s3022041/project/images/peer.jpg', 'Social Skill Promotion', 'One of the most important ways that children learn is through interaction
                            with each other.
                            Our daycare center encourage children to play, grow and learn togheter. You will soon notice
                            yout childs social behaviour growing when they are placed in a friendly environment.', 'https://knuth.griffith.ie/~s3022041/project/skill.php');

INSERT INTO service VALUES (4,'https://knuth.griffith.ie/~s3022041/project/images/childday.png', 'Daily activities', 'Get to know your childrens day, whats he/she gonna eat,
                            what are the activities planned for today', 'https://knuth.griffith.ie/~s3022041/project/day_details.php');

INSERT INTO service VALUES (5,'https://knuth.griffith.ie/~s3022041/project/images/lunch.jpg', 'Lunch Service', 'Children will eat happily at the center', 'https://knuth.griffith.ie/~s3022041/project/lunch.php');
INSERT INTO service VALUES (6,'https://knuth.griffith.ie/~s3022041/project/images/bed.jpg', 'Evening sleeping bed', 'Ensuring children have enough sleep is as important as
                            feeding them healthy food and ensuring they receive plenty of fresh air and exercise.', 'https://knuth.griffith.ie/~s3022041/project/bed.php');



CREATE TABLE day(
ID INT AUTO_INCREMENT,
date Date NOT NULL,
name VARCHAR(60) NOT NULL,
temperature INT (100) NOT NULL,
breakfast VARCHAR(100) NOT NULL,
lunch VARCHAR(100) NOT NULL,
activities varchar(100) NOT NULL
);

CREATE TABLE child(
  ID INT PRIMARY KEY AUTO_INCREMENT,
  Category VARCHAR(100) NOT NULL,
  Day VARCHAR(100) NOT NULL,
  FeeID int,
  Username VARCHAR(100) NOT NULL,
  Childname VARCHAR(100) NOT NULL,
  Email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  role varchar(4) DEFAULT 'user',
  FOREIGN KEY (FeeID) REFERENCES fee(ID)
);

-- reg edit page so making the fees table
CREATE TABLE fee(
  ID INT PRIMARY KEY,
  Fee INT (50) NOT NULL,
  Day VARCHAR(100) NOT NULL,
  Duration INT(50) Not NULL
);


