-- Categories
INSERT INTO categories (category) VALUES
('SF'), ('F'), ('R'), ('B'), ('Hi'), ('Hr'), ('M'), ('T'), ('A'), ('K'), ('C');

-- Users
INSERT INTO `user` (fname, lname, dateOfBirth, userName, password, gender, email, phone, country, website, favoriteNumber, favoriteColor, contactTime, profilePicture, about, rating) VALUES
('Alice', 'Smith', '1990-04-15', 'asmith', 'Alice@2023!', 'F', 'alice26@example.com', '0123456699', 'USA', 'https://aliceblog.com', 7, '#FF5733', '09:30:00', 'alice_profile.jpg', 'Love to travel and write.', 8),
('Bob', 'Johnson', '1985-11-02', 'bobbyJ', 'B0b@Secure!', 'M', 'bob.j@example.org', '0987654321', 'Canada', 'https://bobjohnson.dev', 12, '#33FF99', '14:45:00', '/images/bob_pic.png', 'Software engineer and guitarist.', 10),
('Clara', 'Lee', '1995-06-25', 'claralee', 'Clar@2024!', 'F', 'clara.lee@example.net', '0212345678', 'Australia', 'https://claralee.io', 5, '#4455FF', '08:15:00', 'clara.png', 'Digital artist and coffee lover.', 3),
('David', 'Wong', '1992-03-10', 'daveW', 'D@vidW!2025', 'M', 'david.wong@example.com', '0345678912', 'Singapore', 'https://wongblog.sg', 9, '#AA22FF', '17:00:00', 'profile/dave.jpg', 'Tech enthusiast and blogger.', 9),
('Emma', 'Brown', '1988-08-18', 'emmbrown', 'E!mma2024$', 'F', 'emma.brown@example.org', '0456789123', 'UK', 'https://emmabrown.art', 3, '#00CCFF', '12:30:00', '/users/emma_profile.jpg', 'Painter and nature lover.', 9);
INSERT INTO `user` (fname, lname, dateOfBirth, userName, password, gender, email, phone) VALUES
('Alice', 'Smith', '1990-05-12', 'alice90', 'Pass!word1', 'F', 'alice@example.com', '0541234567'),
('Bob', 'Jones', '1985-11-23', 'bobby85', 'Bob@Secure2', 'M', 'bob@example.com', '0522345678'),
('Charlie', 'Lee', '1995-08-30', 'charlie95', 'Ch@rlie3X', 'M', 'charlie@example.com', '0509876543');

