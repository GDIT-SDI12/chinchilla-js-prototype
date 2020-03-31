INSERT INTO roles (role) VALUE ('Admin');
INSERT INTO roles (role) VALUE ('User');

INSERT INTO post_types(type) VALUE ('Job');
INSERT INTO post_types(type) VALUE ('Accommodation');

INSERT INTO users (username, password, first_name, last_name, email, phone_number, role)
VALUES ('333', '333', 'Rocket', 'Raccoon', 'rr@marvel.com', '241', 'Admin');

INSERT INTO users (username, password, first_name, last_name, email, phone_number, role)
VALUES ('111', '111', 'Groot', '---', 'iamgroot@marvel.com', '6-8-2015', 'User');

INSERT INTO mailer (host, username, password, port, maskname)
VALUES ('SMPT_PROVIDER', 'MAILER_USERNAME', 'MAILER_PASSWORD', 587, 'Chinchilla Mailer');
