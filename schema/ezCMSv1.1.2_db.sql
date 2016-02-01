/** 
Creating Database for powercmsdb1.2.0
*/
create database if not exists powercmsdb112 charset = utf8;
use powercmsdb112;

/*drop database powercmsdb112;*/

SET default_storage_engine = INNODB;

create table if not exists Sites(
Sitename varchar(50),primary key(Sitename),
Sitetemplate varchar(50),
Siteurl varchar(255),
Sitestatus enum('active','inactive')
)engine = innodb;

/*
create table if not exists Template(Id int unsigned auto_increment primary key,
Templatename varchar(50) not null, Status enum('active','inactive'),
Baseurl tinytext, foreign key(Sitename) references Sites(Sitename)
)engine = innodb;
*/
create table if not exists Sitemenu(
Id int(11) unsigned not null auto_increment ,
Nav_name varchar(20) not null,
Nav_type varchar(20),
Nav_level int(5),
Position int(10) not null,
Visible   enum('Y','N'),
Featured  enum('Y','N') default 'N',
Primary key (Id)
);

create table if not exists Submenu(
Id int(11) unsigned not null auto_increment, primary key(Id),
Nav_id int(11),
Sub_navname varchar(20) not null,
Sub_navtype varchar(20),
Sub_navlevel int(5)
) engine =innodb;

/* setting site
insert into sites(Site_name,Site_template,Site_url,Site_status)
values("PowerCMSv1.2.0","blue_ice","localhost/PowerCMSv1.1.2","active");
*/
create table if not exists Users(
Id int unsigned auto_increment ,
Firstname varchar(50) not null, 
Lastname varchar(40) not null,
Gender varchar(6),
Username varchar(45) not null,
Password varchar(40) not null ,
Email varchar(50) default 'admin@example.com',
Authlevel int(2),index(Authlevel),
Status enum('active','inactive','banned') default "active",
Lastupdated timestamp default current_timestamp on update current_timestamp,
constraint pk_userid primary key(Id), 
constraint unique_username unique key(Username)
)engine =innodb;

/*insert admin information*/
insert into users set Firstname='A-Rahman', Lastname='Sarpong',
 Gender ='Male',Username="Admin",Password = md5('admin'), 
 Email='example@gmail.com', Authlevel=1 
 on duplicate key update Firstname='A-Rahman';

create table if not exists Guest_users(
Ip varchar(50) primary key, unique index(ip),
Guest_time varchar(10)
);

create table if not exists Active_users(
Username varchar(45) primary key, unique index(Username),
Time_loggedin varchar(50)
)engine =innodb;

create table if not exists Banned_users(
Username varchar(45) primary key, unique index(Username),
Date varchar(50)
)engine=innodb;

/*

*/
create table if not exists Pages(
Id int unsigned auto_increment primary key,
Title varchar(255),
Content text,
Source tinytext,
Postedby int(3),
Dateposted timestamp not null default current_timestamp on update current_timestamp,
Position int(30),
Published enum('Y','N') default 'N',
Featured  enum('Y','N') default 'N',
Views int(30)
) engine = innodb;

create table if not exists Pagecategory(
Id int unsigned auto_increment,
Category varchar(50),
Position int(30),
Visible enum('Y','N'),
primary key(Id)
)engine = innodb;

create table if not exists Subpagecat(
Id int unsigned auto_increment,
CateId int,
Subcategory varchar(50),
primary key(Id)
)engine = innodb;

create table if not exists Maillinglist(
Id int unsigned not null auto_increment primary key ,
EmailAddress varchar(255)
);
/* Gallery 
create table if not exists Gallery(
Id int auto_increment, 
primary key(Id),
Galleryname varchar(250),
Contentid int,
Position int,
Createdby int /* userid,
Date timestamp default current_timestamp on update current_timestamp
) engine=InnoDB;

create table if not exists Album( 
Id int auto_increment, primary key(Id),
Albumname varchar(50),
Createdby int,
Date timestamp default current_timestamp on update current_timestamp,
Galleryid int,
foreign key(Galleryid) references Gallery(Id) on update cascade on delete cascade
)ENGINE=InnoDB;

create table if not exists Images(
Id int auto_increment,primary key(Id),
Name varchar(50),
Width int(5),
Height int(5),
Discription tinytext,
Mimetype varchar(50),
Extention varchar(10),
Albumid int,
foreign key(Albumid) references Album(Id) on update cascade on delete cascade
) engine=Innodb;
*/
create table if not exists Pageimgs(
Id int auto_increment,primary key(Id),
Imgname varchar(50),
Width int(5),
Height int(5),
Imgcaption tinytext,
Mimetype varchar(50),
Extention varchar(10),
Pageid int
) engine=Innodb;


create table if not exists Districts(
Id int(10) unsigned auto_increment,
District varchar(30) not null,
Primary key(Id),
Regionid int(10)
) engine = Innodb;

create table if not exists Regions(
    Id int(10) unsigned,
	Region  varchar(30) not null,
	Capital varchar(30) not null,
    Primary key(Id)
) engine = Innodb;

insert into regions values(1,"Upper East","Bolegatanga"),
(2,"Upper West","Wa"),(3,"Northern","Tamale"),
(4,"Brong Ahafo","Sunyani"),(5,"Ashanti","Kumasi"),
(6,"Eastern","Koforidua"),(7,"Western","Takoradi"),
(8,"Central","Cape Coast"),(9,"Greater Accra","Accra"),
(10,"Volta","Ho");

create table if not exists Jobs(
Id int unsigned auto_increment,
Company varchar(255),
Title varchar(255),
Empstatus varchar(20),
Category varchar(50), 
Description text,
Education varchar(50),
Experience varchar(50),
Location varchar(50),
Region varchar(50),
Contactaddr tinytext,
Phone varchar(15), 
Email varchar(255),
Website varchar(200),
Deadline Date,
Lastupdated timestamp default current_timestamp on update current_timestamp,
Listedby int, 
Position int(5),
constraint pk_job primary key(Id)
) engine = innodb;

create table if not exists Jobcategory(
Id int unsigned auto_increment,
Category varchar(50),
primary key(Id)
)engine = innodb;

create table if not exists Businessdir(
Id int unsigned auto_increment, 
Company varchar(80) unique key,
Category varchar(50),
Address varchar(60),
Emailaddr varchar(60),
Website varchar(255),
Location varchar(50),
Region varchar(50),
Phone varchar(20),
Fax varchar(20),
Description text,
Lastupdated timestamp default current_timestamp on update current_timestamp,
Position int(5),
constraint pkcomp primary key(Id)
)engine = innodb;

create table if not exists Bizcategory(
Id int unsigned auto_increment,
Category varchar(50),
primary key(Id)
)engine = innodb;

insert into  Bizcategory values
(1,'Agency'),
(2,'Consultancy'),
(3,'Trading Company'),
(4,'Education'),
(5,'Financial Institution'),
(6,'IT Firm'),
(7,'Non-Governmental Organisation (NGO)'),
(8,'Health Care'),
(9,'Transport'),
(10,'Oil and Gas'),
(11,'Mining'),
(12,'Manufacturing'),
(13,'Telecommunication Network'),
(14,'Real Estate Developers');



