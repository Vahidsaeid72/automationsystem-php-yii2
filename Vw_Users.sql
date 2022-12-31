create VIEW Vw_Users AS

SELECT u.*,CONCAT(u.UsersName,' ',u.UsersFamily) AS FullName,

CASE u.UsersGender WHEN 1 THEN 'مرد' WHEN  0 THEN 'زن' END AS PersianUsersGender,

CASE u.UsersActivity WHEN 0 THEN 'غیرفعال' WHEN  1 THEN 'فعال' END AS PersianUsersActivity

FROM users u