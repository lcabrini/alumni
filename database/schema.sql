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

delimiter $$
create trigger before_delete_user before delete on users
for each row begin
    if old.user_id = 1 then    
        signal sqlstate '54100' 
        set message_text = "You cannot delete the admin user",
        mysql_errno = 2030;
    end if;
end
$$
delimiter ;

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
    primary key(content_id),
    unique(content_key)
) engine=InnoDB default charset=utf8;

insert into content(content_key, title, subtitle, body) values(
    'about_us',
    'About Us',
    '',
    '<p>Todo: write content here.</p>'
);

insert into content(content_key, title, subtitle, body) values(
    'intro_message',
    'Welcome!',
    '',
    '<p>TODO: write content here.</p>'
);

create table if not exists news_sections(
    id int(11) auto_increment,
    name varchar(100) not null,
    primary key(id),
    unique(name)
) engine=InnoDB default charset=utf8;

create table if not exists projects(
    project_id int(11) auto_increment,
    project_name varchar(200) not null,
    description text not null,
    status enum('proposed', 'pending', 'active', 'done') 
        default 'proposed',
    primary key(project_id)
) engine=InnoDB default charset=utf8;