-- Books
INSERT INTO book (title, auther, price, intro, picture, `language`, stock, purchaseNum, recommend) VALUES   
('Dune', 'Frank Herbert', 80, 'A science fiction epic set on the desert planet Arrakis. Dune tells the story of Paul Atreides, a young noble caught in a complex struggle over the most valuable substance in the universe—spice. It explores themes of politics, religion, and human destiny.', 'https://m.media-amazon.com/images/M/MV5BNWIyNmU5MGYtZDZmNi00ZjAwLWJlYjgtZTc0ZGIxMDE4ZGYwXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', 'E', 10, 50, 1),
('Harry Potter', 'J.K. Rowling', 60, 'The first book in the beloved fantasy series follows Harry Potter, a seemingly ordinary boy who discovers he is a wizard. He enters the magical world of Hogwarts, where he forges deep friendships, uncovers hidden truths, and faces the dark legacy of Lord Voldemort.', 'https://m.media-amazon.com/images/M/MV5BNGJhM2M2MWYtZjIzMC00MDZmLThkY2EtOWViMDhhYjRhMzk4XkEyXkFqcGc@._V1_.jpg', 'E', 5, 200, 0),
('הארי פוטר', 'ג׳יי קיי רולינג', 70, 'תחילת סאגת הפנטזיה האגדית על הארי פוטר, ילד יתום שמגלה כי הוא קוסם. הוא מגיע להוגוורטס – בית הספר לקוסמים, שם הוא מוצא חברים, אויבים, ולומד על כוח, אהבה, והתמודדות עם רשע עתיק.', 'https://m.media-amazon.com/images/M/MV5BNzU3NDg4NTAyNV5BMl5BanBnXkFtZTcwOTg2ODg1Mg@@._V1_FMjpg_UX1000_.jpg', 'H', 4, 10, 1),
('1984', 'George Orwell', 55, 'A powerful dystopian novel about a future where totalitarian regimes suppress free thought. Winston Smith, a minor party official, begins to question the system and its manipulations. The book explores themes of truth, surveillance, and resistance.', 'https://m.media-amazon.com/images/I/61NAx5pd6XL._AC_UF1000,1000_QL80_.jpg', 'E', 8, 120, 1),
('The Hobbit', 'J.R.R. Tolkien', 65, 'A charming prelude to The Lord of the Rings, The Hobbit tells the story of Bilbo Baggins, a peaceful hobbit swept into a grand adventure with dwarves and dragons. It explores bravery, greed, and personal growth through mythical storytelling.', 'https://m.media-amazon.com/images/I/71jD4jMityL._AC_UF1000,1000_QL80_.jpg', 'E', 7, 90, 1),
('To Kill a Mockingbird', 'Harper Lee', 50, 'Set in the Deep South, the novel explores racial injustice through the eyes of Scout, a young girl. Her father, Atticus Finch, defends a black man wrongly accused of rape. It is a poignant reflection on morality, empathy, and social change.', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1612238791i/56916837.jpg', 'E', 6, 75, 0),
('Pride and Prejudice', 'Jane Austen', 45, 'A witty romantic novel exploring the life and societal expectations of Elizabeth Bennet in 19th-century England. It examines love, class, and the struggle between personal happiness and social duty.', 'https://m.media-amazon.com/images/I/712P0p5cXIL._AC_UF1000,1000_QL80_.jpg', 'E', 9, 60, 0),
('הנסיך הקטן', 'אנטואן דה סנט-אכזופרי', 40, 'סיפור פילוסופי קסום שמתאר את מסעו של נסיך קטן מכוכב אחר. בדרכו הוא פוגש טיפוסים שונים ולומד על חברות, אהבה, ואובדן. הספר מלא באלגוריות על החיים הבוגרים וילדותיות נצחית.', 'https://www.am-oved.co.il/Media/Uploads/%D7%A2%D7%98%D7%99%D7%A4%D7%94_%D7%94%D7%A0%D7%A1%D7%99%D7%9A_%D7%97%D7%92%D7%99%D7%92%D7%99(2)_jpg.webp', 'H', 6, 35, 1),
('מלחמה ושלום', 'לב טולסטוי', 85, 'רומן היסטורי אדיר ממדים שמציג את חייהם של אצילים רוסים בתקופת פלישת נפוליאון. הספר בוחן את השפעת המלחמה על היחיד, אהבה, אובדן, ותכלית החיים.', 'https://www.kibutz-poalim.co.il/Media/Uploads/sqr-316122_B(2).jpg', 'H', 3, 20, 1),
('Sapiens', 'Yuval Noah Harari', 70, 'A compelling narrative that traces the evolution of Homo sapiens from primitive hunters to modern society. Harari challenges perceptions about progress, capitalism, and human happiness through a sweeping historical lens.', 'https://m.media-amazon.com/images/I/61ZKK6Y1nFL._AC_UF1000,1000_QL80_.jpg', 'E', 10, 150, 1),
('צופן דה וינצ׳י', 'דן בראון', 60, 'מותחן אינטלקטואלי שמוביל את הפרופסור רוברט לנגדון במסע לחשוף סודות עתיקים בין דפי ההיסטוריה של הנצרות. רמזים, כתות סודיות, וציורים של דה וינצ’י יוצרים עלילה מסחררת.', 'https://www.e-vrit.co.il/Images/Products/covers_2017/_master(21).jpg', 'H', 5, 55, 0),
('Game of Thrones', 'George R.R. Martin', 75, 'An intricate tale of noble families vying for power in the land of Westeros. Betrayal, dragons, and shifting alliances define this epic fantasy filled with complex characters and brutal consequences.', 'https://m.media-amazon.com/images/I/71Jzezm8CBL.jpg', 'E', 4, 110, 1),
('Brave New World', 'Aldous Huxley', 58, 'A haunting vision of a future dominated by technological advancement and societal control. Citizens live in engineered happiness, but at the cost of individuality and truth. A critique of consumerism and state power.', 'https://upload.wikimedia.org/wikipedia/en/thumb/6/62/BraveNewWorld_FirstEdition.jpg/250px-BraveNewWorld_FirstEdition.jpg', 'E', 0, 82, 1),
('שירה', 'שי עגנון', 52, 'רומן מורכב ועמוק המתאר את חייו של פרופסור מנוח אברבנאל והתאהבותו בשירה – אישה מסתורית שמטלטלת את עולמו בירושלים של תקופת המנדט. הספר חוקר את גבולות האהבה והאובססיה.', 'https://www.steimatzky.co.il/pub/media/catalog/product/cache/054fd023ed4beb824f3143faa6fcc008/0/1/011660153-1635776763339702.jpg', 'H', 3, 14, 0),
('The Catcher in the Rye', 'J.D. Salinger', 48, 'A rebellious teen, Holden Caulfield, wanders New York after being expelled from school. He struggles with alienation and the hypocrisy of adult society in this defining work of post-war American literature.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsbc1zdENJb4IB67nkhA6nDbs2Mb2Qt7tNhQ&s', 'E', 5, 65, 0),
('The Great Gatsby', 'F. Scott Fitzgerald', 50, 'A mysterious millionaire, Jay Gatsby, throws lavish parties in hopes of reuniting with his lost love. The novel critiques the decadence of the Roaring Twenties and the elusive nature of the American dream.', 'https://m.media-amazon.com/images/I/81TLiZrasVL.jpg', 'E', 7, 112, 1),
('The Road', 'Cormac McCarthy', 60, 'A haunting post-apocalyptic tale of a father and son journeying through a devastated landscape. The novel explores themes of survival, love, and the fading remnants of civilization.', 'https://www.sfbok.se/sites/default/files/styles/1000x/sfbok/sfbokbilder/731/731040.jpg?bust=1719560403&itok=9O320ygQ', 'E', 5, 88, 1),
('The Picture of Dorian Gray', 'Oscar Wilde', 48, 'A philosophical novel about a young man who remains physically youthful while his portrait ages and reflects his moral corruption. The book is a meditation on beauty, vanity, and conscience.', 'https://covers.storytel.com/jpg-640/9782378072513.ae79b1db-de10-4c0b-89cb-e995b01c9070?optimize=high&quality=70&width=600', 'E', 7, 64, 0),
('A Clockwork Orange', 'Anthony Burgess', 55, 'A controversial and provocative novel exploring free will, violence, and societal reform. The story follows Alex, a teenage delinquent, in a dystopian future of psychological conditioning.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTvppmK6VPTuzE6bjLUmVZV2XxS19KDXxgDw&s', 'E', 0, 47, 1),
('The Kite Runner', 'Khaled Hosseini', 58, 'A moving story of friendship, betrayal, and redemption set in Afghanistan. Amir, haunted by guilt, seeks forgiveness decades later. The novel interweaves personal and political histories.', 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1541428344i/17165596.jpg', 'E', 4, 102, 1),
('Slaughterhouse-Five', 'Kurt Vonnegut', 53, 'A darkly satirical anti-war novel blending science fiction and autobiography. It follows Billy Pilgrim, who becomes "unstuck in time," reflecting on the horrors of war and human absurdity.', 'https://m.media-amazon.com/images/I/71Q0c9qf-1L.jpg', 'E', 0, 76, 1);


-- Book Categories
INSERT INTO book_categories (bookID, category) VALUES
(1, 'SF'),
(2, 'F'),
(3, 'K'),
(4, 'D'),
(5, 'F'),
(6, 'Hi'),
(7, 'R'),
(8, 'K'),
(10, 'C'),
(11, 'T'),
(13, 'D'),
(14, 'R'),
(15, 'B'),
(16, 'D'),
(17, 'SF'),
(18, 'P'),
(21, 'SF');


-- Favorites
INSERT INTO favorites (userID, bookID) VALUES
(1, 5),
(1, 8),
(1, 1),
(1, 4),
(1, 2),
(2, 1),
(3, 1);

-- Shopping Carts
INSERT INTO shopping_cart (userID) VALUES
(0), (1), (2), (3), (4), (5), (6), (7), (8);

-- Cart Items
INSERT INTO cart_items (userID, bookID, quantity) VALUES
(1, 2, 1),
(2, 1, 2),
(3, 3, 1);
