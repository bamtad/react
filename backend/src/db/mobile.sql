--@block
CREATE TYPE rate_num AS ENUM('1', '2', '3', '4', '5');
CREATE TABLE "city" (
    "id" SERIAL PRIMARY KEY,
    "name" VARCHAR(255) NOT NULL,
    "description" TEXT
);
CREATE TABLE "location" (
    "id" SERIAL PRIMARY KEY,
    "lat" REAL NOT NULL,
    "long" REAL NOT NULL,
    "city" INT
);
CREATE TABLE "image" (
    "id" SERIAL PRIMARY KEY,
    "url" VARCHAR(255) NOT NULL,
    "spot" int,
    "city" int,
    "placeholder" VARCHAR(255) NOT NULL
);
CREATE TABLE "spot" (
    "id" SERIAL PRIMARY KEY,
    "name" VARCHAR(255) NOT NULL,
    "description" TEXT,
    "location" INT NOT NULL,
    "city" int not null
);
CREATE TABLE "spot_type_spot" (
    "id" SERIAL PRIMARY KEY,
    "spot" int not null,
    "type" int not null
);
CREATE TABLE "spot_type" (
    "id" SERIAL PRIMARY KEY,
    "name" VARCHAR(255) NOT NULL UNIQUE
);
CREATE TABLE "comment" (
    "id" SERIAL PRIMARY KEY,
    "spot" int not null,
    "body" TEXT NOT NULL
);
CREATE TABLE "rate" (
    "id" SERIAL PRIMARY KEY,
    "rate_num" rate_num not null,
    "spot" int not null
);
ALTER TABLE "location"
ADD CONSTRAINT "fk_city_location" FOREIGN KEY ("city") REFERENCES "city" ("id");
ALTER TABLE "image"
ADD CONSTRAINT "fk_city_image" FOREIGN KEY ("city") REFERENCES "city" ("id"),
    ADD CONSTRAINT "fk_city_spot" FOREIGN KEY ("spot") REFERENCES "spot" ("id");
ALTER TABLE "spot"
ADD CONSTRAINT "fk_city_spot" FOREIGN KEY ("city") REFERENCES "city" ("id"),
    ADD CONSTRAINT "fk_location_spot" FOREIGN KEY ("location") REFERENCES "location" ("id");
ALTER TABLE "spot_type_spot"
ADD CONSTRAINT "fk_spot_type_spot" FOREIGN KEY ("spot") REFERENCES "spot" ("id");
ALTER TABLE "comment"
ADD CONSTRAINT "fk_spot_comment" FOREIGN KEY ("spot") REFERENCES "spot" ("id");
ALTER TABLE "rate"
ADD CONSTRAINT "fk_spot_comment" FOREIGN KEY ("spot") REFERENCES "spot" ("id");
--@block
INSERT INTO "location" ("lat", "long", "city")
Values()
INSERT INTO "spot"("name", "");
--@block
EXPLAIN
SELECT *
from "user";
--@block  drop everything
EXPLAIN
INSERT into "user"("fname")
Values('hello')