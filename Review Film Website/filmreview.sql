-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2026 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmreview`
--
-- --------------------------------------------------------
--
-- Table structure for table `contact`
--
CREATE TABLE
  `contact` (
    `id` int (11) NOT NULL,
    `name` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL,
    `message` text DEFAULT NULL,
    `reply` text DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--
INSERT INTO
  `contact` (`id`, `name`, `email`, `message`, `reply`)
VALUES
  (
    15,
    'Phan Minh Huy',
    'pmhuy2123@gmail.com',
    'Can u help me delete the descriptions??? and fix the \"Home\" buttons',
    'Sure I have checked please double check it asap.'
  ),
  (
    17,
    'Tommy Shelby',
    'Tommy888@gmail.com',
    'How i can access this page ?',
    'Hi, i got your informations.'
  ),
  (
    18,
    'Minh Huy Phan',
    'pmhuy09123@gmail.com',
    'Hi admin, can u help me remove the poster pls??',
    'Yes for sure. Please check your review again.'
  );

-- --------------------------------------------------------
--
-- Table structure for table `film`
--
CREATE TABLE
  `film` (
    `id` int (11) NOT NULL,
    `title` varchar(255) DEFAULT NULL,
    `description` text DEFAULT NULL,
    `year` int (11) DEFAULT NULL,
    `poster` varchar(255) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `film`
--
INSERT INTO
  `film` (`id`, `title`, `description`, `year`, `poster`)
VALUES
  (
    1,
    'Avengers : End Game',
    'Avengers: Endgame is a 2019 American superhero film based on the Marvel Comics superhero team the Avengers. Produced by Marvel Studios and distributed by Walt Disney Studios Motion Pictures, it is the direct sequel to Avengers: Infinity War (2018) and the 22nd film in the Marvel Cinematic Universe (MCU).',
    2024,
    '1775830135_MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_.jpg'
  ),
  (
    2,
    'The Dark Knight',
    'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice. As the city descends into anarchy, the Dark Knight is forced to cross the fine line between hero and vigilante. He must confront his own inner demons while trying to save a society that is rapidly turning against him.',
    2008,
    'dark.jpg'
  ),
  (
    3,
    'Interstellar',
    'In Earth\'s future, a global crop blight and second Dust Bowl are slowly rendering the planet uninhabitable. Professor Brand, a brilliant NASA physicist, is working on plans to save mankind by transporting Earth\'s population to a new home via a wormhole. A team of explorers must embark on the most important mission in human history, traveling beyond this galaxy to discover whether mankind has a future among the stars.',
    2014,
    'intel.jpg'
  ),
  (
    4,
    'John Wick',
    'An ex-hitman comes out of retirement to track down the gangsters that killed his dog and took everything from him. What starts as a relentless quest for vengeance quickly escalates into an all-out war with the Russian mafia. With a legendary reputation and a lethal set of skills, John Wick navigates the dark, secret underworld of assassins where every shadow hides a deadly enemy and no rules apply.',
    2014,
    'john2.webp'
  ),
  (
    5,
    'Family Guy',
    'Follow the hilariously offbeat adventures of the Griffin family, featuring a bumbling father, a talking dog, and a diabolical infant, as they navigate everyday life. Set in the fictional city of Quahog, Rhode Island, this satirical comedy explores the absurdities of modern society through cutaway gags and dark humor. Whether it is time travel, epic chicken fights, or musical numbers, the Griffins always find a way to turn normal situations into absolute chaos.',
    2020,
    'family.jpg'
  ),
  (
    6,
    'One Battle After Another',
    'Set in a dystopian future where resources are scarce, an intense, action-packed thriller follows a lone warrior who must survive a relentless series of conflicts against overwhelming odds to save their homeland. Moving from one desolate battleground to the next, our hero must outsmart warlords and survive harsh environments. It is a grueling test of endurance, loyalty, and the human spirit in a world that has forgotten peace.',
    2026,
    'one1.jpg'
  ),
  (
    7,
    'Peaky Blinders',
    'Tommy Shelby and his notorious family gang navigate the dangerous and shifting criminal underworld in a high-stakes battle for power and survival in post-WWI Birmingham. As their illicit empire expands from illegal betting to international smuggling, they draw the attention of rival gangs, the IRA, and a ruthless police inspector. The Shelbys must rely on their cunning, loyalty, and sheer brutality to stay on top of the food chain.',
    2026,
    'peaky.jpg'
  ),
  (
    8,
    'Invincible',
    'A teenager discovers his father is the most powerful superhero on the planet, but as he develops his own powers, he realizes his father\'s legacy may not be as heroic as it seems. Navigating the trials of high school is hard enough, but balancing it with secret alien threats, government agencies, and violent supervillains pushes him to his limits. He must decide what kind of hero he wants to be in a morally grey world.',
    2026,
    'invi.jpg'
  ),
  (
    10,
    'Minecraft',
    'A blocky adventure where creativity and survival go hand-in-hand. Build incredible structures by day and defend against dangerous creatures by night in this boundless, procedurally generated world. From mining deep underground for precious diamonds to traveling to alternate dimensions like the Nether and the End, the possibilities are infinite. Whether playing solo or collaborating with friends, every player creates their own unique story and shapes the universe around them.',
    2018,
    'mine.png'
  ),
  (
    12,
    'Cinderella ',
    'The timeless fairy tale of a kind-hearted young woman who, with the help of her Fairy Godmother, overcomes her wicked stepfamily to attend the royal ball. Despite the cruel treatment she endures daily, she maintains her courage and kindness. A magical evening, a beautiful glass slipper, and a race against the midnight clock lead to an unforgettable romance that proves dreams really do come true.',
    1888,
    'cin.webp'
  ),
  (
    20,
    'The Walking Dead : All Out War',
    '\"All Out War\" is the main storyline of The Walking Dead season 8, focusing on the conflict between Rick Grimes and Negan. Season 8 consists of 16 episodes, beginning in October 2017. It features intense battles between the militia forces (Alexandria, Hilltop, Kingdom) and Negan\'s Saviors.',
    2016,
    'walkingdead.webp'
  );

-- --------------------------------------------------------
--
-- Table structure for table `genre`
--
CREATE TABLE
  `genre` (
    `id` int (11) NOT NULL,
    `name` varchar(255) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--
INSERT INTO
  `genre` (`id`, `name`)
VALUES
  (1, 'Horror'),
  (2, 'Sci-fi'),
  (3, 'Action'),
  (4, 'Comedy'),
  (5, 'Thriller'),
  (6, 'Romance'),
  (7, 'Fantasy'),
  (8, 'Animation'),
  (9, 'Adventure'),
  (10, 'Mystery'),
  (11, 'Documentary'),
  (12, 'Biography'),
  (13, 'Crime'),
  (14, 'Family'),
  (15, 'Musical');

-- --------------------------------------------------------
--
-- Table structure for table `review`
--
CREATE TABLE
  `review` (
    `id` int (11) NOT NULL,
    `reviewtext` text DEFAULT NULL,
    `reviewdate` date DEFAULT NULL,
    `reviewerid` int (11) DEFAULT NULL,
    `poster` varchar(255) DEFAULT NULL,
    `filmid` int (11) DEFAULT NULL,
    `rating` int (1) NOT NULL DEFAULT 5
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `review`
--
INSERT INTO
  `review` (
    `id`,
    `reviewtext`,
    `reviewdate`,
    `reviewerid`,
    `poster`,
    `filmid`,
    `rating`
  )
VALUES
  (
    58,
    'Awesome Film!!!',
    '2026-04-10',
    9,
    NULL,
    2,
    4
  ),
  (
    61,
    '123',
    '2026-04-12',
    9,
    '1775987476_MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_.jpg',
    3,
    5
  );

-- --------------------------------------------------------
--
-- Table structure for table `reviewer`
--
CREATE TABLE
  `reviewer` (
    `id` int (11) NOT NULL,
    `name` varchar(255) DEFAULT NULL,
    `email` varchar(255) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `reviewer`
--
INSERT INTO
  `reviewer` (`id`, `name`, `email`)
VALUES
  (9, 'Johny Dang', 'JohnyDang222@gmail.com'),
  (10, 'Admin', 'admin123@gmail.com'),
  (12, 'Minh Huy Phan', 'pmhuy2123@gmail.com');

-- --------------------------------------------------------
--
-- Table structure for table `reviewgenre`
--
CREATE TABLE
  `reviewgenre` (
    `reviewid` int (11) DEFAULT NULL,
    `genreid` int (11) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `reviewgenre`
--
INSERT INTO
  `reviewgenre` (`reviewid`, `genreid`)
VALUES
  (NULL, 2),
  (NULL, 3),
  (NULL, 2),
  (NULL, 3),
  (NULL, 3),
  (NULL, 12),
  (NULL, 2),
  (NULL, 3),
  (NULL, 1),
  (NULL, 2),
  (NULL, 2),
  (NULL, 3),
  (58, 1),
  (58, 2),
  (58, 7),
  (61, 15);

--
-- Indexes for dumped tables
--
--
-- Indexes for table `contact`
--
ALTER TABLE `contact` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review` ADD PRIMARY KEY (`id`),
ADD KEY `fk_review_reviewer` (`reviewerid`),
ADD KEY `fk_review_film` (`filmid`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer` ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reviewgenre`
--
ALTER TABLE `reviewgenre` ADD KEY `fk_reviewgenre_review` (`reviewid`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 19;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 21;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 16;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 62;

--
-- AUTO_INCREMENT for table `reviewer`
--
ALTER TABLE `reviewer` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 16;

--
-- Constraints for dumped tables
--
--
-- Constraints for table `review`
--
ALTER TABLE `review` ADD CONSTRAINT `fk_review_film` FOREIGN KEY (`filmid`) REFERENCES `film` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_review_reviewer` FOREIGN KEY (`reviewerid`) REFERENCES `reviewer` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviewgenre`
--
ALTER TABLE `reviewgenre` ADD CONSTRAINT `fk_reviewgenre_review` FOREIGN KEY (`reviewid`) REFERENCES `review` (`id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;