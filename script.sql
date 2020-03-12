create table character_class
(
    id   int auto_increment,
    name varchar(255) not null,
    constraint class_id_uindex
        unique (id)
);

alter table character_class
    add primary key (id);

create table enemy
(
    id   int auto_increment,
    name varchar(255) not null,
    constraint enemy_id_uindex
        unique (id)
);

alter table enemy
    add primary key (id);

create table feat
(
    id   int auto_increment,
    name varchar(255) not null,
    constraint feat_id_uindex
        unique (id)
);

alter table feat
    add primary key (id);

create table item
(
    id   int auto_increment,
    name varchar(255) not null,
    constraint item_id_uindex
        unique (id)
);

alter table item
    add primary key (id);

create table race
(
    id          int auto_increment,
    name        varchar(255) not null,
    description text         null,
    constraint race_id_uindex
        unique (id)
);

alter table race
    add primary key (id);

create table spell
(
    id          int auto_increment,
    name        varchar(255)  not null,
    description text          null,
    level       int default 0 not null,
    constraint spell_id_uindex
        unique (id)
);

alter table spell
    add primary key (id);

create table user
(
    id          int auto_increment,
    username    varchar(20)                            not null,
    password    varchar(255)                           not null,
    firstname   varchar(255)                           null,
    lastname    varchar(255)                           null,
    accessToken varchar(255) default '3'               null,
    authKey     varchar(255) default 'f'               null,
    updated_at  datetime     default CURRENT_TIMESTAMP not null,
    created_at  datetime     default CURRENT_TIMESTAMP not null,
    constraint user_id_uindex
        unique (id),
    constraint user_username_uindex
        unique (username)
);

alter table user
    add primary key (id);

create table campaign
(
    id          int auto_increment,
    name        varchar(255)                       not null,
    description text                               null,
    created_at  datetime default CURRENT_TIMESTAMP not null,
    updated_at  datetime default CURRENT_TIMESTAMP not null,
    dm_id       int                                null,
    constraint campaigns_id_uindex
        unique (id),
    constraint campaign_user_id_fk
        foreign key (dm_id) references user (id)
            on delete set null
);

alter table campaign
    add primary key (id);

create table `character`
(
    id          int auto_increment,
    name        varchar(255) not null,
    class_id    int          not null,
    race_id     int          not null,
    background  text         null,
    player_id   int          not null,
    campaign_id int          null,
    constraint character_id_uindex
        unique (id),
    constraint campaign_pc_fk
        foreign key (campaign_id) references campaign (id)
            on delete cascade,
    constraint character_class_fk
        foreign key (class_id) references character_class (id)
            on delete cascade,
    constraint character_race_fk
        foreign key (race_id) references race (id)
            on delete cascade,
    constraint player
        foreign key (player_id) references user (id)
            on delete cascade
);

alter table `character`
    add primary key (id);

create table event
(
    id          int auto_increment,
    title       varchar(255) not null,
    description text         null,
    campaign_id int          null,
    constraint event_id_uindex
        unique (id),
    constraint campaign_even_fk
        foreign key (campaign_id) references campaign (id)
            on delete cascade
);

alter table event
    add primary key (id);

create table encounter
(
    id          int auto_increment,
    title       varchar(255) not null,
    description text         null,
    event_id    int          null,
    campaign_id int          not null,
    constraint encounter_id_uindex
        unique (id),
    constraint encounter_campaign_fk
        foreign key (campaign_id) references campaign (id)
            on delete cascade,
    constraint encounter_event_fk
        foreign key (event_id) references event (id)
            on delete cascade
);

alter table encounter
    add primary key (id);

create table npc
(
    id          int auto_increment,
    name        varchar(255) not null,
    campaign_id int          not null,
    race_id     int          not null,
    class_id    int          null,
    constraint npc_id_uindex
        unique (id),
    constraint npc_campaign_fk
        foreign key (campaign_id) references campaign (id)
            on delete cascade,
    constraint npc_class_fk
        foreign key (class_id) references character_class (id)
            on delete cascade,
    constraint npc_race_fk
        foreign key (race_id) references race (id)
            on delete cascade
);

alter table npc
    add primary key (id);


