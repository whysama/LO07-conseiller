<?php
	//--------------------------------------------
	//  SQL
	//  创建table, 设置主键，外键
	$sql_create_USER = "CREATE TABLE USER(
		email varchar(50),
		pwd varchar(7),
		niveau varchar(5),
		PRIMARY KEY (email)
		)";

	$sql_create_EC = "CREATE TABLE EC (
		id_EC int AUTO_INCREMENT,
		nom varchar(15),
		prenom varchar(15),
		email varchar(30),
		bureau varchar(10),
		pole varchar(10),
		PRIMARY KEY (id_EC)
		)";

	$sql_create_ETU = "CREATE TABLE ETU(
		nom varchar(30),
		prenom varchar(30),
		email varchar(50),
		programme varchar(5),
		semestre int,
		id_ETU int AUTO_INCREMENT,
		PRIMARY KEY (id_ETU)
		)";

	$sql_create_CONSEILLER = "CREATE TABLE CONSEILLER(
		id_EC int not NULL,
		programme varchar(7),
		PRIMARY KEY (id_EC,programme),
		CONSTRAINT fk_id_EC_c FOREIGN KEY (id_EC) REFERENCES EC(id_EC)
		)";

	$sql_create_LIEN = "CREATE TABLE LIEN(
		id_EC int NOT NULL,
		id_ETU int NOT NULL UNIQUE,
		PRIMARY KEY (id_EC,id_ETU),
		CONSTRAINT fk_id_EC_l FOREIGN KEY (id_EC) REFERENCES CONSEILLER(id_EC),
		CONSTRAINT fk_id_ETU_l FOREIGN KEY (id_ETU) REFERENCES ETU(id_ETU)
		)";
	//--------------------------------------------