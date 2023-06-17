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
    JOIN "file" on "file"."id" = "document"."url";

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