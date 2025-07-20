CREATE TABLE categories (
    category VARCHAR(2) PRIMARY KEY,
    CHECK (category IN ('SF', 'F', 'R', 'B', 'Hi', 'Hr', 'M', 'T', 'A', 'K', 'C'))
    -- SF: Science fiction , F: fantasy , R: romance, B: biography , Hi: history , Hr: Horror , M: mystery , T: thriller , A: adventure , K: kids , C: classic
);

CREATE TABLE book (
    bookID INT AUTO_INCREMENT PRIMARY KEY,
    title NVARCHAR(100) NOT NULL,
    auther NVARCHAR(100) NOT NULL,
    price SMALLINT NOT NULL CHECK(price > 0),
    intro NVARCHAR(5000),
    picture VARCHAR(255),
    language CHAR(1) CHECK(language IN ('H', 'E')),
    stock SMALLINT DEFAULT 0 CHECK(stock >= 0),
	purchaseNum int DEFAULT 0,
	recommend bit DEFAULT 0
);

CREATE TABLE book_categories (
    bookID INT,
    category VARCHAR(2),
    PRIMARY KEY (bookID, category),
    FOREIGN KEY (bookID) REFERENCES book(bookID) ON DELETE CASCADE,
    FOREIGN KEY (category) REFERENCES categories(category) ON DELETE CASCADE
);

CREATE TABLE `user` (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    fname NVARCHAR(50) NOT NULL,
    lname NVARCHAR(50) NOT NULL,
    dateOfBirth DATE NOT NULL,
    userName NVARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    gender CHAR(1) CHECK (gender IN ('M', 'F')),
    email VARCHAR(50) NOT NULL UNIQUE CHECK (email REGEXP '^[^@]+@[^@]+\\.[^@]+$'),
    phone CHAR(10) UNIQUE CHECK (phone REGEXP '^0[0-9]{9}$'),
    country NVARCHAR(50),
    website NVARCHAR(255) CHECK (website LIKE 'https://%'),
    favoriteNumber INT CHECK (favoriteNumber > 0),
    favoriteColor VARCHAR(7) CHECK (favoriteColor REGEXP '^#[0-9A-Fa-f]{6}$'),
    contactTime TIME,
    registrationDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    profilePicture NVARCHAR(255),
    about NVARCHAR(255),
	rating SMALLINT CHECK (rating >= 0 AND rating <= 10),
    
    CHECK (
        CHAR_LENGTH(password) >= 8 AND
        password REGEXP '[0-9]' AND
        password REGEXP '[a-z]' AND
        password REGEXP '[A-Z]' AND
        password REGEXP '[!@#$%^&*]'
    )
);

CREATE TABLE `admin` (
    userID INT PRIMARY KEY,
    userName NVARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO `admin` (userID, userName, password) VALUES (0, 'admin', 'admin');

CREATE TABLE favorites (
    userID INT,
    bookID INT,
    PRIMARY KEY (userID, bookID),
    FOREIGN KEY (userID) REFERENCES `user`(userID) ON DELETE CASCADE,
    FOREIGN KEY (bookID) REFERENCES book(bookID)
);

CREATE TABLE shopping_cart (
    userID INT PRIMARY KEY,
    FOREIGN KEY (userID) REFERENCES `user`(userID) ON DELETE CASCADE
);

CREATE TABLE cart_items (
    userID INT,
    bookID INT,
    quantity INT DEFAULT 1 CHECK(quantity > 0),
    PRIMARY KEY (userID, bookID),
    FOREIGN KEY (userID) REFERENCES shopping_cart(userID) ON DELETE CASCADE,
    FOREIGN KEY (bookID) REFERENCES book(bookID)
);

CREATE TABLE orders (
    orderID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT,
    orderDate DATE DEFAULT CURRENT_DATE,
    amount INT CHECK(amount > 0),
    city NVARCHAR(50) NOT NULL CHECK (street NOT REGEXP '[0-9!@#\$%\^&\*\(\)_=\[\]\{\};:"\\|,.<>\/?]'),
    street NVARCHAR(50) NOT NULL CHECK (street NOT REGEXP '[0-9!@#\$%\^&\*\(\)_=\[\]\{\};:"\\|,.<>\/?]'),
    houseNumber NVARCHAR(3) NOT NULL CHECK (houseNumber REGEXP '^[0-9]+$'),
    zipCode NVARCHAR(8) NOT NULL CHECK (zipCode REGEXP '^[0-9]+$'),
    shipping BIT DEFAULT 0,
    paid BIT DEFAULT 0,
    FOREIGN KEY (userID) REFERENCES `user`(userID)
);


CREATE TABLE order_items (
    orderID INT,
    bookID INT,
    quantity INT DEFAULT 1 CHECK(quantity > 0),
    pricePerUnit SMALLINT NOT NULL CHECK(pricePerUnit > 0),
    PRIMARY KEY (orderID, bookID),
    FOREIGN KEY (orderID) REFERENCES orders(orderID) ON DELETE CASCADE,
    FOREIGN KEY (bookID) REFERENCES book(bookID)
);
