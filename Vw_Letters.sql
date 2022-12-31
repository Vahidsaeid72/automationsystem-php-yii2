CREATE VIEW Vw_Letters AS

SELECT l.*,CONCAT(u.UsersName,' ',u.UsersFamily) AS fullNameCreator,

CASE l.LettersDraftType WHEN 1 THEN 'پیش نویس' WHEN 2 THEN 'نامه' END persianLettersDraftType,

CASE l.LettersType WHEN 1 THEN 'نامه' WHEN 2 THEN 'پاسخ به نامه' END persianLettersType,

CASE l.LettersTypeOfAction WHEN 1 THEN 'عادی' WHEN 2 THEN 'فوری' WHEN 3 THEN 'آنی' END persianLettersTypeOfAction,

CASE l.LettersSecurity WHEN 1 THEN 'عادی' WHEN 2 THEN 'محرمانه' WHEN 3 THEN 'سری' END persianLettersSecurity,

CASE l.LettersFollowType WHEN 1 THEN 'دارد' WHEN 2 THEN 'ندارد' END persianLettersFollowType,

CASE l.LettersResponseType WHEN 1 THEN 'دارد' WHEN 2 THEN 'ندارد' END persianLettersResponseType,

CASE l.LettersAttachmentType WHEN 1 THEN 'ندارد' WHEN 2 THEN 'دارد' END persianLettersAttachmentType,

CASE l.LettersArchiveType WHEN 1 THEN 'بایگانی نشده' WHEN 2 THEN 'بایگانی شده' END persianLettersArchiveType

FROM letters l

LEFT JOIN users u on u.UsersID = l.UsersID_FK