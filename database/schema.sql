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
    expires datetime not null,
    primary key(confirmation_id),
    unique(code)
) engine=InnoDB default charset=utf8;

create trigger confirmation_code_create before insert on confirmation_codes
for each row set
    new.expires = timestampadd(day, 1, now());

create table if not exists content(
    content_id int(11) auto_increment,
    content_key varchar(20) not null,
    title varchar(255) not null,
    subtitle varchar(255) not null default '',
    body text not null,
    primary key(content_id)
) engine=InnoDB default charset=utf8;

insert into content(content_key, title, subtitle, body) values(
    'about_us',
    'About Us',
    '',
    '<p>Todo: write content here.</p>'
);
