DROP TABLE "doc_link";

DROP TABLE "user" CASCADE;

DROP TABLE "document" CASCADE;

DROP TABLE "notification";

DROP TABLE "link_permission";

DROP TABLE "link" CASCADE;

DROP TABLE "file" CASCADE;


DROP TABLE "address" CASCADE;

DROP TYPE user_type CASCADE;

DROP TYPE doc_type CASCADE;

-- getUsers all users
-- getUsers that have accesses to a link
-- getUsers that have documents that
-- get user that belong to a type.


-- getDocumetns based on user
-- get Documents that are issued by org
-- get Documents that belong to a link
-- get Documents that belong to a type
-- get Documents issued on or after certain period.
-- get Expired documents
-- get Revoked Documents

-- get links that user have access to
-- get links that are owned by a user
-- get links that contain document

-- get notification from a user or to a user.