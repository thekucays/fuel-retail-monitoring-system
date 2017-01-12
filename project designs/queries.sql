use antarfuelretail;

--  login
select sb.tipe from users_table ut
join subclass sb on ut.subclass = sb.id
where nip='OP0001' and pass=md5('123456');

-- update last_login dan is_logged pada saat user berhasil login
update users_table
set last_login = now(), is_logged = "1"
where nip = "OP0001";

-- check session (dijalanin setiap nge-submit form, dan setiap pindah page
-- selain cek ini, cek juga $_SESSION nya