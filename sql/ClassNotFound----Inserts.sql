
-- --------------------------------------------------------
--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'General\r\n'),
(2, 'Algorithms'),
(3, 'AI'),
(4, 'Big Data'),
(5, '3D Graphics'),
(6, 'Web');


-- --------------------------------------------------------
--
-- Dumping data for table `users`
--
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `admin`, `state`, `image`) VALUES
(1, 'Brandon', 'Ngoran Ntam', 'brandonzoom886@gmail.com', '$2y$10$iYe05cK/dwJUKDzwcsBL8ec4ZH9daVg6iiQp2I66riNbaH9hD.TmO', 1, 'Active', NULL),
(2, 'Harry', 'Potter', 'harrypotter@hogwarts.com', '$2y$10$H4c8NXCPIHboBvBZuSURweY2XhNR2HaVoD3.fbzt19fIp4ep4Ize6', 0, 'Active', NULL),
(3, 'Jon', 'Snow', 'jonsnow@winterfell.com', '$2y$10$ng83FlqNfCSCbLi9xArftOjAYiPe1kgDZQziBrrcNXv7mBRCN1s/a', 0, 'Active', NULL),
(4, 'Jack', 'Shephard', 'lost@nowhere.com', '$2y$10$jp6Ln0AQE.clIt4HQ.2tbe9hGcVkfF68urqG7LrgwVEBPrutFUZ9u', 0, 'Suspended', NULL),
(5, 'Frank', 'Castle', 'punisher@marvel.com', '$2y$10$Fv6u4kmk5FRPuEZHUCJvReU0VtUn3NFQCE3YDyYuixqGBjZ8sfXyi', 0, 'Active', NULL),
(6, 'Hermione', 'Granger', 'hermione@hogwarts.com', '$2y$10$6nwipuMNbbUhVArEigSpXePkySnSXi8DCgRujnfyNc/0kG9vhOU4u', 1, 'Active', NULL),
(7, 'Daisy', 'Johnson', 'quake@marvel.com', '$2y$10$ZBl.j1ny6iJgOxL0MlvrrOVFJUulYjS/BlaRL7R3wmNH4bsJjQpfm', 0, 'Suspended', NULL),
(8, 'Soulaïmane', 'Benaicha', 'souli@gmail.com', '$2y$10$xX1gYoPN0UXL9d9UyYA/ReKKgi.Pm2ZvZlAec.eYasw1dUoU40yMy', 1, 'Active', NULL);



-- --------------------------------------------------------
--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `user_id`, `category_id`, `title`, `subject`, `creation_date`, `state`) VALUES
(1, 1, 2, 'What is a switch statement in Java?', 'I have a test on all the different statements in Java and I don\'t understand what a switch statement does', '2019-05-12 18:33:10', 'Open'),
(2, 2, 1, 'Muggles trying on The Sorting Hat', 'What would happen if a muggle tried on the Sorting Hat?\r\nWill the Hat speak? Will it just be an ordinary hat? I need to know what will happen...', '2019-05-12 18:39:32', 'Duplicate'),
(3, 3, 4, 'What is Big Data & What classifies as Big data? ', 'I have went through a lot of articles but I don\'t seem to get a perfectly clear answer on what exactly a BIG DATA is. In one page I saw \"any data which is bigger for your usage, is big data i.e. 100 MB is considered big data for your mailbox but not your hard disc\". Whereas another article said \"big data to be usually more than 1 TB with different volume / variety / velocity and couldn\'t be stored in a single system\". ', '2019-05-12 18:44:06', 'Solved'),
(4, 4, 5, 'How to create a real 3D game, stereo. (not 3D graphics, but 3D screen)', 'I need your help. Is it possible to write a game in 3d on a canvas? If so, how. Maybe a small example of 2 blocks?\r\n** With 3D I don\'t mean 3D graphics in OpenGL, or on canvas while you use your brain to apply vector calculus to project the 3D graphics on a 2D screen. I mean program for LG Op3D/HTC Evo 3D!**\r\nThanks in advance', '2019-05-12 18:49:41', 'Open'),
(5, 5, 6, 'How can I embed a Youtube feed?', 'I want to embed the Youtube upload page of my channel on my website. I would like to know how I could do this. iframe doesn\'t seem to work.', '2019-05-12 19:37:36', 'Solved');





