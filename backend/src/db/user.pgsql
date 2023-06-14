-- File insert
INSERT INTO
    "file" (url)
Values
    ('/yellow');

UPDATE "user"
set
    "profile_pic" = 3
where
    "id" <= 100;

INSERT INTO
    "document" (
        "name",
        "issued_by",
        "url",
        "created_at",
        "issued_at",
        "updated_at"
    )
Values
    (
        'Matric',
        2,
        6,
        '2022-04-04',
        '2022-05-05',
        '2022-04-04'
    );

-- Select users
SELECT
    "user"."id",
    "user"."fname",
    "user"."lname",
    "user"."email",
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