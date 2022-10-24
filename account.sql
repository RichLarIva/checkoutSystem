CREATE TABLE Accounts (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE KEY,
    user_type TINYINT(1) DEFAULT(0),
    passwrd VARCHAR(250) NOT NULL,
    email VARCHAR(100) NOT NULL,
    reg_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Accounts (Username, User_Type, Passwrd, Email) VALUES ('testAccount', '1', 'password123', 'test@bruhmail.com');