SELECT * FROM emoney_staging2.users where password_blocked_until is not null and subclass ='A';
create database antarfuelretail;
use antarfuelretail;

CREATE TABLE `blocked` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `no_ecash` varchar(13) NOT NULL,
  `cif` varchar(32) DEFAULT NULL,
  `reason_id` int(4) NOT NULL,
  `desc` text,
  `status` varchar(32) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `total_balance` decimal(15,6),
  `broker_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
	KEY `CUSTOMFIELDPOSSIBLE_ID_FK` (`reason_id`),
   CONSTRAINT `CUSTOMFIELDPOSSIBLE_ID_FK` FOREIGN KEY (`reason_id`) REFERENCES `custom_field_possible_values` (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=latin1;


create table subclass(
	id int not null auto_increment,
	tipe varchar(2) not null,
	primary key(id)
);

create table mutation_types(
	id int not null auto_increment,
	nama varchar(2) not null,
	primary key(id)
);

create table currencies(
	id int not null auto_increment,
	nama varchar(50) not null,
	primary key(id)
);


create table users_table(
	nip varchar(50),
	nama varchar(150) not null,
	alamat varchar(200) not null,
	pass varchar(200) not null,
	subclass int not null,
	last_login datetime,
	is_logged varchar(2),
	primary key(nip),
	key subclassid_fk (subclass),
	constraint subclassid_fk foreign key (subclass) references subclass(id)
);

create table fuel_kind(
	id int not null auto_increment, 
	nama varchar(50) not null,
	quality int,
	added_by varchar(50) not null,
	primary key(id),
	key addedby_fk (added_by),
	constraint addedby_fk foreign key (added_by) references users_table(nip)
);

create table stocks(
	id int not null auto_increment,
	currencies_id int, 
	stock int,
	primary key(id),
	key currenciedid_fk (currencies_id),
	constraint currenciedid_fk foreign key (currencies_id) references currencies(id)
);

create table stocks_mutation(
	id int not null auto_increment,
	mutation_date datetime,
	kind_id int, 
	nip varchar(50),
	amount int,
	mutation_types int,
	stocks_id int,
	primary key(id),
	key kindid_fk (kind_id),
	key nip_fk (nip),
	key stocksid_fk (stocks_id),
	constraint kindid_fk foreign key (kind_id) references fuel_kind(id),
	constraint nip_fk foreign key (nip) references users_table(nip),
	constraint stocksid_fk foreign key (stocks_id) references stocks(id)
);


-- initial data for app
insert into subclass (tipe)
values ('M');
insert into subclass (tipe)
values ('A');
select * from subclass;

insert into mutation_types (nama)
values('A');

insert into users_table values(
	'OP0001', 'Antar', 'Jakarta', md5('123456'), 2, now(), '0'
);

select * from users_table;