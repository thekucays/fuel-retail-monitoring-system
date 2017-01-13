use antarfuelretail;

-- queries -------------------------------------------------------------------------------

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
select is_logged from users_table
where nip = 'OP0001';

-- view stocks header
describe stocks;
select s.id, s.nama, s.quality, s.stock, s.harga, cur.nama as 'satuan'
from stocks s 
join currencies cur on s.currencies_id = cur.id;

-- view stocks detail
describe stocks_mutation;
select stk.id, stk.nama, stk.stock, stm.mutation_date, stm.amount, ut.nip, ut.nama, mt.nama as 'mutation_types'
from stocks_mutation stm
join stocks stk on stm.stocks_id = stk.id
join users_table ut on ut.nip = stk.added_by
join mutation_types mt on stm.mutation_types = mt.id
where stk.id = 1;

-- check fuel stock
select stock from stocks where id = '1';

-- stock adding / purchasing #1
-- update stocks table
select * from stocks;
update stocks
set stock = stock + 5
where id = 1;

-- stock adding / purchasing #2
-- add record to stocks_mutation
select * from stocks_mutation;
insert into stocks_mutation (mutation_date, nip, amount, mutation_types, stocks_id)
values(
	now(),
	'OP0001',
	5,
	2, -- 1 purchase, 2 stock adding
	1
);

-- initial datas ------------------------------------------------------------------------

-- initial currencies values
select * from currencies;
insert into currencies(nama)
values('liter');

