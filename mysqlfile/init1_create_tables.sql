use zyrsksw;
drop table admin;
drop table personal;
drop table exams;
drop table computer_test;
drop table recruit_test;

create table admin (
	login_name char(20) not null primary key,
	passwd char(40) not null,
	nickname char(20)
);

create table personal (
	id char(18) not null primary key,
	name char(10) not null,
	gender enum('男','女'),
	people char(10),
	politics enum( '01中共党员', '02中共预备党员', '03共青团员', '04民革党员', '05民盟盟员', '06民建会员', '07民进会员', '08农工党党员', '09致公党党员', '10九三学社社员', '11台盟盟员', '12无党派人士', '13群众' ), 
	marriage enum( '未婚', '已婚', '离异', '丧偶' ),
	cellphone char(11),
	email  varchar(254),
	
	enroll_date timestamp,
	done tinyint default 0,
	checkflag tinyint default 0,
	failstr varchar(100)
) character set utf8;

create table exams (
	exam_id char(2) not null,
	exam_name char(30) not null,
	level_position char(20) not null,
	level_code char(4) not null,
	money float(8,2),

	primary key( exam_id, level_code )
) character set utf8;

create table computer_test (
	id char(18) not null,
	shenbao_educ enum( '初中', '高中', '中专', '大专', '本科', '硕士', '博士' ) not null,
	shenbao_grad_date char(6),
	shenbao_major char(20) not null,
	shenbao_for_major char(20) not null,
	company char(20),
	position char(20),
	company_date char(6),
	level_code char(4) not null,
	
	enroll_date timestamp,
	done tinyint default 0,
	checkflag tinyint default 0,
	failstr varchar(100),
	money tinyint default 0,

	windowsxp tinyint default 0,
	excel2003 tinyint default 0,
	word2003 tinyint default 0,
	internet tinyint default 0,

	primary key( id, level_code)
) character set utf8;

create table recruit_test (
	id char(18) not null primary key,
	level_code char(4) not null,

	first_educ enum( '初中', '高中', '中专', '大专', '本科', '硕士', '博士' ),
	first_school char(20),
	first_grad_date char(6),
	first_major char(20) ,
	
	best_educ enum( '初中', '高中', '中专', '大专', '本科', '硕士', '博士' ),
	best_school char(20),
	best_grad_date char(6),
	best_major char(20),

	certificate varchar(100),
	mandarin varchar(20),
	english varchar(20),
	computer varchar(20),
	resume varchar(300),

	height char(3),
	weight char(2),
	hobby varchar(20),
	addr varchar(20),
	postcode char(6),

	family1_name varchar(6),
	family1_relation varchar(5),
	family1_age tinyint unsigned,
	family1_company varchar(20),
	family1_position varchar(20),

	family2_name varchar(6),
	family2_relation varchar(5),
	family2_age tinyint unsigned,
	family2_company varchar(20),
	family2_position varchar(20),

	family3_name varchar(6),
	family3_relation varchar(5),
	family3_age tinyint unsigned,
	family3_company varchar(20),
	family3_position varchar(20),

	enroll_date timestamp,
	done tinyint default 0,
	checkflag tinyint default 0,
	failstr varchar(100),
	money tinyint default 0
) character set utf8;
