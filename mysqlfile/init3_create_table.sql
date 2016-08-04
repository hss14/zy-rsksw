use zyrsksw;

create table level_test (
	id char(18) not null,

	level_code char(4) not null,
	
	enroll_date timestamp,
	done tinyint default 0,
	checkflag tinyint default 0,
	failstr varchar(100),
	money tinyint default 0,

	score tinyint default 0,

	primary key( id, level_code)
) character set utf8;
