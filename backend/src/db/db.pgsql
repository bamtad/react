CREATE TYPE user_type as Enum('admin', 'orgs', 'normal');

CREATE TYPE doc_type as Enum('certificate', 'edu_document', 'ack');

-- Address table
CREATE TABLE
    "address" (
        id SERIAL PRIMARY KEY,
        "country" varchar(255),
        "city" varchar(255),
        "zip" int,
        "street" varchar(255)
    );

CREATE TABLE
    "user" (
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

CREATE TABLE
    "document" (
        id SERIAL PRIMARY KEY,
        "name" varchar(255) not null,
        "description" text,
        "owner" int not null,
        "issued_by" int not null,
        "is_revoked" BOOLEAN DEFAULT FALSE,
        "is_expired" BOOLEAN DEFAULT FALSE,
        "doc_type" doc_type,
        "url" int not NULL,
        "created_at" timestamp not null,
        "issued_at" timestamp,
        "updated_at" timestamp not null
    );

CREATE TABLE
    "notification" (
        id SERIAL PRIMARY KEY,
        "from" int not null,
        "to" int not null,
        "body" varchar(512) not null
    );

CREATE TABLE
    "link" (
        id SERIAL PRIMARY KEY,
        "owner" int not null,
        "is_open" BOOLEAN DEFAULT TRUE
    );

CREATE TABLE
    "file" (
        id SERIAL PRIMARY KEY,
        "url" VARCHAR(512) NOT NULL,
        "document" int null
    );

-- Many2Many Relationships
CREATE TABLE
    "doc_link" (
        id SERIAL PRIMARY KEY,
        "link" integer not null,
        "document" integer not null
    );

CREATE TABLE
    "link_permission" (
        id SERIAL PRIMARY KEY,
        "user" int not null,
        "link" int not null
    );

-- Constraints
ALTER TABLE "link_permission"
ADD CONSTRAINT fk_link_link_permission FOREIGN KEY ("link") REFERENCES "link" (id),
ADD CONSTRAINT fk_user_link_permission FOREIGN KEY ("user") REFERENCES "user" (id);

ALTER TABLE "doc_link"
ADD CONSTRAINT fk_doc_doc_link FOREIGN KEY ("document") REFERENCES "document" (id),
ADD CONSTRAINT fk_link_doc_link FOREIGN KEY ("link") REFERENCES "link" (id);

ALTER TABLE "link"
ADD CONSTRAINT fk_link_owner FOREIGN KEY ("owner") REFERENCES "user" (id);

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