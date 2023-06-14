SELECT
    "document"."id" as "id",
    "document"."name",
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
    JOIN "user" on "user"."id" = "document"."issued_by"
    JOIN "file" on "file"."id" = "document"."url"
Where
    "document"."id" = 3