--
-- Yazte - Yet Another Zend Template Engine
--

create table adapters(
   id integer primary key,
   description varchar(20) not null,
   name varchar(20) not null unique,
   "order" integer not null
);

insert into adapters values (1, 'PostgreSQL', 'PDO_PGSQL', 1), (2, 'MySQL', 'PDO_MYSQL', 2);

create table projects(
	id serial primary key,
	name varchar(20) not null,
	description text not null,
	logo text, -- path to a picture
	created_at timestamp default current_timestamp,
    updated_at timestamp,
    hide integer not null default 0,
    "order" integer not null default 1,
    adapter_id integer not null references adapters(id),
    db_host varchar(100) not null,
    db_username varchar(20) not null,
    db_password varchar(20) not null,
    db_name varchar(20) not null,
    template character varying(64) DEFAULT 'Default'::character varying not null
);
