-- Schema for the database.
DROP TABLE IF EXISTS mark;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS hotel;

CREATE TABLE IF NOT EXISTS hotel (
  id_hotel INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS comment (
  id_comment INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_hotel INT NOT NULL,
  comment VARCHAR(255) NOT NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'active' CHECK (status IN ('active', 'inactive', 'banned')),
  date_added DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_hotel) REFERENCES hotel(id_hotel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS mark (
  id_mark INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id_comment INT NOT NULL,
  number INT NOT NULL,
  sum INT NOT NULL,
  average_mark INT NOT NULL,
  FOREIGN KEY (id_comment) REFERENCES comment(id_comment)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert some data.
DELETE FROM hotel;
INSERT INTO hotel (name, address) VALUES ('Aegean', 'Greece');
INSERT INTO hotel (name, address) VALUES ('Villa', 'Italy');
INSERT INTO hotel (name, address) VALUES ('Hilton', 'USA');