--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `user_id`, `question_id`, `subject`, `creation_date`, `right_answer`) VALUES
(1, 1, 2, 'Something similar to this situation did actually occur in the Harry Potter universe. A Squib named Angus Buchanan (who was a real-life rugby player) was born to pureblood parents John* and Mary* Buchanan who disliked Muggles (sound familiar?). He and his ten siblings were worried because he showed no sign of magic throughout his childhood, and then no Hogwarts letter came for him. Knowing that the parents would disown him for his Squib status, his siblings came up with a scheme to prevent their parents from knowing. Flora** Buchanan forged him a letter, and Hamish** Buchanan took him to Hogwarts via broomstick, hoping that the school would at least let him stay. Angus was in the crowd of first-years waiting to be Sorted, and since he knew that his name would never be called, he ran up to the hat before the girl whose name was called. The Hat announced that he was “a good-hearted chap, but no wizard,” causing Angus to leave the room in tears and return back home on foot (luckily, he lived in Scotland). His father refused to let him in and kicked him out by firing curses at him.\r\n\r\nI assume that the Hat would say something similar to what he did when Buchanan tried it on. Of course, no Muggle would actually be able to get into Hogwarts since they cannot see the castle (unless a charm was placed for emergencies with their Muggle-born or half-blood child).', '2019-05-12 06:39:23', 0),
(2, 1, 3, 'There is no official definition of Big Data, of course. What one person considers Big Data may just be a traditional data set in another person’s eyes.\r\nThat doesn’t mean that people don’t offer up various definitions for Big Data, however. For example, some would define it as any type of data that is distributed across multiple systems.\r\nIn some respects, that’s a good definition. Distributed systems tend to produce much more data than localized ones because distributed systems involve more machines, more services, and more applications, all of which generate more logs containing more data.\r\nOn the other hand, you can have a distributed system that doesn’t involve much data. For instance, if I mount my laptop’s 500-gigabyte hard disk over the network so that I can share it with other computers in my house, I would technically be creating a distributed data environment. But most people wouldn’t consider this an example of Big Data.\r\n\r\nAnother way to try to define Big Data is to compare it to “little data.” In this definition, it is any type of data that is processed using advanced analytics tools, while little data is interpreted in less sophisticated ways. The size of the actual data sets isn’t important in this definition.', '2019-05-12 06:44:33', 0),
(3, 1, 4, 'For the HTC Evo 3D go to HTC developer website htcdev.com There you can download the OpenSense SDK which contains the S3D API and sample code for S3D rendering (Stereoscopic 3D rendering).\r\nYou have to render the scene twice which gives you more control on the S3D effect on the one hand, but on the other hand you have to choose your camera view\'s carefully.\r\n\r\n(With other hardware accessories, like nVIDIA\'s 3d vision, a 3D scene is rendered twice by the driver, no options to change the views of the two cameras from the programmer\'s point of view).', '2019-05-12 06:45:20', 0),
(4, 1, 5, 'There are two options available for you: (1) embed the webpage as a blockquote using Embedly, or (2) make a playlist of your uploaded videos and embed the playlist.\r\nUse Embedly: The website Embedly uses a script to embed any webpage, including the uploads page of your YouTube channel, into a block quote. You\'ll be using their script in your HTML, so no guarantees on quality.\r\nMake a playlist of your uploaded videos, then embed the playlist into your website by following the instructions on this page.\r\nGood luck!', '2019-05-12 06:45:55', 1),
(5, 5, 2, 'What would happen is probably either the Sorting Hat not being able to sort the muggle due to not having any magic(though from my knowledge, nowhere does it say in the books that one needs magic to be sorted), therefore not being able to participate in any of the Houses at Hogwarts, or it sorts the muggle into a House anyway based on their traits.', '2019-05-12 06:49:19', 0),
(6, 5, 3, 'Big data is extremely large data sets that may be analysed computationally to reveal patterns, trends, and associations, especially relating to human behaviour and interactions.', '2019-05-12 06:54:27', 0),
(7, 5, 4, '\r\nShort answer: link.\r\n\r\nMore elaborate answer:\r\n\r\nMany 3D TVs have accept multiple types of input to render 3D, most notably - side by side.\r\n\r\nIf you are interested in getting a quick start at producing a 3D game (or just a 3D scene), you could use a graphics engine (such as jMonkeyEngine), create 2 view ports side by side, and render your scene in each of the view ports from separate camera angles. If you connect your 3D TV and set its 3D mode to side by side - you will see the scene in 3D.', '2019-05-12 06:55:34', 0),
(8, 6, 1, 'A switch statement allows a variable to be tested for equality against a list of values. Each value is called a case, and the variable being switched on is checked for each case.', '2019-05-12 06:59:29', 0),
(9, 6, 1, 'Unlike if-then and if-then-else statements, the switch statement can have a number of possible execution paths. A switch works with the byte, short, char, and int primitive data types. It also works with enumerated types (discussed in Enum Types), the String class, and a few special classes that wrap certain primitive types: Character, Byte, Short, and Integer (discussed in Numbers and Strings).', '2019-05-12 07:00:00', 0),
(10, 6, 4, 'Nvidia seems to have a driver or library that automatically converts a conventional 3D game to the 3D stereo game. http://www.nvidia.com/object/product-geforce-3d-vision-wired-glasses-us.html                   \r\nI guess if you want to do it yourself, you just need to render the same scene twice with slightly shifted camera. and somehow you combine the two rendered result together, you will make your game real 3D.', '2019-05-12 07:00:57', 0),
(11, 7, 3, 'Big data is a term that describes the large volume of data – both structured and unstructured – that inundates a business on a day-to-day basis. But it’s not the amount of data that’s important. It’s what organizations do with the data that matters. Big data can be analyzed for insights that lead to better decisions and strategic business moves.', '2019-05-13 08:08:01', 1),
(12, 7, 1, 'In computer programming languages, a switch statement is a type of selection control mechanism used to allow the value of a variable or expression to change the control flow of program execution via search and map.\r\n\r\nSwitch statements function somewhat similarly to the if statement used in programming languages like C/C++, C#, Visual Basic .NET, Java and exists in most high-level imperative programming languages such as Pascal, Ada, C/C++, C#, Visual Basic .NET, Java, and in many other types of language, using such keywords as switch, case, select or inspect.', '2019-05-13 08:08:58', 0);

-- --------------------------------------------------------
--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `user_id`, `answer_id`, `state`) VALUES
(1, 5, 1, 1),
(2, 5, 7, 1),
(3, 5, 4, 1),
(4, 6, 8, 1),
(5, 6, 9, 1),
(6, 7, 11, 1),
(7, 7, 9, 1),
(8, 7, 8, 0),
(9, 3, 11, 1),
(10, 4, 12, 1),
(11, 4, 8, 0);
