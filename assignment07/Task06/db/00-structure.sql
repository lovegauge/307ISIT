
-- A single customer
create table customer (
	customer_id        integer primary key autoincrement,
	name               varchar(100) not null
);


-- Status type reference table
create table status_type (
	status_type_id     integer primary key autoincrement,
	description        varchar(20) not null,
);

-- Sample values for the status table
insert into status_type( description ) values ( 'Available' );
insert into status_type( description ) values ( 'On Hold' );
insert into status_type( description ) values ( 'Borrowed' );

-- Represents a single book
create table book (

-- Details about the book itself
	book_id            integer primary key autoincrement,
	name               text not null,
	isbn               varchar(10) not null,
	abstract           text,
	
-- What the current status of this book is
	status_type_id     integer not null references status_type(status_type_id),

-- The date the status was set
	status_date        timestamp,
	
-- The customer who has hold of this book ( null if nobody has it ) 
	customer_id        integer references customer(customer_id),
);
