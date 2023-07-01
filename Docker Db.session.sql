-- @block
SELECT
    *
FROM
    "user"
where
    "id" > '12';

--@block
SHOW TABLES;

-- @block
SELECT
    tablename
FROM
    pg_catalog.pg_tables
where
    schemaname = 'public';

--@block
SELECT
    *
from
    user;

--@block
CREATE TABLE
    "test" (
        "email" varchar(255) not null,
        "fname" varchar(255) not null,
        "des" text not null,
        "gender" varchar(2) not null
    );

--@block
SELECT
    *
from
    "test";