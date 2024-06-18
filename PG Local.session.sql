INSERT INTO comments (
    id,
    post_id,
    comment,
    user_id,
    created_at,
    updated_at
  )
VALUES (
    'id:bigint',
    'post_id:bigint',
    'comment:text',
    'user_id:bigint',
    'created_at:timestamp without time zone',
    'updated_at:timestamp without time zone'
  );