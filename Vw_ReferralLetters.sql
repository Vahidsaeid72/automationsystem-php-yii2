CREATE VIEW Vw_ReferralLetters AS

SELECT rl.ReferralLettersID,rl.ReferralLettersDate,rl.ReferralLettersDescription,rl.LettersID_FK,rl.UsersID_Sender,rl.UsersID_Receiver,rl.ReferralLettersReadType,



l.*,CONCAT(u.UsersName,' ',u.UsersFamily) AS FullNameSender,CONCAT(uu.UsersName,' ',uu.UsersFamily) AS FullNameReceiver,CONCAT(uuu.UsersName,' ',uuu.UsersFamily) AS FullCreator,

CASE l.LettersTypeOfAction WHEN 1 THEN 'عادی' WHEN 2 THEN 'فوری' WHEN 3 THEN 'آنی' END AS 	PersianLettersTypeOfAction,

CASE l.LettersSecurity WHEN 1 THEN 'عادی' WHEN 2 THEN 'محرمانه' WHEN 3 THEN 'سری' END AS PersianLettersSecurity,

CASE l.LettersArchiveType WHEN 1 THEN 'بایگانی نشده' WHEN 2 THEN 'بایگانی شده'  END AS PersianLettersArchiveType,

CASE l.LettersFollowType WHEN 1 THEN 'بپیگیری دارد' WHEN 2 THEN 'پیگیری ندارد'  END AS PersianLettersFollowType,

CASE l.LettersAttachmentType WHEN 1 THEN 'پیوست ندارد' WHEN 2 THEN 'پیوست دارد'  END AS PersianLettersAttachmentType,

CASE l.LettersType WHEN 1 THEN 'نامه' WHEN 2 THEN 'پاسخ به نامه'  END AS PersianLettersType,

CASE l.LettersResponseType WHEN 1 THEN 'دارد' WHEN 2 THEN 'ندارد'  END AS PersianLettersResponseType,

CASE l.LettersDraftType WHEN 1 THEN 'پیشنویس' WHEN 2 THEN 'نامه'  END AS PersianLettersDraftType,

CASE rl.ReferralLettersReadType WHEN 1 THEN 'خوانده نشده' WHEN 2 THEN 'خوانده شده'  END AS PersianReferralLettersReadType



FROM referralletters rl

INNER JOIN letters l on l.LettersID = rl.LettersID_FK

INNER JOIN users u on u.UsersID = rl.UsersID_Sender

INNER JOIN users uu on uu.UsersID = rl.UsersID_Receiver

INNER JOIN users uuu on uuu.UsersID = l.UsersID_FK