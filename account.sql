CREATE TABLE account (
                         id INTEGER PRIMARY KEY AUTOINCREMENT,
                         username VARCHAR(50) UNIQUE,
                         password VARCHAR(9),
                         fullname VARCHAR(50) NOT NULL,
                         dob VARCHAR(9) NOT NULL,
                         gender INTEGER,
                         email VARCHAR(50) NOT NULL,
                         mobile VARCHAR(10) NOT NULL,
                         address VARCHAR(200) NOT NULL,
                         state CHAR(2) NOT NULL,
                         city VARCHAR(20) NOT NULL,
                         permission INTEGER
);

INSERT INTO account (username, password, fullname, dob, gender, email, mobile, address, state, city, permission)
VALUES ('admin', 'admin123', 'Admin User', '01/01/1970', 1, 'admin@example.com', '1234567890', '123 Main St', 'CA', 'Los Angeles', 1);

INSERT INTO account (username, password, fullname, dob, gender, email, mobile, address, state, city, permission)
VALUES ('johndoe', 'password1', 'John Doe', '02/14/1990', 1, 'johndoe@example.com', '9876543210', '456 Elm St', 'NY', 'New York', 0);

INSERT INTO account (username, password, fullname, dob, gender, email, mobile, address, state, city, permission)
VALUES ('janedoe', 'password2', 'Jane Doe', '06/23/1992', 2, 'janedoe@example.com', '5551234567', '789 Oak Ave', 'CA', 'San Francisco', 0);

INSERT INTO account (username, password, fullname, dob, gender, email, mobile, address, state, city, permission)
VALUES ('jimsmith', 'password3', 'Jim Smith', '09/10/1985', 1, 'jimsmith@example.com', '1112223333', '321 Pine St', 'TX', 'Austin', 0);