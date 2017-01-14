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
select stk.id, stk.nama, stk.stock, curr.nama, stm.mutation_date, stm.amount, ut.nip, ut.nama as 'namapegawai', mt.nama as 'mutation_types'
from stocks_mutation stm
join stocks stk on stm.stocks_id = stk.id
join currencies curr on stk.currencies_id = curr.id
join users_table ut on ut.nip = stk.added_by
join mutation_types mt on stm.mutation_types = mt.id
where stk.id = 1;

-- check fuel stock
select stock from stocks where id = '1';

-- stock adding / purchasing #1
-- update stocks table
select * from stocks;
update stocks
set stock = stock - 5
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

-- stock checking
select * from stocks;
select stock from stocks where id = 1;


-- get fuel selling per day by stock id
select * from stocks_mutation;
select sum(amount) as 'sum' from stocks_mutation  -- mutation types 1 purchase, 2 stock adding
where mutation_date between now() - interval 10 day and now()
-- and stocks_id = 1
and mutation_types = 1;

-- get complete fuel selling data
select * from stocks_mutation;
select * from stocks;
select stk.id, stk.nama, stk.stock,
(
	select sum(amount) from stocks_mutation  -- mutation types 1 purchase, 2 stock adding
	where mutation_date between now() - interval 1 day and now()
	and mutation_types = 1
) as 'day',
(
	select sum(amount) from stocks_mutation  -- mutation types 1 purchase, 2 stock adding
	where mutation_date between now() - interval 7 day and now()
	and mutation_types = 1
) as 'week',
(
	select sum(amount) from stocks_mutation  -- mutation types 1 purchase, 2 stock adding
	where mutation_date between now() - interval 30 day and now()
	and mutation_types = 1
) as 'month'
from stocks stk;

-- initial datas ------------------------------------------------------------------------

-- initial currencies values
select * from currencies;
insert into currencies(nama)
values('liter');


select * from mutation_types;