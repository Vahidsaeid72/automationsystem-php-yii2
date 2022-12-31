CREATE VIEW Vw_UsersJob AS

SELECT uj.*,j.*,CONCAT(u.UsersName,' ',u.UsersFamily) AS FullName
,CASE j.JobsStatus WHEN 1 THEN 'انصاب داده شده' WHEN 0 THEN 'بدون انتصاب' END AS PersianJobsStatus


FROM usersjob uj

INNER JOIN jobs j on j.JobsID = uj.JobsID_FK

INNER JOIN users u on u.UsersID = uj.UsersID_FK