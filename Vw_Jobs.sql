CREATE VIEW Vw_Jobs AS

SELECT j.*,jj.JobsName AS SubJobs,

CASE j.JobsStatus WHEN 1 THEN 'انصاب داده شده' WHEN 0 THEN 'بدون انتصاب' END AS PersianJobsStatus

FROM jobs j

LEFT JOIN jobs jj on jj.JobsID = j.JobsParentID
