-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2023 at 04:06 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topscribe`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `userid` int(11) NOT NULL,
  `writingid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`userid`, `writingid`) VALUES
(1, 12),
(1, 6),
(3, 12),
(4, 10),
(1, 5),
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Essay'),
(2, 'Article'),
(3, 'Poetry');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `user1id` int(11) NOT NULL,
  `user2id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`user1id`, `user2id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `contest`
--

CREATE TABLE `contest` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL DEFAULT current_timestamp(),
  `end` datetime NOT NULL DEFAULT current_timestamp(),
  `capacity` int(11) DEFAULT NULL,
  `judgeGroup` int(11) DEFAULT NULL,
  `writerGroup` int(11) DEFAULT NULL,
  `hostID` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `subcategoryID` int(11) NOT NULL DEFAULT 19,
  `bannerurl` varchar(255) NOT NULL DEFAULT 'images/banner.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contest`
--

INSERT INTO `contest` (`id`, `title`, `description`, `start`, `end`, `capacity`, `judgeGroup`, `writerGroup`, `hostID`, `accepted`, `subcategoryID`, `bannerurl`) VALUES
(6, 'cool contest', 'description', '2023-03-06 00:45:04', '2023-03-06 00:45:04', NULL, NULL, NULL, 1, 0, 14, 'images/banner.png'),
(8, 'contest title', 'contest descrpition lorem ipsum', '2023-03-06 01:27:16', '2023-03-06 01:27:16', NULL, NULL, NULL, 2, 0, 16, 'images/banner.png'),
(9, 'awerqwer', 'asdfadsgfadfsgdfag', '2023-03-20 20:15:35', '2023-03-20 20:15:35', NULL, NULL, NULL, 1, 0, 16, 'images/banner.png'),
(10, 'new test', 'test description', '2023-04-07 13:38:00', '2023-04-20 13:38:00', 455, 0, 0, 1, 0, 6, 'images/banner.png'),
(11, 'Narrative Essay Contest', 'Write your narrative essay', '2023-04-01 14:12:00', '2023-04-09 14:12:00', 0, 0, 0, 1, 0, 2, 'https://static.vecteezy.com/system/resources/previews/000/381/578/original/vector-abstract-colorful-wave-banner-background.jpg'),
(12, 'assignment1', 'do this', '2023-03-31 15:42:00', '2023-03-31 15:42:00', 0, 0, 0, 1, 0, 15, 'https://static.vecteezy.com/system/resources/previews/000/664/622/original/abstract-banner-design-vector.jpg'),
(13, 'sdfsd', 'sdfgsdfghfs', '2023-03-31 15:47:00', '2023-03-31 15:47:00', 0, 8, 13, 1, 0, 1, 'images/banner.png'),
(14, 'mountain contest', 'write a narrative essay on mountains', '2023-03-31 15:56:00', '2023-03-31 15:56:00', 300, 8, 9, 1, 0, 2, 'http://assets.worldwildlife.org/photos/2325/images/hero_full/mountains-hero.jpg?1345838509');

-- --------------------------------------------------------

--
-- Table structure for table `contestusers`
--

