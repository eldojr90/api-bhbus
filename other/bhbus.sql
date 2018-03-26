CREATE TABLE passageiro(
    p_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    c_id int UNIQUE KEY,
    p_nome varchar(150) NOT NULL,
    p_email varchar(150) NOT NULL UNIQUE KEY,
    p_senha varchar(150) NOT NULL,
    p_token varchar(32) NOT NULL,
    p_createdAt timestamp DEFAULT CURRENT_TIMESTAMP,
    p_updatedAt timestamp,
    p_lastlogin timestamp    
);

create table linha(
l_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
l_cod varchar(10) NOT NULL UNIQUE,
l_org varchar(50) NOT NULL,
l_dest varchar(50) NOT NULL
);

create table debito(
d_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
c_id int references passageiro(c_id),
l_id int references linha(l_id),
d_val double NOT NULL,
d_data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);