CREATE VIEW Vw_LettersTrash AS

SELECT l.*,lt.LettersTrashID,lt.LettersID_FK,lt.UsersID_FK AS UsersIDDeletor,lt.LettersTrashDate,CONCAT(u.UsersName,' ',u.UsersFamily) AS FullNameSender,

CONCAT(uu.UsersName,' ',uu.UsersFamily) AS FullNameDeletor,

CASE l.LettersTypeOfAction WHEN 1 THEN 'عادی' WHEN 2 THEN 'فوری' WHEN 3 THEN 'آنی' END AS 	PersianLettersTypeOfAction,

CASE l.LettersSecurity WHEN 1 THEN 'عادی' WHEN 2 THEN 'محرمانه' WHEN 3 THEN 'سری' END AS PersianLettersSecurity,

CASE l.LettersArchiveType WHEN 1 THEN 'بایگانی نشده' WHEN 2 THEN 'بایگانی شده'  END AS PersianLettersArchiveType,

CASE l.LettersFollowType WHEN 1 THEN 'بپیگیری دارد' WHEN 2 THEN 'پیگیری ندارد'  END AS PersianLettersFollowType,

CASE l.LettersAttachmentType WHEN 1 THEN 'پیوست ندارد' WHEN 2 THEN 'پیوست دارد'  END AS PersianLettersAttachmentType,

CASE l.LettersType WHEN 1 THEN 'نامه' WHEN 2 THEN 'پاسخ به نامه'  END AS PersianLettersType,

CASE l.LettersResponseType WHEN 1 THEN 'دارد' WHEN 2 THEN 'ندارد'  END AS PersianLettersResponseType,

CASE l.LettersDraftType WHEN 1 THEN 'پیشنویس' WHEN 2 THEN 'نامه'  END AS PersianLettersDraftType



from letters l

INNER JOIN letterstrash lt on lt.LettersID_FK = l.LettersID

INNER JOIN users u on u.UsersID = l.UsersID_FK

INNER JOIN users uu on uu.UsersID = lt.UsersID_FK