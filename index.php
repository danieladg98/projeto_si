<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Vinyl Records, lda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script language="JavaScript" src="searchScript.js"></script>

</head>
<body>

<?php
session_start();
?>

<?php
include_once 'parts/navbar.php';
?>

<div>
    <br>
    <br>
    <br>
</div>


<div class="container">

    <h2>Página Principal</h2>




</body>
</html>

<?php

/*

CREATE TABLE clients(
	id		 bigint AUTO_INCREMENT,
	name	 varchar(128) NOT NULL,
	email	 varchar(64) UNIQUE NOT NULL DEFAULT '0',
	password	 varchar(255) NOT NULL,
	hash	 varchar(32) NOT NULL,
	balance	 float(32) NOT NULL,
	active	 boolean NOT NULL DEFAULT '0',
	messages_id bigint,

	PRIMARY KEY(id)
);

CREATE TABLE albums(
	id		 bigint,
	name	 varchar(128),
	description	 varchar(1024),
	release_date date,
	genre	 varchar(128),
	artist	 varchar(128),
	price	 float(32),
	image	 longblob,
	stock	 bigint,
	active	 boolean DEFAULT '0',

	PRIMARY KEY(id)
);

CREATE TABLE musics(
	name	 varchar(128),
	albums_id bigint,

	PRIMARY KEY(name,albums_id)
);

CREATE TABLE basket(
	id		 bigint,
	basket_date date NOT NULL,
	total	 float(32) NOT NULL DEFAULT '0',
	clients_id	 bigint NOT NULL,

	PRIMARY KEY(id)
);

CREATE TABLE inventory(
	id	 bigint AUTO_INCREMENT,
	basket_id bigint NOT NULL,
	albums_id bigint NOT NULL,

	PRIMARY KEY(id)
);

CREATE TABLE admins(
	id	 bigint,
	name	 varchar(128) NOT NULL,
	email	 varchar(64) UNIQUE NOT NULL,
	password varchar(32) NOT NULL,

	PRIMARY KEY(id)
);

CREATE TABLE messages(
	id		 bigint AUTO_INCREMENT,
	message_date date NOT NULL,
	content	 varchar(1024) NOT NULL,
	clients_id	 bigint,
	admins_id	 bigint NOT NULL,

	PRIMARY KEY(id)
);

CREATE TABLE historic(
	historic_date date,
	historic_time timestamp NOT NULL,
	price	 float(32) NOT NULL,
	albums_id	 bigint,
	admins_id	 bigint NOT NULL,

	PRIMARY KEY(historic_date,albums_id)
);

ALTER TABLE clients ADD CONSTRAINT clients_fk1 FOREIGN KEY (messages_id) REFERENCES messages(id);
ALTER TABLE musics ADD CONSTRAINT musics_fk1 FOREIGN KEY (albums_id) REFERENCES albums(id);
ALTER TABLE basket ADD CONSTRAINT basket_fk1 FOREIGN KEY (clients_id) REFERENCES clients(id);
ALTER TABLE inventory ADD CONSTRAINT inventory_fk1 FOREIGN KEY (basket_id) REFERENCES basket(id);
ALTER TABLE inventory ADD CONSTRAINT inventory_fk2 FOREIGN KEY (albums_id) REFERENCES albums(id);
ALTER TABLE messages ADD CONSTRAINT messages_fk1 FOREIGN KEY (clients_id) REFERENCES clients(id);
ALTER TABLE messages ADD CONSTRAINT messages_fk2 FOREIGN KEY (admins_id) REFERENCES admins(id);
ALTER TABLE historic ADD CONSTRAINT historic_fk1 FOREIGN KEY (albums_id) REFERENCES albums(id);
ALTER TABLE historic ADD CONSTRAINT historic_fk2 FOREIGN KEY (admins_id) REFERENCES admins(id);



 */


?>
