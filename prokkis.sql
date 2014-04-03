CREATE TABLE `juusokos`.`simple_users`(
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`username` VARCHAR(30) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`password` CHAR(128) NOT NULL,
	`salt` CHAR(128) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `juusokos`.`simple_login_attempts`(
	`user_ID` int(11) NOT NULL,
	`time` VARCHAR(30) NOT NULL,
	FOREIGN KEY (user_ID) references simple_users(ID)
) ENGINE = InnoDB;

CREATE TABLE `juusokos`.`simple_themes`(
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`theme_url` VARCHAR(60) NOT NULL,
	`font` CHAR(60) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `juusokos`.`simple_banner`(
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`banner_url` VARCHAR(60) NOT NULL,
	`banner_url_thumb` VARCHAR(60) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `juusokos`.`simple_sites`(
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`user_ID` int(11) NOT NULL,
	FOREIGN KEY (user_ID) references simple_users(ID),
	`theme_ID` int(11) NOT NULL,
	FOREIGN KEY (theme_ID) references simple_themes(ID),
	`banner_ID` int(11) NOT NULL,
	FOREIGN KEY (banner_ID) references simple_banner(ID),
	`about` VARCHAR(300) NOT NULL,
	`blog_title` VARCHAR(50) NOT NULL,
	`blog_description` VARCHAR(100) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `juusokos`.`simple_posts`(
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`site_ID` int(11) NOT NULL,
	FOREIGN KEY (site_ID) references simple_sites(ID),
	`title` VARCHAR(30) NOT NULL,
	`image_url` VARCHAR(60) NOT NULL,
	`content` VARCHAR(500) NOT NULL,
	`date` DATE NOT NULL
) ENGINE = InnoDB;


INSERT INTO `juusokos`.`simple_users` VALUES(
	, 
	'test_user', 
	'test@example.com',
	'QBsJ6rPAE9TKVJIruAK+yP1TGBkrCnXyAdizcnQpCA+zN1kavT5ERTuVRVW3oIEuEIHDm3QCk/dl6ucx9aZe0Q==',
	'401b09eab3c013d4ca54922bb802bec8fd5318192b0a75f201d8b3727429080fb337591abd3e44453b954555b7a0812e1081c39b740293f765eae731f5a65ed1'
);

INSERT INTO `juusokos`.`simple_themes` VALUES(
	,
	`theme_url`,
	`font`
);

INSERT INTO `juusokos`.`simple_sites` VALUES(
	1,
	3,
	1,
	1,
	'Olen paras ja asdfjasfjkafejhafsjk',
	'Paras Blogi',
	'Paras Blogi kertoo parhaista ashjasfjihfadjhafdj aisoista'
);

INSERT INTO `juusokos`.`simple_posts` VALUES(
	1,
	1,
	'Paras Posti',
	'http://users.metropolia.fi/~juusokos/Untitled-1.jpg',
	'liirumlaarumia',
	'2014-02-02' 
); 
