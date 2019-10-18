connect alumni

create table if not exists users (
    user_id int(11) auto_increment,
    email varchar(100) not null,
    password varchar(255) not null,
    full_name varchar(255) not null default '',
    year_graduated smallint not null,
    status enum('new', 'active', 'deleted') default 'new',
    registration_date datetime default current_timestamp,
    primary key(user_id),
    unique(email)
) engine=InnoDB default charset=utf8;

insert into users(email, password, year_graduated) values('admin@example.com', password('s3kr3t'), 2000);

create table if not exists confirmation_codes (
    confirmation_id int(11) auto_increment,
    user_fk int(11) not null references users,
    code varchar(50) not null,
    primary key(confirmation_id),
    unique(code)
) engine=InnoDB default charset=utf8;