CREATE TABLE `contestusers` (
  `contestID` int(11) NOT NULL,
  `writerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grouplist`
--

CREATE TABLE `grouplist` (
  `groupID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grouplist`
--

INSERT INTO `grouplist` (`groupID`, `userID`) VALUES
(8, 3),
(8, 4),
(9, 2),
(9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `catid`, `name`, `description`) VALUES
(1, 1, 'Free Writing', 'There are no rules to free writing, have fun!'),
(2, 1, 'Narrative Essay', 'A narrative uses tools such as flashbacks, flash-forwards, and transitions that often build to a climax. The focus of a narrative is the plot. When creating a narrative, authors must determine their purpose, consider their audience, establish their point of view, use dialogue, and organize the narrative. A narrative is usually arranged chronologically.'),
(3, 1, 'Argumentative Essay', 'An argumentative essay is a critical piece of writing, aimed at presenting objective analysis of the subject matter, narrowed down to a single topic. The main idea of all the criticism is to provide an opinion either of positive or negative implication. As such, a critical essay requires research and analysis, strong internal logic and sharp structure.'),
(4, 2, 'Review', 'Reviews are part fact based and part opinion and they are there to review certain subjects. Review articles work hard to accomplish two things: first, they accurately and thoroughly identify and describe the subject that is being reviewed; and second, they use experience and research to provide an informed and intelligent opinion of that subject. Review articles present a constructive and critical analysis of existing literature, accomplished through analysis, comparison, and summary. They can identify specific problems or gaps and can even provide recommendations for research in the future.'),
(5, 2, 'Satire', 'Satire is meant to be humourous, and is a type of parody presented in a format typical of mainstream journalism, and called a satire because of its content. News satire relies heavily on irony and deadpan humor. '),
(6, 2, 'Opinion Piece', 'Opinion pieces consist only of the author’s viewpoint on a particular study’s interpretation, methods, or analysis. The author can comment on the strengths and weaknesses of a certain hypothesis or theory, and the articles are usually both backed by sound evidence and based on constructive criticism.'),
(7, 2, 'Lifestyle', 'Although the topics can vary greatly, lifestyle articles focus on issues related to one’s lifestyle. This can include everything from recreation to health and relationships to real-life interviews, and they can even include statistics if you like.'),
(8, 2, 'News', 'News articles have to be written without bias or personal interpretations by the reporters themselves. It provides just enough information so that the reader or viewer learns what happened from the storyline and nothing else. News articles are there to relay events, basic information, and facts in an accurate, unbiased, and straightforward way.'),
(9, 2, 'Interview', 'The interviewer asks questions, then writes down the answers that are received, so it isn’t an opinion piece, but instead centers on facts. Interviews have introductory or lead paragraphs, but the bulk of the article consists of the questions and answers discussed at the interview.'),
(10, 3, 'Sonnet', '     3 quatrains (4 lines each) and a couplet (2 lines)     Couplet usually forms a conclusion     Rhyme scheme: ABAB, CDCD, EFEF, GG'),
(11, 3, 'Villanelle', '     19 lines     5 stanzas of 3 lines each     1 closing stanza of 4 lines     Rhyme scheme: ABA, ABA, ABA, ABA, ABA, ABAA     Line 1 repeats in lines 6, 12, and 18     Line 3 repeats in lines 9, 15, and 19'),
(12, 3, 'Elegy', 'The elegy is a type of poem that lacks particular rules, but it usually is written in mourning following a death. They can be written for a particular person, or treat the subject of loss more generally.'),
(13, 3, 'Epigram', 'Epigrams are short, witty, and often satirical poems that usually take the form of a couplet or quatrain (2-4 lines in length).'),
(14, 3, 'Limerick', 'Limericks are humorous poems that have a more distinct rhythm. Their subject matter is sometimes crude, but always designed to offer laughs.'),
(15, 3, 'Free Verse', 'There are no rules, and writers can do whatever they choose: to rhyme or not, to establish any rhythm.'),
(16, 3, 'Haiku', '3 lines, Line 1 contains 5 syllables, Line 2 contains 7 syllables, Line 3 contains 5 syllables'),
(17, 3, 'Ballad', 'Ballads usually take a narrative form to tell us stories. They are often arranged in quatrains, but the form is loose enough that writers can easily modify it.'),
(18, 2, 'Blog', 'A sort of informal diary-style text entry. Write to your hearts content.'),
(19, 1, 'Descriptive Essay', 'Descriptive writing is characterized by sensory details, which appeal to the physical senses, and details that appeal to a reader\'s emotional, physical, or intellectual sensibilities. Determining the purpose, considering the audience, creating a dominant impression, using descriptive language, and organizing the description are the rhetorical choices to consider when using a description. A description is usually arranged spatially but can also be chronological or emphatic.');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `tid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`tid`, `name`) VALUES
(1, 'horror'),
(2, 'action'),
(4, 'braille'),
(5, 'cyber bullying'),
(6, 'animal'),
(7, 'police brutality'),
(8, 'chatgpt'),
(9, 'artificial intelligence'),
(10, 'overpopulation'),
(11, 'tekken'),
(12, 'fighting game'),
(13, 'haiku'),
(14, 'gun'),
(15, 'german'),
(16, 'werewolf'),
(17, 'house');

-- --------------------------------------------------------

--
-- Table structure for table `topicwriting`
--

CREATE TABLE `topicwriting` (
  `wid` int(11) NOT NULL,
  `tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topicwriting`
--

INSERT INTO `topicwriting` (`wid`, `tid`) VALUES
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(9, 10),
(10, 8),
(10, 9),
(30, 11),
(30, 12),
(32, 17);

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `groupID` int(11) NOT NULL,
  `groupName` varchar(255) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `judge` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`groupID`, `groupName`, `ownerID`, `judge`) VALUES
(3, 'group1', 2, 0),
(8, 'judge panel', 1, 0),
(9, 'Class1A', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usernames`
--

CREATE TABLE `usernames` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `canHost` tinyint(1) NOT NULL DEFAULT 0,
  `featuredWriting` tinyint(1) NOT NULL DEFAULT 0,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usernames`
--

INSERT INTO `usernames` (`id`, `username`, `password`, `canHost`, `featuredWriting`, `photo`) VALUES
(1, 'taimur', '$2y$10$qflv.7jlM0DdqawppAmNUe1CgjmQWWGpQYfSTsVgmaosYBS5zlCE2', 0, 0, 'http://t0.gstatic.com/licensed-image?q=tbn:ANd9GcTbOiWS4nWZXfi1OoF2KauaRMKZDqh6ZgCm_76tvzDjT8572lXfOnQ-Rk1kgFSNXINMNWkPMj_h44ievqQ'),
(2, 'tamim', '$2y$10$KYv4iljOf8QNvy9mg7WsdO8KWdmDnGQD/Y4ttZbgowiInOQFalezS', 0, 0, 'https://www.rd.com/wp-content/uploads/2021/01/GettyImages-1175550351.jpg'),
(3, 'OMAR', '$2y$10$aoQ.FKxCgiZDC2vwVPAdBeEE4HNWsY3tVWcIad.vHHACt9B2ZCKZ6', 0, 0, 'https://www.medvetforpets.com/wp-content/uploads/2016/12/iStock_000015139137_Large_BW.jpg'),
(4, 'finley', '$2y$10$mbeTqYdFyOzfIymfFpGiteBEBVigxUddPOPuJq2.lxwte9eUTzBdm', 0, 0, 'https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/a456eb30752007.56311c72c5575.jpg'),
(5, 'yubel', '$2y$10$6ZKMxrqT9nhMrnlw1mxTIOHy4R8EHeLaUl3BIiKKePwFnNI7RQqxW', 0, 0, 'http://static1.wikia.nocookie.net/__cb20121007215660/villains/images/f/f4/Yubel.jpg'),
(6, 'aissam', '$2y$10$rRzH6wER2H/.C7j6KVwBK.un.Dh8IAAgMhHTbyiSSf6b1Mq.yB.PG', 0, 0, 'https://alchetron.com/cdn/kazuya-mishima-74a250d3-464c-492e-bc00-4810022b5e5-resize-750.jpeg'),
(7, 'saif', '$2y$10$QnQHvQIdQw69aC9VKi2YTu5I3DG7lyHJYAophUJcQQiCAuqa/dnri', 0, 0, 'images/blank.jpg'),
(8, 'zunaid', '$2y$10$i3lXm9Vf.cj23PEExlcir.QAXGn/u3.gVxpraqfxgHW5XzWO0aOHq', 0, 0, 'images/blank.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `writing`
--

CREATE TABLE `writing` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Untitled',
  `body` mediumtext NOT NULL,
  `authorID` int(11) NOT NULL,
  `datePublished` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `subcategoryID` int(11) NOT NULL DEFAULT 19,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `writing`
--

INSERT INTO `writing` (`id`, `title`, `body`, `authorID`, `datePublished`, `status`, `subcategoryID`, `views`) VALUES
(5, 'An Appeal to the Senses: The Development of the Braille System in Nineteenth-Century France', ' The invention of Braille was a major turning point in the history of disability. The writing system of raised dots used by visually impaired people was developed by Louis Braille in nineteenth-century France. In a society that did not value disabled people in general, blindness was particularly stigmatized, and lack of access to reading and writing was a significant barrier to social participation. The idea of tactile reading was not entirely new, but existing methods based on sighted systems were difficult to learn and use. As the first writing system designed for blind people’s needs, Braille was a groundbreaking new accessibility tool. It not only provided practical benefits, but also helped change the cultural status of blindness. This essay begins by discussing the situation of blind people in nineteenth-century Europe. It then describes the invention of Braille and the gradual process of its acceptance within blind education. Subsequently, it explores the wide-ranging effects of this invention on blind people’s social and cultural lives.\r\n\r\nLack of access to reading and writing put blind people at a serious disadvantage in nineteenth-century society. Text was one of the primary methods through which people engaged with culture, communicated with others, and accessed information; without a well-developed reading system that did not rely on sight, blind people were excluded from social participation (Weygand, 2009). While disabled people in general suffered from discrimination, blindness was widely viewed as the worst disability, and it was commonly believed that blind people were incapable of pursuing a profession or improving themselves through culture (Weygand, 2009). This demonstrates the importance of reading and writing to social status at the time: without access to text, it was considered impossible to fully participate in society. Blind people were excluded from the sighted world, but also entirely dependent on sighted people for information and education.\r\n\r\nIn France, debates about how to deal with disability led to the adoption of different strategies over time. While people with temporary difficulties were able to access public welfare, the most common response to people with long-term disabilities, such as hearing or vision loss, was to group them together in institutions (Tombs, 1996). At first, a joint institute for the blind and deaf was created, and although the partnership was motivated more by financial considerations than by the well-being of the residents, the institute aimed to help people develop skills valuable to society (Weygand, 2009). Eventually blind institutions were separated from deaf institutions, and the focus shifted towards education of the blind, as was the case for the Royal Institute for Blind Youth, which Louis Braille attended (Jimenez et al, 2009). The growing acknowledgement of the uniqueness of different disabilities led to more targeted education strategies, fostering an environment in which the benefits of a specifically blind education could be more widely recognized.\r\n\r\nSeveral different systems of tactile reading can be seen as forerunners to the method Louis Braille developed, but these systems were all developed based on the sighted system. The Royal Institute for Blind Youth in Paris taught the students to read embossed roman letters, a method created by the school’s founder, Valentin Hauy (Jimenez et al., 2009). Reading this way proved to be a rather arduous task, as the letters were difficult to distinguish by touch. The embossed letter method was based on the reading system of sighted people, with minimal adaptation for those with vision loss. As a result, this method did not gain significant success among blind students.\r\n\r\nLouis Braille was bound to be influenced by his school’s founder, but the most influential pre-Braille tactile reading system was Charles Barbier’s night writing. A soldier in Napoleon’s army, Barbier developed a system in 1819 that used 12 dots with a five line musical staff (Kersten, 1997). His intention was to develop a system that would allow the military to communicate at night without the need for light (Herron, 2009). The code developed by Barbier was phonetic (Jimenez et al., 2009); in other words, the code was designed for sighted people and was based on the sounds of words, not on an actual alphabet. Barbier discovered that variants of raised dots within a square were the easiest method of reading by touch (Jimenez et al., 2009). This system proved effective for the transmission of short messages between military personnel, but the symbols were too large for the fingertip, greatly reducing the speed at which a message could be read (Herron, 2009). For this reason, it was unsuitable for daily use and was not widely adopted in the blind community.\r\n\r\nNevertheless, Barbier’s military dot system was more efficient than Hauy’s embossed letters, and it provided the framework within which Louis Braille developed his method. Barbier’s system, with its dashes and dots, could form over 4000 combinations (Jimenez et al., 2009). Compared to the 26 letters of the Latin alphabet, this was an absurdly high number. Braille kept the raised dot form, but developed a more manageable system that would reflect the sighted alphabet. He replaced Barbier’s dashes and dots with just six dots in a rectangular configuration (Jimenez et al., 2009). The result was that the blind population in France had a tactile reading system using dots (like Barbier’s) that was based on the structure of the sighted alphabet (like Hauy’s); crucially, this system was the first developed specifically for the purposes of the blind.\r\n\r\nWhile the Braille system gained immediate popularity with the blind students at the Institute in Paris, it had to gain acceptance among the sighted before its adoption throughout France. This support was necessary because sighted teachers and leaders had ultimate control over the propagation of Braille resources. Many of the teachers at the Royal Institute for Blind Youth resisted learning Braille’s system because they found the tactile method of reading difficult to learn (Bullock & Galst, 2009). This resistance was symptomatic of the prevalent attitude that the blind population had to adapt to the sighted world rather than develop their own tools and methods. Over time, however, with the increasing impetus to make social contribution possible for all, teachers began to appreciate the usefulness of Braille’s system (Bullock & Galst, 2009), realizing that access to reading could help improve the productivity and integration of people with vision loss. It took approximately 30 years, but the French government eventually approved the Braille system, and it was established throughout the country (Bullock & Galst, 2009).\r\n\r\nAlthough Blind people remained marginalized throughout the nineteenth century, the Braille system granted them growing opportunities for social participation. Most obviously, Braille allowed people with vision loss to read the same alphabet used by sighted people (Bullock & Galst, 2009), allowing them to participate in certain cultural experiences previously unavailable to them. Written works, such as books and poetry, had previously been inaccessible to the blind population without the aid of a reader, limiting their autonomy. As books began to be distributed in Braille, this barrier was reduced, enabling people with vision loss to access information autonomously. The closing of the gap between the abilities of blind and the sighted contributed to a gradual shift in blind people’s status, lessening the cultural perception of the blind as essentially different and facilitating greater social integration.\r\n\r\nThe Braille system also had important cultural effects beyond the sphere of written culture. Its invention later led to the development of a music notation system for the blind, although Louis Braille did not develop this system himself (Jimenez, et al., 2009). This development helped remove a cultural obstacle that had been introduced by the popularization of written musical notation in the early 1500s. While music had previously been an arena in which the blind could participate on equal footing, the transition from memory-based performance to notation-based performance meant that blind musicians were no longer able to compete with sighted musicians (Kersten, 1997). As a result, a tactile musical notation system became necessary for professional equality between blind and sighted musicians (Kersten, 1997).\r\n\r\nBraille paved the way for dramatic cultural changes in the way blind people were treated and the opportunities available to them. Louis Braille’s innovation was to reimagine existing reading systems from a blind perspective, and the success of this invention required sighted teachers to adapt to their students’ reality instead of the other way around. In this sense, Braille helped drive broader social changes in the status of blindness. New accessibility tools provide practical advantages to those who need them, but they can also change the perspectives and attitudes of those who do not.', 1, '2023-02-27 08:13:37', 0, 18, 64),
(6, 'How to stop Cyber bullying', 'The use of information technology is currently a more popular social phenomenon than ever before. Thus, most young people are using the Internet for different purposes which may include studies and undertaking research, but mostly for socialization (Ybarra 247). The internet has now become a big source of fun for the majority of young people, with chatting, e-mailing, sharing pictures, videos and other forms of documents and files becoming everyday activities. Nevertheless, just like in many other social situations in life, there are people who take pride in harassing, demeaning and bullying others using the information technology and electronic devices, a practice commonly referred to as cyber bullying (“Prevent Cyber bullying”). Bullying can cause frustrations on the victims, especially those who are bullied constantly, resulting in psychological trauma or even more fatal occurrences such as suicide. Thus, parents should team up with their children to explore and develop safe ways of using technology, while monitoring and controlling their children’s internet use, to protect their children against cyber bullying.\r\nThe practice of receiving mean messages, threatening texts, hurtful posts or even negative and damaging rumors is something that is happening with teens and adolescents every single day globally. It is no longer unusual for teens to find sexually explicit and obscene photographs of them or their friends on the internet, even without knowing how pictures ended up there. According to bullyingstatistics.org, 50 of adolescents and teens have experienced cyber bullying, and equally 50 of the teens and adolescents have been involved in cyber bullying (bullyingstatistics.org). Additionally, one in every three adolescents has received threatening messages either through the Internet or over the phone, while 25 of teens have experienced repetitive cyber bullying (bullyingstatistics.org). Consequently, according to statistics from the meganmeierfoundation.org, 2.2 million school children reported having experienced cyber bullying in the USA in 2011 (“Bullying, Cyber bullying & Suicide Statistics”). Most worrying though, is the fact that 38 of frequent bullied-victims in 2013 reported having suicidal thoughts, which sends a shock down the spine, considering that suicide has been identified as the third major cause of death for young people aged between 15 and 24 years (“Bullying, Cyber bullying & Suicide Statistics”).\r\nWhile the connection between cyber bullying and suicidal thoughts for 38 of the people who have been bullied repetitively can seem to be farfetched, there is no doubt that evidence lies everywhere that cyber bullying is a killer behavior. Alexis Pilkington, a well known and celebrated athlete at her prime age of career committed suicide in her bedroom, following a streak of cyber bullying messages, thus ending her promising life on March 21, 2010 (Long and Gross, n.p.). Why is cyber bulling such a big issue if one may ask? Cyber bullying has the same effects as physical bullying; only that cyber bullying is worse, since there is no running away (Ybarra, 251). It would be easier to escape from physical confrontation, but the psychological trauma arising from cyber bullying is devastating. This is because; the internet is all over, and if an individual being cyber-bullied decided not to access the internet anymore, his/her friends or alternatively enemies, will still make the torture continue. Simply put therefore, cyber bullying can frustrate a victim to death, since there are just very few options of running away from it once it has started (Ybarra, 251). The major problem is that the victim may at times turn out to be the aggressor in an attempt to defend against the cyber bullies, and this can go on until cows come home. However, one thing is certain; psychological trauma, mental illnesses or at worst suicidal thoughts, are not farfetched occurrences on cyber bullying victims.\r\nThere is no doubt therefore, that many organizations, both online and on-location have come up to help address the vice of cyber bullying. In every major city or town, every social media site and every community organization running out there, someone is doing something about cyber bullying. Campaigns have been launched on the online platforms and even in the mainstream media through print messages warning against the evil of cyber bullying, while others are advertising professional help for the victims of cyber bullying. The setback associated with online and on-location campaigns against cyber bullying is that they target helping the victims of cyber bullying, and not so much on preventing potential victims from falling into the trap (bullyingstatistics.org). The government on its side is enacting, defining and redefining laws and statutes that can prosecute the perpetrators of cyber bullying once they have been unlucky to be nabbed by the hand of the law. Nevertheless, even with appropriate laws in place, with the anonymity option that cyber bullies mostly apply, finding them into the drag net is something that resilience will reward. Simply put therefore, the society is trying the most viable options at hand, but the options never prove to be adequate for the daunting task of bringing down cyber bullying (Long and Gross, n.p.).\r\nTherefore, the best and only solution to cyber bullying is this one; child-parent partnership to exploring and adapting safe ways of using the internet. Culture builds people or people build culture. Either way, culture has an influence on the way of life of a people. Thus, building the culture of responsible use of the internet and the social media platforms is the most fool proof method of addressing cyber bullying (“Prevent Cyber bullying”.). However, building such a culture cannot be that simple. The internet has temptations. But, even with the temptations, a prepared and warned teen or adolescent is better in handling the temptation than the unprepared and the clueless one. In this respect, parents can build a culture of responsible internet use through partnering with their children, not in prohibiting them from the social media and internet use, but letting them understand fully the magnitude of the danger posed by irresponsible use of the internet and the other technology tools available to them (“Prevent Cyber bullying”).\r\nParents can sit down and discuss with their children about the internet and its applications. Parents should know what their children are doing online by carefully monitoring every of their online interaction whenever possible. Through the child-parent partnership, parents should set the rule of internet and other technology tools used by their children (“Prevent Cyber bullying”). With the knowledge of how the children are using the internet and the rules of its use in place, parents should enforce the rules with a firm hand, but encourage and reward responsible use with an equally open and embracing hand. Parents should become indirect partners to what their children do online. Monitor whatever they do through secretly installed monitoring and control software (“Prevent Cyber bullying”). Parents should borrow and use their children’s devices for simple and routine surveillance. Parent can recommend a responsible adult to follow their children on their social media websites and pages, and simply evaluate their activities. Parents should make their children’s social media and internets use their job to monitor and control.\r\nThere are still chances that critics will counter this solution by holding that parents cannot stalk their children forever, while also holding that it is unethical to stalk their children’s internet and social media interactions anyway. The position for this argument however, is that monitoring and control can continue until the age of responsibility is attained, where it may become tricky for parents to continue monitoring and controlling their children. However, by then, their children will have developed a culture of caution, if not that of desisting from potentially harmful internet and social media interactions (Ybarra, 255). This way, a win-win situation will have been created by averting the chances of cyber bullies attacking such children, while also protecting against such children turning out to be cyber-bullies. If every parent would do that, then, only the runaway dissidents would be conducting the cyber bullying business, and even then, they would be fewer for the hand of law to target effectively.', 1, '2023-02-27 08:14:49', 0, 6, 11),
(7, 'What Rights Should Animals Have?', 'Animal rights as noted by Buzzle (2012) are also called animal liberation. It is a concept to ensure that animal rights are protected as equally as those of human beings. These rights are there to ensure that human beings do not harm, exploit, abuse or kill animals aimlessly. In this concept, it is illegal to use animals in any way that makes them feel pain, suffer or even die. It tries to explain to human beings that it is not a right practice to violate these rights. The concept was started in 1975 by Peter Singer in a book entitled animal liberation. It came to being after the birth of American Society for the prevention of cruelty of animals.\r\n\r\nAnimal rights have been enforced in several parts of the world today. For instance, in Germany, it was voted and included in the constitution that was in the parliament’s house. The vote was aimed at adding a simple clause in the constitution to change the way in which people treated animals in that country. It is the first country in Europe to accept constitutionally the fact that animals had some rights like fair treatment and good feeding. The same has been followed in several other continents in the world and have led to a fairer treatment of all animals with a court penalty owing to the violation thereof as discussed by CNN (2012).\r\n\r\nAccording to Lafollette (n.d), there are boundaries about animals that human beings should strive not to cross as opposed to treating animals in the way one pleases. It is not legitimate to mistreat animals even though they have no voice to rise. In this culture that we are living in today, animals are used as a main source of food, clothes, and research on drugs and to test the vulnerability of some appliances at home. All these can only be realized when the animal is dead or involves inflicting pain to the animal. Animals have a right against overcrowding. This implies that an animal has a right to enough space during its lifespan. This has not been followed especially by farmers who keep them for profit. Animals also have rights to enough movement. Due to the limitations of space, animals are confided in one place leading to less feeding and poor movement. For instance, chicken are overcrowded in little battery cages. The more crowded the animals are, the more likely they are to attack each other and cause injury to one another.\r\n\r\nIn an opinion, Lafollette (n. d) adds that people should use more of vegetables to reduce the killing of animals for food. Many people hold an opinion that animals do not feel pain and has led to the killing of many animals for not only food but also for scientific research and testing. When a dog is hit by a stray vehicle, the way it convulses, bleeds, and yelps is a sure proof that animals feel pain. The same way, a cat reacts even at the small attempt to step on its tail is another proof of sensitivity of their nervous system. It becomes controversial at times because there is need for nutrients in humans that can only be found in animals and the experiments that are done on animals is vital for human survival.\r\n\r\nAs noted by Lin (2012), there are some myths that people hold about animal rights activists. One of these myths is that activist are more fond of animals than human beings. This is not the case anyway. Caring about animals does not render them more important than human beings. This is the reason as to why most animal activists are involved in humanitarian rights like hunger, poverty, sweatshops, feminism and other civil rights. Another myth is about leather materials compared to fur clothes and shoes. This is because fur can be obtained without necessarily killing the animal, but to get leather the animal has to be killed to get the skin of that animal.\r\n\r\nAccording to Buzzle (2012), animal rights activists are faced with the headache of controlling the rate at which animals are killed or injured. They have worked to make known their reputation just like politicians and celebrities. They have worked to stop some meat companies against the overexploitation of animals through slaughtering and butcher business. Animal rights is just a concept, it is known to many people but the movement, well known as animal rights movement has not yet been enforced to maximum. On the other hand, there are many benefits that animals give to human beings.\r\n\r\nLin (2012) notes that there are issues and controversies that have come about owing to the enforcement of these animal rights as a law; some of these include human overpopulation. It is a threat to the peaceful existence of both wild and domestic animals; when people on the planet increase in number, it leads to the decrease in the space that animals are allowed to live in. In developing countries, where the population grows by day, animal health has declined due to poor feeding and little growing space. Animals have always been termed as property of the human being. This has left the human being with an allegation that they have the right to use or even abuse these animals as long as they are their property. Animals have been killed for the benefit of the human being, regardless of how trivial the case might become.\r\n\r\nAnother issue according to Lin (2012) is that of veganism and diet. This is the fight against the use of animal products ranging from meat and wool, to silk and milk. Factory farming falls under the same category as it involves a lot of cruelty to animals. The fact that human beings use animals for food and other diet related products is a violation of animal rights. Some religions hold animals with great honor and has led to such animals being protected against use, misuse and killing. Overfishing in most of the sources has led to a great deal of threat to aquatic life. When the fish is taken away from water, it certainly dies after a very short period of time, during which it goes through immense pains. Countries that are worst hit by drought have even fallen short of this important dietary component. Vivisection is a concept in the science of animal experimentation. These acts violate animal rights especially when the animal has to be killed to extract the test materials.\r\n\r\nMost people in developed countries and a few in the developing countries keep animals as pets. Examples are the cats and the dogs. These animals are brutally killed by their owners in their shelters or just at home. Those who do not end up being killed are denied the right to proper feeding and hygiene. They are not sprayed regularly neither are their shelters cleaned. Hunting is an activity that has raised conflicts between activists and hunters. It is illegal to kill any animal for meat, regardless of where the killing is done. Fur materials, especially clothes, are warm and fashionable. The problem is the suffering that the animal goes through in the process of obtaining this fur.\r\n\r\nHickle (2011) seconds the allegation that animals have rights and many people have objected to this allegation. This explains the reasons as to why animals are still suffering in the hands of human beings. There is the strong belief that rights only include those to vote, to speech, to democracy and to worship. Questions have propped up about what importance these rights have to animals. It has been forgotten that animals have a right to life and to protection against any form of pain. When a cat kills rats in a store, it is not taken by humans that the cat violated the rights of the rat by killing it. These are rodents who could bring great harm to human food as well as cause illnesses in people, not counting the losses in wasted property. In the same view point, when a dog bites a kid, that is harming a human being and it is not a violation of the dog’s right if it is killed to stop any further harm to someone else.\r\n\r\nFeinberg (n.d) puts an argument in the opposite direction by noting that animals should have no rights because they cannot reason, have no direct duties and are not responsible creatures. It is pointless arguing with an animal because of its lack of reasoning that is naturally in animals. In the same way, you cannot give instructions or directions to an animal unless it has been trained thoroughly to respond to some sign language or some human sounds. An animal cannot adapt to any environment or situation therefore has no right. Since even when rights towards an animal are violated by a human being, the animal is not in a position to file any case on its own hence there is no need for the rights in the first place.\r\n', 1, '2023-02-27 08:16:03', 0, 6, 6),
(8, 'Police Brutality', 'Police are law enforcers of the nation, mandated with authority to manage community peace and security. As enforcers of laws, they underwent substantive education on security management and crime prevention strategies. Laid with high expectations from constituents, they are expected to perform their roles and mandates professionally and in observance to international humanitarian standards. However, empirical evidences showed otherwise as emerging abuses and police brutality are mounted by civilian communities.\r\n\r\nThis essay will explicate police brutality in United States and delve into records of frequency, severity and ramification of police brutality exacted against civilians.\r\n\r\n# Brutality\r\n\r\nPolice brutality is one of those alarming human rights violations done by person of authorities against civilians who are possible suspects or those already serving their sentences as adjudged criminals. Roberts (2011) pointed that in youtube alone, an e-site containing video records, produced about 497,000 results when “police brutality” is subjected into the search engine. Roberts (2011) described that these videos either depict beaten women, kids and the aged or violent and bloody exaction of testimonies from unwilling suspects. Some testimonies of victims who were able to undergo sad ordeal revealed electrocution; suffocation, psychological torment or threat; emotional shocks; direct physical assault, and the like done by police with psychopatic and sociopath tendencies. Skolnick and Fyfe (1993) explicated that police brutality brought along with it such dehumanizing intent by treating the target with such concealed venality and such degrading impact of violent torture.\r\n\r\nRoberts (2011) attributed this inhuman way of managing suspects, civilians and victims to militarist treatment as abuse of power. Those who are involved in police brutality tactics are characterized with such nastiness as they were trained to view the public, the people whom they ought to secure, as their enemy. To some extent, some police officers have made policing activity leveled beyond preservation of order into cyclical patterns of injustice as commission of human rights. Often logged without witnesses to corroborate the conduct of brutalities, Bandes (1999) noted that authorities would just label this as an incident which is either isolated, systemic, or part of a larger pattern to suppress a movement. Bandes (1999) explicated that police brutality are often portrayed by court as something anecdotal, fragmented and isolated from institutional pattern (p. 1275) reinforced by causes that could be political, social, psychological and cultural (Bandes, 1999, p. 2). Experts opined that victims of police brutality would have difficulty expressing such unfair victimization because complaints about it are discouraged due to dearth of evidences, lack of corroborative testimonies, records are expunged, and police records are purposively made inaccessible. Victims are also doubly confronted with difficulty in baring experiences out of restrictive evidentiary rulings, of judicial insensitivity to police perjury, of the law of omerta or total silence, of assailant’s immunity from punitive actions (Bandes, 1999, p. 7). Thus, there is perceived failure to correct endemic system of police lawlessness and adherence to violence, often directed to powerless and marginalized members of specific communities.\r\n\r\nPolice brutality is not simply a violent act. More often, these are kinds of security managers who are in collaboration with groups and decision-makers who lacked respect to procedures that are legally provided. The prevalence of these cases on police brutality simply depict the need to address the problem not only at the institutional level but must be comprehensively rectified by in-depth investigation; of brutality cases demystification, and strict enforcement of the administrative laws to hasten the professionalization of police forces. Empirical studies based on selected cases further showed that police brutalities aren’t investigated with expediency or effectiveness, and unless the case is focused with media mileage, no administrative actions are instituted by executive authorities.\r\n\r\n# King Case\r\n\r\nThe case of Rodney Glen King is a classic and most prominent example of police brutality. King, a divorcee with kids, was violently harmed and beaten by police enforcers of Los Angeles Police Department (LAPD) sometime in 1991 after he was caught by authorities robbing a store and have gravely threatened and lambasted the storeowner with an iron bar (Cannon, 1999). King was beaten by police badly and such incident was captured by media workers who magnified it to public eyes, and subsequently caused dissension amongst black community—people who have viewed the incident as glaring proof of racial prejudice and discrimination (Cannon, 1999). Police were subjected in a court trial but whose acquittal resulted to riots at LA in 1992. Civil suits were later charged against the enforcers which jailed two officers while two others were acquitted (Cannon, 1999).\r\n\r\nIn a subsequent case, King and his two other companies were arrested by police officers due to over speeding at a highway and driving his car with alcohol’s influence (Cannon, 1999). Albeit police warning, King ignored them. He also made some resistance while authorities were about to handcuff him. Police used taser to subdue him but was later prompted to beat him with56 batons blows which caused him 11 skull fractures and brain damage, broken joints, bones and teeth. Medical test further proved that King was using marijuana. He was likewise severely ridiculed by enforcers while at such state (Cannon, 1999).\r\n\r\nOut of this incident, LA lawyers sued the police officers for excessive use of violent force to King and of administrative negligence due to his inability of the supervisor to order the stoppage of further assaults to King (Cannon, 1999). The trial orbited with procedural sensitivities until the jury of Ventura Country decided for the acquittal of accused policemen (Cannon, 1999). The decision was however unacceptable for US president and other executives citing that King is a victim of police brutality (Cannon, 1999). The impact of such decision and resulted to violence rooted by blackmen-sponsored riots in LA which killed a number of persons, wounded thousands, damaged the national economy and incurred financial losses (Cannon, 1999).\r\n\r\nAfter he recovered, King appealed for peace on television and the Department of Justice of United States revived the investigation. The case resulted to the imprisonment of Laurence Powell and Sergeant Satcey Koon (Cannon, 1999). Wind and Briseno were acquitted. King was indemnified with $3.8 million from said civil suit (Cannon, 1999).\r\n\r\n# Conclusion\r\n\r\nThe case of King did not end there. It happened with many others. Indeed, the cited cases remind government authorities to further improve and professionalize policemen of their duties in managing peace and order. On the other hand, there is also a need for civilian populace to exercise their rights with sobriety, to be lawful and to act with propriety. People ought to realize that peace and order, isn’t the sole responsibility of police authorities. It is likewise the role of the civilian community to maintain community peace, although they must also reassert their constitutional rights in case they become object of police brutality and other relate or form of human rights violations. Meanwhile, stakeholders of peace and justice should maintain their vigilance to uphold human rights at all times and to act with moral uprightness.', 1, '2023-02-27 08:17:01', 0, 19, 13),
(9, 'Overpopulation as a Global Environmental Crisis: Concept and Prevention', 'Overpopulation is defined “a country or region that has too many people and is therefore not capable of achieving or maintaining a suitable standard of living” (Pitzl 168). This implies that overpopulation is just about a geographical area that has too many people and limited resources to take care of the numbers of people within it. Another definition of overpopulation is that it is “the condition of having a population as dense as to cause environmental deterioration and impaired quality of life or a population crash” (Gonzalez 117).\r\n\r\nThese two definitions of overpopulation seem to have some differences as well as some commonalities. First of all, both definitions are based on the fact that overpopulation is based on the fact that there might be too many people as opposed to resources in a given area. This implies that overpopulation occurs when there are more people in relation to the resources available to them for their survival and livelihoods.\r\n\r\nOn the other hand, the two writers are not in agreement about the scope of globalization. Whilst Pitzl defines globalization in terms of countries or geographical regions, Gonzalez views it as a global matter which has an impact on the natural environment. This means that the first definition localizes the idea of overpopulation whilst the second generation looks at it as a global problem or issue.\r\n\r\n# Reasons why Overpopulation is a Global Issue\r\n\r\nIn this world, resources and the natural environment are shared. Instead of having a limited access to natural resources, most resources in the natural environment transcend natural borders. Hence, it can be argued that if there is excessive pressure on the natural resources of a given nation, it would affect users of other nations and make it a global matter or issue.\r\n\r\nExamining overpopulation critically, it is conclusive that it leads to major problems which are a a direct consequence of having too many people using the same natural resources. This often results in pressure over natural resources, pollution, congestion, unorganized development amongst others.\r\n\r\nNagel and Guinness identify that overpopulation can be defined in terms of having a population that is above the normal level that a nation or community can hold (111). The standard level of population that a community’s resources can support is known as the optimum population (Nagel and Guinness 111). However, when the population goes above the optimum population, there is an increasing pressure on resources and the living standards of the community would begin to decline. Hence, there would be the non-sustainable use of natural resources, and the over-use of elements of the natural environment. This leads to pressure not only on local resources but on the global ecological balance. This is because when natural resources are put to a use that is beyond the normal, there would be some implications for other resources outside the nation or community.\r\n\r\nOver population causes nations around the world to get concerns. This is because population leads to migration. And if there is migration, nations with optimal populations are also affected and they would have to find ways and means of reducing the flow of migrants into their countries. For example, in the case of China which shares a long border with Russia, there is a major threat to the Russian economy and Russian natural resources if the population of China moves further up. This is because when China’s population grows, the pressure on Chinese resources would be so high that a section of the Chinese community would have to leave the country in order to find other resources to survive on. This means that Russia would be affected by the problem of China and they would have major problems. Thus, the concern of population growth beyond the optimum is not the concern of only one country but of the global community.\r\n\r\nTwo elements of overpopulation, which are climate change and the pollution of waterbodies are directly global and can only be dealt with through global means. Since overpopulation causes pressure on natural resources, the growth of populations would cause an increase in the standard of living amongst people in a given geographical area. Due to this, there is the need for more production to be done and this would potentially cause higher carbon emissions which can lead to global warming and worsen the current condition of the ozone layer. Also, the growth in population often leads to the destruction of waterbodies and rainforests around the world which adds to the reduction in the health of people around the world. This is a universal problem and hence, causes all the people of the world to go through some kind of hardships irrespective of whether they have controlled their populations or not. Thus for example, if the population in India is extremely high and it causes industries to give of high emissions and the population of Sweden is low, the influence of the Indian emissions would cause the whole world, including the people of Sweden to suffer from the high levels of emissions. This is because those problems are universal, rather than local.\r\n\r\n# Controlling Global Overpopulation\r\n\r\nOverpopulation is a serious matter. It deserves to be dealt with through a very serious and integrated approach. There are two popular approaches to dealing with environmental challenges relating to overpopulation. They are population control and environmental responsiveness (McKinney et al 48).\r\n\r\n## Population Control\r\n\r\nEvery nation can control its population if the government has a population policy. A population policy “encompasses all of the measures explicitly or implicitly taken by a government aimed at influencing population size, growth, distribution or composition” (Nagel and Guinness 114). This means that governments would make a conscious effort to define the population control targets over a given period of time to ensure that they maintain a stable and manageable population throughout the period.\r\n\r\nThere are many approaches go this. This include family planning programs which set the target and number of children that a family could have (Kendall 48). An example is China where every family is forced to have just one child and not more than that. Also, there are some social systems that can be promoted in a nation to prevent the rapid growth in population. This include fecundity which include the use of policies to define the ability to have intercourse, the ability to conceive and the ability to carry pregnancies. These can be controlled by social and cultural norms as well as laws. And hence, they can be varied to help to meet the targets of the people in charge. Also, the formation and dissolution of unions can be controlled by the state to ensure that it is in sync with the population policy. Finally, birth control can be enhanced through the population policy system to enable the nation to meet its population policy targets.\r\n\r\nDue to the global nature of the overpopulation issue, population control is now a matter of global concern rather than national concern. Many developing nations now get support and guidance from richer nations to carry out their population control programs (Smith 92). There are global for a through which population matters are discussed and encouraged to get different governments to support and enhance population control.\r\n\r\n## Environmental Responsibility\r\n\r\nAlthough overpopulation often causes pressure on natural resources, McKinney et al (31) argue that if there are responsible methods and means of using natural resources, the pressure is not likely to be felt. This is because where there is a structured and efficient method of dealing with the natural environment, then the environment is not likely to suffer from the effects of usage.\r\n\r\nHence, the nations around the world are being encouraged to come up with environmental policies concerning pollution and carbon emissions amongst others. If this is done, then it can be seen that the effects of overpopulation would be controlled to a high degree.\r\n\r\nAlso, in the case where technology is improved and research is conducted into producing better and more meaningful methods and systems of using the natural environment, the effects of population growth on the extraction of natural resources would be reduced and this would make the world a better place to live in.\r\n\r\n# Conclusion\r\n\r\nOverpopulation is a global issue because many natural resources transcend national boundaries. Resources like the climate and waterbodies go beyond borders. Hence, if population grows beyond normal, these resources would be affected on a global level rather than national level. Also, there is the chance for migration amongst people in the world. Hence, overpopulation in one part of the world leads to migration which causes resources in other nations to come under pressure as well.\r\n\r\nIn order to deal with overpopulation on the global level, there is the need for national population policies. This must be bolstered by a global campaign for the promotion of population control and population checks. Also, responsible usage of natural resources helps in the protection of the natural environment in periods of high population growth.\r\n', 1, '2023-02-27 08:19:34', 0, 8, 15);
INSERT INTO `writing` (`id`, `title`, `body`, `authorID`, `datePublished`, `status`, `subcategoryID`, `views`) VALUES
(10, 'How ChatGPT Works: The Model Behind The Bot', 'This gentle introduction to the machine learning models that power ChatGPT, will start at the introduction of Large Language Models, dive into the revolutionary self-attention mechanism that enabled GPT-3 to be trained, and then burrow into Reinforcement Learning From Human Feedback, the novel technique that made ChatGPT exceptional.\r\n# Large Language Models\r\n\r\nChatGPT is an extrapolation of a class of machine learning Natural Language Processing models known as Large Language Model (LLMs). LLMs digest huge quantities of text data and infer relationships between words within the text. These models have grown over the last few years as we’ve seen advancements in computational power. LLMs increase their capability as the size of their input datasets and parameter space increase.\r\n\r\nThe most basic training of language models involves predicting a word in a sequence of words. Most commonly, this is observed as either next-token-prediction and masked-language-modeling.\r\n\r\nIn this basic sequencing technique, often deployed through a Long-Short-Term-Memory (LSTM) model, the model is filling in the blank with the most statistically probable word given the surrounding context. There are two major limitations with this sequential modeling structure.\r\n\r\n1. The model is unable to value some of the surrounding words more than others. In the above example, while ‘reading’ may most often associate with ‘hates’, in the database ‘Jacob’ may be such an avid reader that the model should give more weight to ‘Jacob’ than to ‘reading’ and choose ‘love’ instead of ‘hates’.\r\n2. The input data is processed individually and sequentially rather than as a whole corpus. This means that when an LSTM is trained, the window of context is fixed, extending only beyond an individual input for several steps in the sequence. This limits the complexity of the relationships between words and the meanings that can be derived.\r\n\r\nIn response to this issue, in 2017 a team at Google Brain introduced transformers. Unlike LSTMs, transformers can process all input data simultaneously. Using a self-attention mechanism, the model can give varying weight to different parts of the input data in relation to any position of the language sequence. This feature enabled massive improvements in infusing meaning into LLMs and enables processing of significantly larger datasets.\r\n\r\n# GPT and Self-Attention\r\n\r\nGenerative Pre-training Transformer (GPT) models were first launched in 2018 by openAI as GPT-1. The models continued to evolve over 2019 with GPT-2, 2020 with GPT-3, and most recently in 2022 with InstructGPT and ChatGPT. Prior to integrating human feedback into the system, the greatest advancement in the GPT model evolution was driven by achievements in computational efficiency, which enabled GPT-3 to be trained on significantly more data than GPT-2, giving it a more diverse knowledge base and the capability to perform a wider range of tasks.\r\n\r\nAll GPT models leverage the transformer architecture, which means they have an encoder to process the input sequence and a decoder to generate the output sequence. Both the encoder and decoder have a multi-head self-attention mechanism that allows the model to differentially weight parts of the sequence to infer meaning and context. In addition, the encoder leverages masked-language-modeling to understand the relationship between words and produce more comprehensible responses.\r\n\r\nThe self-attention mechanism that drives GPT works by converting tokens (pieces of text, which can be a word, sentence, or other grouping of text) into vectors that represent the importance of the token in the input sequence. \r\nThe ‘multi-head’ attention mechanism that GPT uses is an evolution of self-attention. Rather than performing steps 1–4 once, in parallel the model iterates this mechanism several times, each time generating a new linear projection of the query, key, and value vectors. By expanding self-attention in this way, the model is capable of grasping sub-meanings and more complex relationships within the input data.\r\n\r\n# ChatGPT\r\n\r\nChatGPT is a spinoff of InstructGPT, which introduced a novel approach to incorporating human feedback into the training process to better align the model outputs with user intent. Reinforcement Learning from Human Feedback (RLHF) is described in depth in openAI’s 2022 paper Training language models to follow instructions with human feedback and is simplified below.\r\nThe first development involved fine-tuning the GPT-3 model by hiring 40 contractors to create a supervised training dataset, in which the input has a known output for the model to learn from. Inputs, or prompts, were collected from actual user entries into the Open API. The labelers then wrote an appropriate response to the prompt thus creating a known output for each input. The GPT-3 model was then fine-tuned using this new, supervised dataset, to create GPT-3.5, also called the SFT model.\r\n\r\nIn order to maximize diversity in the prompts dataset, only 200 prompts could come from any given user ID and any prompts that shared long common prefixes were removed. Finally, all prompts containing personally identifiable information (PII) were removed.\r\n\r\nAfter aggregating prompts from OpenAI API, labelers were also asked to create sample prompts to fill-out categories in which there was only minimal real sample data. \r\nAfter the SFT model is trained in step 1, the model generates better aligned responses to user prompts. The next refinement comes in the form of training a reward model in which a model input is a series of prompts and responses, and the output is a scaler value, called a reward. The reward model is required in order to leverage Reinforcement Learning in which a model learns to produce outputs to maximize its reward (see step 3).\r\n\r\nTo train the reward model, labelers are presented with 4 to 9 SFT model outputs for a single input prompt. They are asked to rank these outputs from best to worst, creating combinations of output ranking as follows. In the final stage, the model is presented with a random prompt and returns a response. The response is generated using the ‘policy’ that the model has learned in step 2. The policy represents a strategy that the machine has learned to use to achieve its goal; in this case, maximizing its reward. Based on the reward model developed in step 2, a scaler reward value is then determined for the prompt and response pair. The reward then feeds back into the model to evolve the policy.\r\n\r\nIn 2017, Schulman et al. introduced Proximal Policy Optimization (PPO), the methodology that is used in updating the model’s policy as each response is generated. PPO incorporates a per-token Kullback–Leibler (KL) penalty from the SFT model. The KL divergence measures the similarity of two distribution functions and penalizes extreme distances. In this case, using a KL penalty reduces the distance that the responses can be from the SFT model outputs trained in step 1 to avoid over-optimizing the reward model and deviating too drastically from the human intention dataset.', 1, '2023-02-27 08:24:28', 0, 18, 23),
(12, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Laoreet sit amet cursus sit amet dictum sit amet. Quam quisque id diam vel. Urna cursus eget nunc scelerisque viverra. Mauris commodo quis imperdiet massa tincidunt. Dignissim suspendisse in est ante in nibh mauris cursus. Eget sit amet tellus cras adipiscing. Pellentesque habitant morbi tristique senectus et netus. Elementum tempus egestas sed sed risus pretium. Habitasse platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper. Pellentesque habitant morbi tristique senectus. Amet commodo nulla facilisi nullam vehicula ipsum a. Nullam ac tortor vitae purus. Ut tortor pretium viverra suspendisse potenti. Tortor id aliquet lectus proin nibh nisl condimentum id venenatis. Lobortis scelerisque fermentum dui faucibus in.\r\n\r\nErat velit scelerisque in dictum non consectetur a. Ante in nibh mauris cursus mattis molestie a iaculis at. Amet nisl purus in mollis nunc sed id semper risus. Ullamcorper velit sed ullamcorper morbi. Egestas maecenas pharetra convallis posuere. Ultrices sagittis orci a scelerisque. Leo duis ut diam quam nulla porttitor massa id. Porta non pulvinar neque laoreet. Sagittis eu volutpat odio facilisis mauris sit amet. Interdum posuere lorem ipsum dolor sit amet consectetur. Maecenas sed enim ut sem. Enim tortor at auctor urna nunc. Et ligula ullamcorper malesuada proin. Eu turpis egestas pretium aenean pharetra magna ac placerat vestibulum. Leo duis ut diam quam nulla. Et malesuada fames ac turpis egestas sed. Ullamcorper malesuada proin libero nunc consequat.\r\n\r\nAliquam id diam maecenas ultricies mi eget mauris pharetra et. Gravida cum sociis natoque penatibus et magnis dis. Eget mi proin sed libero enim sed. Mi quis hendrerit dolor magna eget. Rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant. Purus faucibus ornare suspendisse sed nisi lacus sed viverra. Aliquam eleifend mi in nulla posuere sollicitudin. Sapien et ligula ullamcorper malesuada. Etiam dignissim diam quis enim lobortis scelerisque fermentum. Enim nec dui nunc mattis. Placerat in egestas erat imperdiet sed euismod nisi. Elementum sagittis vitae et leo duis ut diam. Sem et tortor consequat id. Erat nam at lectus urna duis. Elementum nibh tellus molestie nunc non blandit. Urna et pharetra pharetra massa. Erat imperdiet sed euismod nisi.\r\n\r\nAliquam purus sit amet luctus venenatis lectus magna. Neque gravida in fermentum et. Rhoncus urna neque viverra justo nec ultrices dui sapien eget. Hendrerit dolor magna eget est. Cursus turpis massa tincidunt dui ut. Aliquam faucibus purus in massa tempor nec. Massa sapien faucibus et molestie ac feugiat sed lectus vestibulum. Adipiscing diam donec adipiscing tristique risus. Etiam non quam lacus suspendisse. Commodo quis imperdiet massa tincidunt nunc pulvinar. Augue neque gravida in fermentum. Et malesuada fames ac turpis egestas integer. Sollicitudin nibh sit amet commodo. Dignissim convallis aenean et tortor at risus viverra adipiscing. Lectus nulla at volutpat diam ut venenatis tellus in metus.\r\n\r\nPotenti nullam ac tortor vitae purus faucibus ornare. Amet venenatis urna cursus eget nunc scelerisque. Et sollicitudin ac orci phasellus. Id velit ut tortor pretium viverra suspendisse. Id porta nibh venenatis cras sed felis. Eu sem integer vitae justo eget magna fermentum iaculis. Arcu cursus euismod quis viverra nibh cras. Diam maecenas ultricies mi eget mauris pharetra et ultrices. Aenean pharetra magna ac placerat vestibulum lectus mauris ultrices eros. Duis ut diam quam nulla porttitor massa. Cras tincidunt lobortis feugiat vivamus at. Sed sed risus pretium quam vulputate dignissim. Proin sagittis nisl rhoncus mattis rhoncus. Mi quis hendrerit dolor magna eget est lorem ipsum dolor. Velit euismod in pellentesque massa placerat duis ultricies lacus. Convallis tellus id interdum velit laoreet id donec ultrices tincidunt. Et tortor consequat id porta nibh venenatis. Elementum pulvinar etiam non quam lacus suspendisse faucibus interdum posuere. Fermentum odio eu feugiat pretium.\r\n\r\nLobortis elementum nibh tellus molestie nunc non blandit massa enim. Risus feugiat in ante metus. Integer eget aliquet nibh praesent tristique magna. Eget velit aliquet sagittis id consectetur purus ut faucibus. Bibendum arcu vitae elementum curabitur vitae nunc sed velit dignissim. Cras semper auctor neque vitae tempus quam. Phasellus vestibulum lorem sed risus ultricies tristique nulla. Sit amet luctus venenatis lectus magna. Lacus sed viverra tellus in hac habitasse platea. Scelerisque felis imperdiet proin fermentum leo. A diam maecenas sed enim ut sem viverra aliquet eget. Cum sociis natoque penatibus et magnis dis. Sem fringilla ut morbi tincidunt augue interdum velit. Sed vulputate odio ut enim blandit volutpat. Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing. Ornare quam viverra orci sagittis eu. Pharetra pharetra massa massa ultricies mi quis hendrerit.\r\n\r\nEgestas dui id ornare arcu odio ut sem nulla pharetra. Nam aliquam sem et tortor consequat id. Habitasse platea dictumst quisque sagittis purus sit. Nec ultrices dui sapien eget mi proin. Est lorem ipsum dolor sit amet consectetur adipiscing elit. Pellentesque diam volutpat commodo sed egestas. Consectetur adipiscing elit ut aliquam purus sit amet luctus venenatis. Fermentum dui faucibus in ornare. Tempor orci dapibus ultrices in iaculis nunc. Nisi quis eleifend quam adipiscing vitae proin sagittis nisl. Iaculis urna id volutpat lacus laoreet. Sit amet mauris commodo quis imperdiet. Sem viverra aliquet eget sit amet. Lobortis mattis aliquam faucibus purus in massa tempor nec. Quis enim lobortis scelerisque fermentum dui. Lectus sit amet est placerat. Sed vulputate mi sit amet mauris commodo quis imperdiet.\r\n\r\nDiam maecenas ultricies mi eget mauris. Facilisis sed odio morbi quis commodo odio. Cras adipiscing enim eu turpis egestas pretium. Cursus euismod quis viverra nibh cras pulvinar mattis. Neque convallis a cras semper auctor neque vitae. Rutrum quisque non tellus orci. Viverra ipsum nunc aliquet bibendum enim facilisis gravida neque. Eu ultrices vitae auctor eu augue. Aenean pharetra magna ac placerat vestibulum. Scelerisque eu ultrices vitae auctor eu augue. Bibendum est ultricies integer quis auctor. Vitae elementum curabitur vitae nunc sed velit dignissim. Diam ut venenatis tellus in metus vulputate eu scelerisque felis. Mattis ullamcorper velit sed ullamcorper morbi tincidunt. Laoreet non curabitur gravida arcu ac. Senectus et netus et malesuada fames. Tincidunt eget nullam non nisi est sit amet facilisis. Eget nunc lobortis mattis aliquam faucibus purus in massa. Purus faucibus ornare suspendisse sed nisi lacus sed viverra.\r\n\r\nAdipiscing elit pellentesque habitant morbi tristique senectus et. Tellus integer feugiat scelerisque varius morbi enim nunc. Nibh tellus molestie nunc non. Et tortor consequat id porta nibh venenatis cras. Rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Mauris cursus mattis molestie a iaculis at. Vestibulum sed arcu non odio euismod lacinia. Sed elementum tempus egestas sed sed risus. Nibh tortor id aliquet lectus. Nulla at volutpat diam ut venenatis. Risus sed vulputate odio ut enim blandit volutpat maecenas. Accumsan sit amet nulla facilisi morbi tempus iaculis. Eget nunc lobortis mattis aliquam faucibus purus in massa tempor.\r\n\r\nVenenatis a condimentum vitae sapien pellentesque habitant morbi tristique. Neque viverra justo nec ultrices dui sapien. Pellentesque dignissim enim sit amet. Proin sagittis nisl rhoncus mattis rhoncus urna neque. Nunc faucibus a pellentesque sit amet porttitor eget dolor. Id donec ultrices tincidunt arcu non sodales. Nulla facilisi nullam vehicula ipsum a. Magna ac placerat vestibulum lectus mauris. Etiam tempor orci eu lobortis elementum nibh tellus molestie nunc. Accumsan in nisl nisi scelerisque eu ultrices vitae. Urna duis convallis convallis tellus id interdum velit laoreet. Aliquet nec ullamcorper sit amet risus nullam eget felis eget. Tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Faucibus a pellentesque sit amet porttitor eget dolor morbi. Quis commodo odio aenean sed adipiscing. Elit at imperdiet dui accumsan sit amet.\r\n\r\nSapien faucibus et molestie ac feugiat sed lectus vestibulum. Neque convallis a cras semper auctor neque vitae tempus. Arcu felis bibendum ut tristique et egestas quis ipsum suspendisse. Fringilla ut morbi tincidunt augue interdum velit euismod. Diam vulputate ut pharetra sit amet. Urna molestie at elementum eu facilisis sed odio morbi quis. Nec feugiat nisl pretium fusce id velit ut tortor pretium. Enim ut tellus elementum sagittis vitae et leo duis ut. Sollicitudin nibh sit amet commodo nulla. Ultricies integer quis auctor elit sed. Mi sit amet mauris commodo quis imperdiet massa tincidunt. Venenatis urna cursus eget nunc scelerisque viverra. Senectus et netus et malesuada fames ac turpis egestas maecenas. Risus feugiat in ante metus. Massa massa ultricies mi quis hendrerit. Sed felis eget velit aliquet. Porttitor eget dolor morbi non arcu risus quis varius. Non enim praesent elementum facilisis. Mauris pellentesque pulvinar pellentesque habitant morbi.\r\n\r\nTellus cras adipiscing enim eu turpis egestas pretium aenean pharetra. Tempus egestas sed sed risus pretium quam vulputate. Sapien et ligula ullamcorper malesuada proin libero nunc consequat. Odio facilisis mauris sit amet massa vitae tortor condimentum. Mi tempus imperdiet nulla malesuada pellentesque elit eget. Sed libero enim sed faucibus turpis in eu mi bibendum. Vulputate sapien nec sagittis aliquam malesuada bibendum arcu. Volutpat commodo sed egestas egestas. Eu volutpat odio facilisis mauris sit amet massa vitae tortor. Laoreet sit amet cursus sit amet. Morbi tristique senectus et netus. Non arcu risus quis varius. Amet nisl suscipit adipiscing bibendum est ultricies. Turpis egestas sed tempus urna et. Nulla facilisi nullam vehicula ipsum a arcu cursus vitae congue. Porttitor lacus luctus accumsan tortor posuere ac ut. Duis ultricies lacus sed turpis tincidunt id aliquet.\r\n\r\nTurpis massa tincidunt dui ut ornare lectus sit. Mi quis hendrerit dolor magna eget est lorem. Urna et pharetra pharetra massa massa ultricies mi. Felis eget velit aliquet sagittis id consectetur purus ut. Amet consectetur adipiscing elit ut aliquam purus. Pellentesque id nibh tortor id aliquet lectus proin nibh. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit amet. Egestas maecenas pharetra convallis posuere morbi leo urna molestie at. Elit eget gravida cum sociis. Massa enim nec dui nunc. Viverra ipsum nunc aliquet bibendum enim facilisis gravida neque. Diam quis enim lobortis scelerisque fermentum dui faucibus in ornare. Et netus et malesuada fames ac turpis egestas integer. Iaculis nunc sed augue lacus. Condimentum lacinia quis vel eros donec. Nibh tortor id aliquet lectus proin nibh nisl condimentum id. Morbi blandit cursus risus at. A iaculis at erat pellentesque adipiscing commodo elit at. Aliquet lectus proin nibh nisl.\r\n\r\nVel orci porta non pulvinar. Vulputate enim nulla aliquet porttitor lacus luctus. Turpis egestas pretium aenean pharetra magna ac placerat vestibulum. Cursus mattis molestie a iaculis at erat. Ut placerat orci nulla pellentesque dignissim. Augue eget arcu dictum varius duis at consectetur lorem. Augue ut lectus arcu bibendum at varius vel pharetra vel. Suspendisse interdum consectetur libero id faucibus nisl tincidunt eget nullam. Vel orci porta non pulvinar neque laoreet suspendisse interdum consectetur. At elementum eu facilisis sed odio morbi quis commodo odio. Nulla aliquet porttitor lacus luctus accumsan tortor posuere. Convallis convallis tellus id interdum velit laoreet. Pulvinar sapien et ligula ullamcorper malesuada proin.\r\n\r\nMattis rhoncus urna neque viverra justo nec ultrices dui sapien. Nec feugiat in fermentum posuere urna nec tincidunt praesent semper. Malesuada nunc vel risus commodo viverra. Fringilla ut morbi tincidunt augue interdum. Vitae auctor eu augue ut. Consequat nisl vel pretium lectus quam id leo in vitae. Mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et. Amet cursus sit amet dictum sit. Enim eu turpis egestas pretium aenean pharetra magna. Pretium vulputate sapien nec sagittis.', 1, '2023-02-27 22:15:55', 0, 1, 19),
(13, 'My First Story', 'Netus et malesuada fames ac turpis egestas maecenas pharetra. Turpis egestas sed tempus urna. Vitae tempus quam pellentesque nec nam aliquam. Sagittis purus sit amet volutpat consequat. At imperdiet dui accumsan sit amet nulla facilisi morbi tempus. In pellentesque massa placerat duis ultricies lacus sed turpis. A iaculis at erat pellentesque. Venenatis tellus in metus vulputate eu scelerisque. Phasellus faucibus scelerisque eleifend donec. Dolor purus non enim praesent. Malesuada fames ac turpis egestas maecenas pharetra convallis posuere morbi. At ultrices mi tempus imperdiet. Commodo nulla facilisi nullam vehicula ipsum a arcu. Enim nec dui nunc mattis enim ut tellus.\r\n\r\nOdio tempor orci dapibus ultrices in iaculis nunc sed augue. Neque sodales ut etiam sit amet nisl purus in. Tellus mauris a diam maecenas. Iaculis nunc sed augue lacus viverra vitae congue eu. Pulvinar elementum integer enim neque volutpat ac. Consequat ac felis donec et odio. Mi bibendum neque egestas congue quisque egestas. Ut venenatis tellus in metus vulputate eu scelerisque. Magna ac placerat vestibulum lectus mauris ultrices eros. Purus faucibus ornare suspendisse sed nisi. Aliquam ut porttitor leo a diam sollicitudin. Facilisi cras fermentum odio eu feugiat pretium nibh ipsum consequat. Cursus metus aliquam eleifend mi in nulla. Auctor elit sed vulputate mi sit amet. Lacinia quis vel eros donec. Urna neque viverra justo nec ultrices dui sapien eget.\r\n\r\nQuis ipsum suspendisse ultrices gravida. Vitae et leo duis ut diam quam nulla. Vitae tortor condimentum lacinia quis vel eros donec. Nullam eget felis eget nunc. Adipiscing diam donec adipiscing tristique risus. Diam in arcu cursus euismod quis. Sagittis id consectetur purus ut faucibus pulvinar. Integer quis auctor elit sed vulputate mi sit amet mauris. Fusce id velit ut tortor pretium viverra suspendisse potenti nullam. Mauris in aliquam sem fringilla ut morbi tincidunt augue interdum.', 2, '2023-03-06 01:28:22', 0, 1, 23),
(29, 'asdf', 'asdfag', 1, '2023-03-23 23:50:34', 2, 1, 1),
(30, 'tekken 8 awesome...', 'tekken 8 is coolest game.. to ever exist.\r\n\r\nAccording to director Katsuhiro Harada, Tekken 8 gameplay will focus on \"aggressiveness\" and will have a new \"Heat\" gauge system, in addition to returning gameplay features from Tekken 7, such as Rage system-based attacks, with the Rage Drive having been separated and reworked as a Heat system-based move known as Heat Smash, leaving the Rage State that can only have an access to use Rage Art once more like prior to the Fated Retribution version of Tekken 7. The gameplay will reward aggressiveness rather than those who \"turtle up\". Similar to Soul Charge state from Soulcalibur VI, the Heat State grants not only chip damage, but also changes the properties of some characters’ move sets, such as a heavy guard break. Fighters can also dash cancel their designate moves into the Heat State, similar to MAX Mode from The King of Fighters series. The Heat State’s timer can be stopped if fighters’ move sets are being used.\r\n\r\nThere will also be a focus on stage destruction, character reactions to these, and making the gameplay enjoyable to watch as well as play, since Tekken is now considered a high-level e-sports game. This new system was based on reception to the predecessor. Tekken 7’s “Screw” damage property was originally going to return in this game, but it is ultimately replaced with a newer juggle combo extender system that puts opponent into a ground-bound-like state upon falling to the ground quickly - similar to Tekken 6 - whether the combo extender be a launcher or a knockback. When guarding against a normal state’s heavy attack, or Heat State characters, fighters will receive a chip damage that causes their health bar to become regenerable. However, unlike the Tag mode-only health bar regeneration system from Tekken Tag Tournament games, fighters’ recoverable health can only be recovered via guarding against normal state characters, or attacks.\r\n\r\nRather than recycling content, all character models are completely new and are meant to be an improvement over previous games. In addition, voice lines will be based solely on the current voice actors, rather than using any from the previous games. In contrast to Tekken 7, which is powered by Unreal Engine 4, Tekken 8 will be powered by the Unreal Engine 5, making it the very first major fighting game to utilize this latest game engine. \r\n\r\nAccording to director Katsuhiro Harada, Tekken 8 gameplay will focus on \"aggressiveness\" and will have a new \"Heat\" gauge system, in addition to returning gameplay features from Tekken 7, such as Rage system-based attacks, with the Rage Drive having been separated and reworked as a Heat system-based move known as Heat Smash, leaving the Rage State that can only have an access to use Rage Art once more like prior to the Fated Retribution version of Tekken 7. The gameplay will reward aggressiveness rather than those who \"turtle up\". Similar to Soul Charge state from Soulcalibur VI, the Heat State grants not only chip damage, but also changes the properties of some characters’ move sets, such as a heavy guard break. Fighters can also dash cancel their designate moves into the Heat State, similar to MAX Mode from The King of Fighters series. The Heat State’s timer can be stopped if fighters’ move sets are being used.\r\n\r\nThere will also be a focus on stage destruction, character reactions to these, and making the gameplay enjoyable to watch as well as play, since Tekken is now considered a high-level e-sports game. This new system was based on reception to the predecessor. Tekken 7’s “Screw” damage property was originally going to return in this game, but it is ultimately replaced with a newer juggle combo extender system that puts opponent into a ground-bound-like state upon falling to the ground quickly - similar to Tekken 6 - whether the combo extender be a launcher or a knockback. When guarding against a normal state’s heavy attack, or Heat State characters, fighters will receive a chip damage that causes their health bar to become regenerable. However, unlike the Tag mode-only health bar regeneration system from Tekken Tag Tournament games, fighters’ recoverable health can only be recovered via guarding against normal state characters, or attacks.\r\n\r\nRather than recycling content, all character models are completely new and are meant to be an improvement over previous games. In addition, voice lines will be based solely on the current voice actors, rather than using any from the previous games. In contrast to Tekken 7, which is powered by Unreal Engine 4, Tekken 8 will be powered by the Unreal Engine 5, making it the very first major fighting game to utilize this latest game engine. \r\n\r\nAccording to director Katsuhiro Harada, Tekken 8 gameplay will focus on \"aggressiveness\" and will have a new \"Heat\" gauge system, in addition to returning gameplay features from Tekken 7, such as Rage system-based attacks, with the Rage Drive having been separated and reworked as a Heat system-based move known as Heat Smash, leaving the Rage State that can only have an access to use Rage Art once more like prior to the Fated Retribution version of Tekken 7. The gameplay will reward aggressiveness rather than those who \"turtle up\". Similar to Soul Charge state from Soulcalibur VI, the Heat State grants not only chip damage, but also changes the properties of some characters’ move sets, such as a heavy guard break. Fighters can also dash cancel their designate moves into the Heat State, similar to MAX Mode from The King of Fighters series. The Heat State’s timer can be stopped if fighters’ move sets are being used.\r\n\r\nThere will also be a focus on stage destruction, character reactions to these, and making the gameplay enjoyable to watch as well as play, since Tekken is now considered a high-level e-sports game. This new system was based on reception to the predecessor. Tekken 7’s “Screw” damage property was originally going to return in this game, but it is ultimately replaced with a newer juggle combo extender system that puts opponent into a ground-bound-like state upon falling to the ground quickly - similar to Tekken 6 - whether the combo extender be a launcher or a knockback. When guarding against a normal state’s heavy attack, or Heat State characters, fighters will receive a chip damage that causes their health bar to become regenerable. However, unlike the Tag mode-only health bar regeneration system from Tekken Tag Tournament games, fighters’ recoverable health can only be recovered via guarding against normal state characters, or attacks.\r\n\r\nRather than recycling content, all character models are completely new and are meant to be an improvement over previous games. In addition, voice lines will be based solely on the current voice actors, rather than using any from the previous games. In contrast to Tekken 7, which is powered by Unreal Engine 4, Tekken 8 will be powered by the Unreal Engine 5, making it the very first major fighting game to utilize this latest game engine. ', 6, '2023-03-24 00:08:51', 0, 6, 8),
(32, 'free', 'asdfasf', 1, '2023-03-24 11:21:30', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD KEY `FK_userbookmark` (`userid`),
  ADD KEY `FK_writingbookmark` (`writingid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`user1id`,`user2id`);

--
-- Indexes for table `contest`
--
ALTER TABLE `contest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contestsubcat` (`subcategoryID`),
  ADD KEY `fk_hostID` (`hostID`);

--
-- Indexes for table `contestusers`
--
ALTER TABLE `contestusers`
  ADD PRIMARY KEY (`contestID`,`writerID`),
  ADD KEY `writerID` (`writerID`);

--
-- Indexes for table `grouplist`
--
ALTER TABLE `grouplist`
  ADD PRIMARY KEY (`groupID`,`userID`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_subcat` (`catid`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `topicwriting`
--
ALTER TABLE `topicwriting`
  ADD PRIMARY KEY (`wid`,`tid`),
  ADD KEY `fk_t_id` (`tid`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `fk_groupuserID` (`ownerID`);

--
-- Indexes for table `usernames`
--
ALTER TABLE `usernames`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `writing`
--
ALTER TABLE `writing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_writingAuthor` (`authorID`),
  ADD KEY `subcategoryID` (`subcategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contest`
--
ALTER TABLE `contest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `groupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usernames`
--
ALTER TABLE `usernames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `writing`
--
ALTER TABLE `writing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `FK_userbookmark` FOREIGN KEY (`userid`) REFERENCES `usernames` (`id`),
  ADD CONSTRAINT `FK_writingbookmark` FOREIGN KEY (`writingid`) REFERENCES `writing` (`id`);

--
-- Constraints for table `contest`
--
ALTER TABLE `contest`
  ADD CONSTRAINT `contestsubcat` FOREIGN KEY (`subcategoryID`) REFERENCES `subcategory` (`id`),
  ADD CONSTRAINT `fk_hostID` FOREIGN KEY (`hostID`) REFERENCES `usernames` (`id`);

--
-- Constraints for table `contestusers`
--
ALTER TABLE `contestusers`
  ADD CONSTRAINT `contestusers_ibfk_1` FOREIGN KEY (`contestID`) REFERENCES `contest` (`id`),
  ADD CONSTRAINT `contestusers_ibfk_2` FOREIGN KEY (`writerID`) REFERENCES `usernames` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `FK_subcat` FOREIGN KEY (`catid`) REFERENCES `category` (`id`);

--
-- Constraints for table `topicwriting`
--
ALTER TABLE `topicwriting`
  ADD CONSTRAINT `fk_t_id` FOREIGN KEY (`tid`) REFERENCES `topic` (`tid`),
  ADD CONSTRAINT `fk_w_id` FOREIGN KEY (`wid`) REFERENCES `writing` (`id`);

--
-- Constraints for table `userlist`
--
ALTER TABLE `userlist`
  ADD CONSTRAINT `fk_groupuserID` FOREIGN KEY (`ownerID`) REFERENCES `usernames` (`id`);

--
-- Constraints for table `writing`
--
ALTER TABLE `writing`
  ADD CONSTRAINT `FK_writingAuthor` FOREIGN KEY (`authorID`) REFERENCES `usernames` (`id`),
  ADD CONSTRAINT `writing_ibfk_1` FOREIGN KEY (`subcategoryID`) REFERENCES `subcategory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
