--@block
CREATE TYPE user_type as Enum('admin', 'orgs', 'normal');
CREATE TYPE doc_type as Enum('certificate', 'edu_document', 'ack');
-- Address table
CREATE TABLE "address" (
    id SERIAL PRIMARY KEY,
    "country" varchar(255),
    "city" varchar(255),
    "zip" int,
    "street" varchar(255)
);
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    "fname" varchar(255) not null,
    "lname" varchar(255),
    "email" varchar(512) not null UNIQUE,
    "phone" varchar(64),
    "is_verified" BOOLEAN DEFAULT FALSE,
    "password" varchar(20) not null,
    "user_type" user_type DEFAULT 'normal',
    "address" int,
    "profile_pic" int,
    "bg_pic" int,
    "created_at" timestamp not null,
    "updated_at" timestamp not null,
    "last_login" timestamp
);
CREATE TABLE "document" (
    id SERIAL PRIMARY KEY,
    "name" varchar(255) not null,
    "description" text,
    "owner" int,
    "issued_by" int not null,
    "is_revoked" BOOLEAN DEFAULT FALSE,
    "is_expired" BOOLEAN DEFAULT FALSE,
    "doc_type" doc_type,
    "url" int not NULL,
    "created_at" timestamp not null,
    "issued_at" timestamp,
    "updated_at" timestamp not null
);
CREATE TABLE "notification" (
    id SERIAL PRIMARY KEY,
    "from" int not null,
    "to" int not null,
    "body" varchar(512) not null
);
CREATE TABLE "link" (
    id SERIAL PRIMARY KEY,
    "owner" int not null,
    "qr_code" int,
    "url" varchar(512) NOT NULL,
    "is_open" BOOLEAN DEFAULT TRUE
);
CREATE TABLE "file" (
    id SERIAL PRIMARY KEY,
    "url" VARCHAR(512) NOT NULL,
    "document" int null
);
-- Many2Many Relationships
CREATE TABLE "doc_link" (
    id SERIAL PRIMARY KEY,
    "link" integer not null,
    "document" integer not null
);
CREATE TABLE "link_permission" (
    id SERIAL PRIMARY KEY,
    "user" int not null,
    "link" int not null
);
-- Constraints
ALTER TABLE "link_permission"
ADD CONSTRAINT fk_link_link_permission FOREIGN KEY ("link") REFERENCES "link" (id) on Delete CASCADE,
    ADD CONSTRAINT fk_user_link_permission FOREIGN KEY ("user") REFERENCES "user" (id) on Delete CASCADE;
ALTER TABLE "doc_link"
ADD CONSTRAINT fk_doc_doc_link FOREIGN KEY ("document") REFERENCES "document" (id),
    ADD CONSTRAINT fk_link_doc_link FOREIGN KEY ("link") REFERENCES "link" (id);
ALTER TABLE "link"
ADD CONSTRAINT fk_link_owner FOREIGN KEY ("owner") REFERENCES "user" (id),
    ADD CONSTRAINT fk_qr_code_link FOREIGN KEY ("qr_code") REFERENCES "file" (id);
ALTER TABLE "document"
ADD CONSTRAINT fk_issued_by_document FOREIGN KEY ("issued_by") REFERENCES "user" (id),
    ADD CONSTRAINT fk_url_document FOREIGN KEY ("url") REFERENCES "file" (id),
    ADD CONSTRAINT fk_owner_document FOREIGN KEY ("owner") REFERENCES "user" (id);
ALTER TABLE "notification"
ADD CONSTRAINT fk_to_notification FOREIGN KEY ("to") REFERENCES "user" (id),
    ADD CONSTRAINT fk_from_notification FOREIGN KEY ("from") REFERENCES "user" (id);
ALTER TABLE "user"
ADD CONSTRAINT fk_address_user FOREIGN KEY ("address") REFERENCES "address" (id),
    ADD CONSTRAINT fk_pp_user FOREIGN KEY ("profile_pic") References "file" (id),
    ADD CONSTRAINT fk_bg_user FOREIGN KEY ("bg_pic") References "file" (id);
ALTER TABLE "file"
ADD CONSTRAINT fk_images_document FOREIGN KEY ("document") REFERENCES "document" (id);
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
