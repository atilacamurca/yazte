--
-- Yazte - Yet Another Zend Template Engine
--

create table projects(
	id serial primary key,
	name varchar(20) not null,
	description text not null,
	logo text, -- path to a picture
	created_at timestamp default current_timestamp,
	updated_at timestamp,
   hide integer not null default 0,
   "order" integer not null default 1
);
