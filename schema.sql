CREATE
DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE category
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    name_category   CHAR(64) NOT NULL,
    s_code CHAR(64) NOT NULL
);

CREATE TABLE lot
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    add_time    DATETIME NOT NULL,
    name_lot        CHAR(64)     NOT NULL UNIQUE,
    description TEXT     NOT NULL,
    img         CHAR(64)     NOT NULL UNIQUE,
    start_price INT      NOT NULL,
    data_finish DATETIME NOT NULL,
    step_rate   INT      NOT NULL,

    author_id   INT      NOT NULL,
    winner_id   INT      ,
    category_id INT      NOT NULL
);

CREATE TABLE rate
(

    id       INT AUTO_INCREMENT PRIMARY KEY,
    add_time DATETIME NOT NULL,
    price    INT      NOT NULL,

    user_id  INT      NOT NULL,
    lot_id   INT      NOT NULL
);

CREATE TABLE site_user
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    data_reg DATETIME NOT NULL,
    email    CHAR(64)     NOT NULL UNIQUE,
    name_user     CHAR(64)     NOT NULL,
    password CHAR(64)     NOT NULL,
    contacts CHAR(64)     NOT NULL,

    lot_id   INT      ,
    rate_us  INT
);

CREATE
UNIQUE INDEX name_category ON category(name_category);
CREATE
UNIQUE INDEX name_l ON lot(name_lot);
CREATE
UNIQUE INDEX name_user ON site_user(name_user);
CREATE
INDEX price ON rate(price);
CREATE
INDEX data_finish ON lot(data_finish);

ALTER TABLE lot
    ADD FOREIGN KEY (author_id) REFERENCES site_user (id),
    ADD FOREIGN KEY (winner_id) REFERENCES site_user (id),
    ADD FOREIGN KEY (category_id) REFERENCES category (id);

ALTER TABLE rate
    ADD FOREIGN KEY (user_id) REFERENCES site_user (id),
    ADD FOREIGN KEY (lot_id) REFERENCES lot (id);

ALTER TABLE site_user
    ADD FOREIGN KEY (lot_id) REFERENCES lot (id),
    ADD FOREIGN KEY (rate_us) REFERENCES rate (price);

