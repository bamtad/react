--@block
CREATE TYPE rate_num AS ENUM ('1', '2', '3', '4', '5');

CREATE TABLE
    "city" (
        "id" SERIAL PRIMARY KEY,
        "name" VARCHAR(255) NOT NULL,
        "description" TEXT
    );

CREATE TABLE
    "location" (
        "id" SERIAL PRIMARY KEY,
        "lat" REAL NOT NULL,
        "long" REAL NOT NULL,
        "city" INT
    );

CREATE TABLE
    "image" (
        "id" SERIAL PRIMARY KEY,
        "url" VARCHAR(255) NOT NULL,
        "spot" int,
        "city" int,
        "placeholder" VARCHAR(255)
    );

CREATE TABLE
    "spot" (
        "id" SERIAL PRIMARY KEY,
        "name" VARCHAR(255) NOT NULL,
        "description" TEXT,
        "location" INT NOT NULL,
        "city" int not null
    );

CREATE TABLE
    "spot_type_spot" (
        "id" SERIAL PRIMARY KEY,
        "spot" int not null,
        "type" int not null
    );

CREATE TABLE
    "spot_type" (
        "id" SERIAL PRIMARY KEY,
        "name" VARCHAR(255) NOT NULL UNIQUE
    );

CREATE TABLE
    "comment" (
        "id" SERIAL PRIMARY KEY,
        "spot" int not null,
        "body" TEXT NOT NULL,
        "user" INT NOT NULL
    );

CREATE TABLE
    "rate" (
        "id" SERIAL PRIMARY KEY,
        "rate_num" rate_num not null,
        "spot" int not null,
        "user" INT NOT NULL,
    );

CREATE TABLE
    "user_rate" ("visiter" int not null, "rate" int not null);

CREATE TABLE
    "user_comment" ("visiter" int not null, "comment" int not null);


ALTER TABLE "location" ADD CONSTRAINT "fk_city_location" FOREIGN KEY ("city") REFERENCES "city" ("id");

ALTER TABLE "image" ADD CONSTRAINT "fk_city_image" FOREIGN KEY ("city") REFERENCES "city" ("id"),
ADD CONSTRAINT "fk_city_spot" FOREIGN KEY ("spot") REFERENCES "spot" ("id");

ALTER TABLE "spot" ADD CONSTRAINT "fk_city_spot" FOREIGN KEY ("city") REFERENCES "city" ("id"),
ADD CONSTRAINT "fk_location_spot" FOREIGN KEY ("location") REFERENCES "location" ("id");

ALTER TABLE "spot_type_spot" ADD CONSTRAINT "fk_spot_type_spot" FOREIGN KEY ("spot") REFERENCES "spot" ("id");

ALTER TABLE "comment" ADD CONSTRAINT "fk_spot_comment" FOREIGN KEY ("spot") REFERENCES "spot" ("id");

ALTER TABLE "rate" ADD CONSTRAINT "fk_spot_comment" FOREIGN KEY ("spot") REFERENCES "spot" ("id");

ALTER TABLE "user_rate" ADD CONSTRAINT "fk_visiter_rate" FOREIGN KEY ("visiter") REFERENCES "user" ("id"),
ADD CONSTRAINT "fk_rate_rate" FOREIGN KEY ("rate") REFERENCES "rate" ("id");

ALTER TABLE "user_comment" ADD CONSTRAINT "fk_user_comment_visiter" FOREIGN KEY ("visiter") REFERENCES "user" ("id"),
ADD CONSTRAINT "fk_comment_visiter" FOREIGN KEY ("comment") REFERENCES "comment" ("id");


--@block
SELECT
    *
FROM
    "location";

--@block
SELECT
    "spot"."id",
    "spot"."name",
    "spot"."description",
    "city"."id" as "city_id",
    "city"."name" as "city_name",
    "location"."lat" as "lat",
    "location"."long" as "long"
from
    "spot"
    LEFT JOIN "city" on "spot"."city" = "city"."id"
    INNER JOIN "location" on "location"."id" = "spot"."location";

--@block  drop everything
SELECT
    "comment"."id",
    "comment"."body",
    "user"."id" as "user_id",
    "user"."fname" as "username",
    "file"."url" as "profile",
    "comment"."spot"
from
    "comment"
    JOIN "user" on "user"."id" = "comment"."user"
    LEFT JOIN "file" on "user"."profile_pic" = "file"."id";

--@block
SELECT
    *
From
    "file";

--@block
SELECT
    *
FROM
    "spot";
