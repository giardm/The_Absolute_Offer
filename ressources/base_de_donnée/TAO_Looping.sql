CREATE TABLE users(
   user_id INT AUTO_INCREMENT,
   username VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   hash_password VARCHAR(250) NOT NULL,
   role VARCHAR(50) NOT NULL,
   added_at DATETIME,
   PRIMARY KEY(user_id),
   UNIQUE(username),
   UNIQUE(email)
);

CREATE TABLE topics(
   topic_id INT AUTO_INCREMENT,
   title VARCHAR(50) NOT NULL,
   content TEXT NOT NULL,
   created_at VARCHAR(50),
   user_id INT NOT NULL,
   PRIMARY KEY(topic_id),
   FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE comments(
   comment_id INT AUTO_INCREMENT,
   content TEXT NOT NULL,
   created_at DATETIME,
   user_id INT NOT NULL,
   parent_id INT,
   topic_id INT NOT NULL,
   PRIMARY KEY(comment_id),
   FOREIGN KEY(user_id) REFERENCES users(user_id),
   FOREIGN KEY(parent_id) REFERENCES comments(comment_id) ON DELETE CASCADE,
   FOREIGN KEY(topic_id) REFERENCES topics(topic_id) ON DELETE CASCADE
);

CREATE TABLE favorites(
   favorite_id INT AUTO_INCREMENT,
   game_id INT NOT NULL,
   added_at DATETIME,
   user_id INT NOT NULL,
   PRIMARY KEY(favorite_id),
   FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE categories(
   category_id INT AUTO_INCREMENT,
   name VARCHAR(50) NOT NULL,
   description TEXT,
   PRIMARY KEY(category_id),
   UNIQUE(name)
);

CREATE TABLE news(
   news_id INT AUTO_INCREMENT,
   title VARCHAR(50) NOT NULL,
   content TEXT,
   added_at DATETIME,
   user_id INT NOT NULL,
   category_id INT NOT NULL,
   PRIMARY KEY(news_id),
   FOREIGN KEY(user_id) REFERENCES users(user_id),
   FOREIGN KEY(category_id) REFERENCES categories(category_id)
);

CREATE TABLE featured_offers(
   featured_offer_id INT AUTO_INCREMENT,
   game_id INT NOT NULL,
   added_at DATETIME NOT NULL,
   user_id INT NOT NULL,
   PRIMARY KEY(featured_offer_id),
   FOREIGN KEY(user_id) REFERENCES users(user_id)
);
