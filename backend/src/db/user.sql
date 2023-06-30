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
        "owner",
        "issued_by",
        "url",
        "created_at",
        "issued_at",
        "updated_at"
    )
Values
    (
        'Matric',
        1058,
        1086,
        6,
        '2022-04-04',
        '2022-05-05',
        '2022-04-04'
    );

-- Select users