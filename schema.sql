CREATE
DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE category
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    name_category   CHAR NOT NULL,
    s_code CHAR NOT NULL
);

CREATE TABLE lot
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    add_time    DATETIME NOT NULL,
    name_lot        CHAR     NOT NULL UNIQUE,
    description TEXT     NOT NULL,
    img         CHAR     NOT NULL UNIQUE,
    start_price INT      NOT NULL,
    data_finish DATETIME NOT NULL,
    step_rate   INT      NOT NULL,

    author_id   INT      NOT NULL,
    winner_id   INT      NOT NULL,
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
    email    CHAR     NOT NULL UNIQUE,
    name_user     CHAR     NOT NULL,
    password CHAR     NOT NULL,
    contacts CHAR     NOT NULL,

    lot_id   INT      NOT NULL,
    rate_us  INT      NOT NULL
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

