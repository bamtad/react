-- Querying Document
SELECT
    "document"."id" as "id",
    "document"."name",
    "document"."owner",
    "document"."description",
    "document"."is_revoked",
    "document"."updated_at",
    "document"."doc_type",
    "document"."created_at",
    "document"."issued_at",
    "document"."issued_by",
    "file"."url" as "url"
FROM
    "document"
    JOIN "file" on "file"."id" = "document"."url" WHERE "owner"= 5 OR "issued_by"=5;

-- Querying User
SELECT
    "user"."id",
    "user"."fname",
    "user"."lname",
    "user"."email",
    "user"."password",
    "user"."phone",
    "user"."is_verified",
    "user"."user_type",
    "user"."last_login",
    "user"."updated_at",
    "user"."created_at",
    "file"."url" as "profile_pic",
    "file2"."url" as "bg_pic"
From
    "user"
    LEFT JOIN "file" on "file"."id" = "user"."profile_pic"
    LEFT JOIN "file" as "file2" on "file2"."id" = "user"."bg_pic"
Order by
    "user"."id";

SELECT
    *
FROM
    "document"
WHERE
    owner = 3
    or "issued_by" = 3;

--@block
SELECT
    "comment"."id",
    "comment"."spot",
    "comment"."body",
    "user"."id" as "user_id",
    "user"."email" as "email",
    "file"."url" as "user_pp"

FROM
    "comment"
    JOIN "user" on "user"."id" = "comment"."user"
    LEFT JOIN "file" on "user"."profile_pic" = "file"."id";

    --@block

SELECT "link"."owner", "document".

--@block Filtering Link Document
SELECT
"link"."id",
    "document"."id" as "doc_id",
    "link"."name" as "link_name",
    "link"."url",
    "document"."name",
    "document"."owner",
    "document"."description",
    "document"."is_revoked",
    "document"."updated_at",
    "document"."doc_type",
    "document"."created_at",
    "document"."issued_at",
    "document"."issued_by",
    "file"."url" as "file_url"
FROM
    "doc_link"
JOIN "document" on "document"."id"="doc_link"."document"
JOIN "link" on  "link"."id"="doc_link"."link"
LEFT JOIN "link_permission" on "link_permission"."link"="link"."id"
LEFT JOIN "user" on "user"."id"="link_permission"."id"
    JOIN "file" on "file"."id" = "document"."url" -- WHERE "link"."url"='Epu6OdaVDz' and "user"."id"=1;

--@block
SELECT* From "link";
