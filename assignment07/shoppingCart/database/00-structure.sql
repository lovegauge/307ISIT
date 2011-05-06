-- 
-- Create new customer table
-- 
create table customer (
	customer_id integer primary key auto_increment not null,
	customer_password varchar(20) not null,
	customer_phone_no varchar(20) not null,
	customer_first_name varchar(30) not null,
	customer_last_name varchar(30) not null,
	customer_address text not null,
	customer_postcode varchar(4) not null
);

-- 
-- Create new product table 
-- 
create table product (
	product_id integer primary key auto_increment not null,
	category_id integer not null references category(category_id),
	product_price decimal(8,2) not null,
	product_name text not null,
	product_description text not null,
	product_picture_path text not null
);

-- 
-- Create new invoice table
-- 
create table invoice (
	invoice_id integer primary key auto_increment not null,
	customer_id integer not null references customer(customer_id),
	invoiced_date date not null
);

-- 
-- Create new invoice_product table
-- 
create table invoice_product(
	invoice_product_id integer primary key auto_increment,
	invoice_id integer not null references invoice(invoice_id),
	product_id integer not null references product(product_id),
	product_quantity integer not null default 1
);

-- 
-- Create new category table
-- 
create table category(
	category_id integer primary key auto_increment,
	category_name varchar(25) not null
				
);
