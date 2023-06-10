DROP  TABLE "user";
-- DROP TABLE hello;
CREATE TABLE "user" (id SERIAL PRIMARY KEY,fname varchar(255) not null,lname varchar(255),email varchar(512) not null,phone varchar(20),user_type int  default 1,address int ,profile_pic varchar(512),bg_pic varchar(255));

