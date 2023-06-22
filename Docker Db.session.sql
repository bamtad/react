-- @block
SELECT *
FROM "user"
where "id" > '12';
--@block
SHOW TABLES;
-- @block
SELECT tablename
FROM pg_catalog.pg_tables
where schemaname = 'public';
--@block
SELECT *
from user;