connect alumni

create table if not exists `users` (
    `user_id` int(11) auto_increment,
    `email` varchar(100) not null,
    `password` varchar(255) not null,
    `year_graduated` smallint not null,
    primary key(user_id),
    unique(email)
) engine=InnoDB default charset=utf8;

insert into `users`(email, password, year_graduated) values('admin@example.com', password('s3kr3t'), 2000);



