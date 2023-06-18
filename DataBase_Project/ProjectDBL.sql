CREATE database ProjectDBLC;
USE ProjectDBLC;

CREATE table products(
					prod_id int(255),
                    prod_name varchar(50),
                    cat_id int,
                    sup_id int,
                    mfg_date date,
                    exp_date date,
                    price int,
                    img varchar(255),
                    cart_id int,
                    Primary key(prod_id),
                    FOREIGN KEY (cat_id) REFERENCES category(cat_id) on delete cascade on update cascade,
                    FOREIGN KEY (sup_id) REFERENCES supplier(sup_id) on delete cascade on update cascade
                    );
SELECT * from products;
                    
CREATE table category(
					cat_id int primary key,
                    cat_name varchar(50)
                    );

INSERT into category values ('1', 'Brownies'),
							('2', 'Cakes'),
                            ('3', 'Donuts'),
                            ('4', 'Pastries'),
                            ('5', 'Nimcos');
SELECT * from category;                    

CREATE table supplier(
					sup_id int primary key,
                    sup_name varchar(50)
                    );
                    
INSERT into supplier values ('167', 'Daniyal'),
							('146', 'Hammad'),
                            ('189', 'Sohaib'),
                            ('195', 'Laiba'),
                            ('199', 'Rameesha'),
							('200', 'Shahzaib');
SELECT * from supplier;
update supplier set sup_id = 146
where sup_name = 'Hammad';

CREATE table login(
					username varchar(50),
                    pass varchar(50)
                    );
                    
INSERT into login values('daniyal6429', '12345');

CREATE table cart(
					id int primary key auto_increment,
					prod_id int(255),
                    prod_name varchar(50),
                    price int,
                    img varchar(255),
                    quantity int(255),
                    foreign key (prod_id) references products(prod_id) on delete cascade on update cascade
                    );
SELECT * from cart;  

update products set price = 600
where prod_name = 'pastry';     

CREATE table customer(
					customer_id varchar(255),
                    prod_id int(255),
                    fname varchar(50),
                    lname varchar(50),
					email varchar(50),
                    ph_number varchar(50),
                    address varchar(50),
                    city varchar(50),
                    code int,
                    payment varchar(50),
                    total_products varchar(50),
                    total_price varchar(50),
                    order_date date,
                    Primary key(customer_id),
                    FOREIGN KEY (prod_id) references products(prod_id) on delete cascade on update cascade
                    );

desc customer;
SELECT * from customer;
                    
CREATE table orders(
					order_id int primary key,
                    customer_id varchar(255),
                    order_date date
                    );
                    
ALTER table orders 
ADD FOREIGN KEY (customer_id) references customer(customer_id) on delete cascade on update cascade;
SELECT * from orders;
desc orders;
                    
CREATE table cust_pro(
						orderdetailID int auto_increment,
						order_id int,
                        prod_id int(255),
                        Primary key(orderdetailID),
                        FOREIGN KEY (prod_id) references products(prod_id) on delete cascade on update cascade,
                        FOREIGN KEY (order_id) references orders(order_id) on delete cascade on update cascade
                        );
ALTER table cust_pro add customer_id varchar(255) after order_id;
ALTER table cust_pro
ADD FOREIGN KEY (customer_id) references customer(customer_id) on delete cascade on update cascade;

SELECT * from cust_pro;
ALTER table cust_pro auto_increment = 1;

-- Logs table record
CREATE TABLE log_record(
				id INT PRIMARY KEY AUTO_INCREMENT,
				action VARCHAR(20),
				prod_id int(255),
				prod_name varchar(50),
				cat_id int,
				sup_id int,
				old_price int,
				new_price int,
				timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Procedure for LOGIN
Delimiter $$
CREATE PROCEDURE CheckLogin(IN p_username VARCHAR(255), IN p_password VARCHAR(255), OUT p_result INT)
BEGIN
    DECLARE count INT;
    
    SELECT COUNT(*) INTO count
    FROM login
    WHERE username = p_username AND pass = p_password;
    
    SET p_result = count;
END $$
Delimiter ;

-- Triggers
-- This trigger will log the insertion of a new product into the log_ecord table.
DELIMITER $$

CREATE TRIGGER after_product_insert
AFTER INSERT ON products
FOR EACH ROW
BEGIN
  INSERT INTO log_record (action, prod_id, prod_name, cat_id, sup_id, new_price)
  VALUES ('Insert', NEW.prod_id, NEW.prod_name, NEW.cat_id, NEW.sup_id, NEW.price);
END $$

DELIMITER ;

-- This trigger will log the deletion of a product from the log_record table.
DELIMITER $$

CREATE TRIGGER after_product_delete
AFTER DELETE ON products
FOR EACH ROW
BEGIN
  INSERT INTO log_record (action, prod_id, prod_name, cat_id, sup_id, old_price)
  VALUES ('Delete', OLD.prod_id, OLD.prod_name, OLD.cat_id, OLD.sup_id, OLD.price);
END $$

DELIMITER ;

-- This trigger will log the updates made to a product in the log_record table. It will record the old and new values of the price column.
DELIMITER $$

CREATE TRIGGER after_product_update
AFTER UPDATE ON products
FOR EACH ROW
BEGIN
  IF NEW.price <> OLD.price THEN
    INSERT INTO log_record (action, prod_id, prod_name, cat_id, sup_id, old_price, new_price)
    VALUES ('Update', NEW.prod_id, NEW.prod_name, NEW.cat_id, NEW.sup_id, OLD.price, NEW.price);
  END IF;
END $$

DELIMITER ;

SELECT * from log_record;

-- Transactions
-- Stored procedure to delete a product
Delimiter $$
CREATE PROCEDURE DeleteProduct(
    IN p_prod_id INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
    DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
    
    START TRANSACTION;
    
    DELETE FROM products WHERE prod_id = p_prod_id;
    
    COMMIT;
END $$
delimiter ;

Call DeleteProduct(121);

-- Stored procedure to update a product quantity in cart
DELIMITER $$
CREATE PROCEDURE UpdateProductQuantity(
    IN product_id INT(255),
    IN quantity_to_update INT(255)
)
BEGIN
    DECLARE condition_failed INT DEFAULT 0;

    START TRANSACTION;
    
    -- Check if the product exists
    SELECT COUNT(*) INTO @product_exists FROM products WHERE prod_id = product_id;
    
    IF (@product_exists > 0) THEN
        -- Update cart quantity
        UPDATE cart SET quantity = quantity + quantity_to_update WHERE prod_id = product_id;
    ELSE
        SET condition_failed = 1;
    END IF;

    -- Check for any errors or conditions that require rollback
    IF (condition_failed) THEN
        -- If an error or condition occurs, rollback the changes
        ROLLBACK;
    ELSE
        -- If everything is successful, commit the changes
        COMMIT;
    END IF;
    
END $$
DELIMITER ;

Call UpdateProductQuantity(114, 5);

-- Creating Views
CREATE VIEW view_product_details AS
SELECT p.prod_id, p.prod_name, c.cat_name, s.sup_name, p.price
FROM products p
JOIN category c ON p.cat_id = c.cat_id
JOIN supplier s ON p.sup_id = s.sup_id;

Select * from view_product_details;

-- Creating a Temporary Table:
CREATE TEMPORARY TABLE temp_cart
SELECT *
FROM cart
WHERE prod_id = '117';

SELECT * from temp_cart;

-- Cloning Data from One Table to Another:
CREATE TABLE new_orders AS
SELECT *
FROM orders;

SELECT * from new_orders;

-- Cloning a table
CREATE TABLE cloned_table AS
SELECT p.prod_id, p.prod_name, c.cat_name, s.sup_name, p.price, ct.quantity
FROM products p
JOIN category c ON p.cat_id = c.cat_id
JOIN supplier s ON p.sup_id = s.sup_id
JOIN cart ct ON p.prod_id = ct.prod_id;

SELECT * from cloned_table;

-- Queries
-- Retrieve all customers with their total purchase amount:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, SUM(p.price) AS total_purchase_amount
FROM customer c
JOIN products p ON c.prod_id = p.prod_id
GROUP BY c.customer_id, customer_name;

-- Retrieve the product with the maximum price:
SELECT prod_id, prod_name, price
FROM products
WHERE price = (SELECT MAX(price) FROM products);

-- Retrieve the products that no one has purchased yet:
SELECT p.prod_id, p.prod_name
FROM products p
LEFT JOIN cart c ON p.prod_id = c.prod_id
WHERE c.prod_id IS NULL;

-- Retrieve the average price of products in each category:
SELECT cat.cat_id, cat.cat_name, CAST(AVG(p.price) as decimal(8,2)) AS avg_price
FROM category cat
JOIN products p ON cat.cat_id = p.cat_id
GROUP BY cat.cat_id, cat.cat_name;

-- Retrieve the total quantity and total price of products in each order:
SELECT o.order_id, p.prod_id, SUM(ct.quantity) AS total_quantity, SUM(p.price * ct.quantity) AS total_price
FROM orders o
JOIN cust_pro cp ON o.order_id = cp.order_id
JOIN cart ct ON cp.prod_id = ct.prod_id
JOIN products p ON cp.prod_id = p.prod_id
GROUP BY o.order_id, p.prod_id;

-- Retrieve the customer who has placed the most orders:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, COUNT(o.order_id) AS total_orders
FROM customer c
JOIN orders o ON c.customer_id = o.customer_id
GROUP BY c.customer_id, customer_name
HAVING COUNT(o.order_id) = (SELECT MAX(order_count) FROM (SELECT COUNT(order_id) AS order_count FROM orders GROUP BY customer_id) AS subquery);

-- Retrieve the products that are currently in the customer's cart:
SELECT ct.prod_id, p.prod_name
FROM cart ct
JOIN products p ON ct.prod_id = p.prod_id
WHERE ct.quantity > 0;

-- Retrieve the orders placed by a specific customer:
SELECT c.customer_id, o.order_id, o.order_date
FROM orders o
JOIN customer c ON o.customer_id = c.customer_id
WHERE c.customer_id = '125415';

-- Retrieve the total number of products in each category:
SELECT cat.cat_id, cat.cat_name, COUNT(p.prod_id) AS total_products
FROM category cat
LEFT JOIN products p ON cat.cat_id = p.cat_id
GROUP BY cat.cat_id, cat.cat_name;

-- Retrieve the customer who has made the highest total purchase amount:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, SUM(p.price) AS total_purchase_amount
FROM customer c
JOIN cart ct ON c.prod_id = ct.prod_id
JOIN products p ON ct.prod_id = p.prod_id
GROUP BY c.customer_id, customer_name
ORDER BY total_purchase_amount DESC
LIMIT 1;

-- Retrieve the average price of products for each supplier:
SELECT s.sup_id, s.sup_name, CAST(AVG(p.price) as decimal(8,2)) AS avg_price
FROM supplier s
JOIN products p ON s.sup_id = p.sup_id
GROUP BY s.sup_id, s.sup_name;

-- Retrieve the customers who have placed orders in a specific city:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, o.order_id, o.order_date
FROM customer c
JOIN orders o ON c.customer_id = o.customer_id
WHERE c.city = 'Karachi';

-- Retrieve the total revenue generated by each product:
SELECT p.prod_id, p.prod_name, SUM(p.price * ct.quantity) AS total_revenue
FROM products p
JOIN cart ct ON p.prod_id = ct.prod_id
GROUP BY p.prod_id, p.prod_name;

-- Retrieve the most recent order placed by each customer:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, o.order_id, o.order_date
FROM customer c
JOIN orders o ON c.customer_id = o.customer_id
WHERE o.order_date = (SELECT MAX(order_date) FROM orders WHERE customer_id = c.customer_id);

-- Retrieve the products that have expired:
SELECT prod_id, prod_name
FROM products
WHERE exp_date < CURDATE();

-- Retrieve the top 5 customers with the highest total purchase amount:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, SUM(p.price) AS total_purchase_amount
FROM customer c
JOIN products p ON c.prod_id = p.prod_id
GROUP BY c.customer_id, customer_name
ORDER BY total_purchase_amount DESC
LIMIT 5;

-- Retrieve the products with a price higher than the average price of all products:
SELECT prod_id, prod_name, price
FROM products
WHERE price > (SELECT AVG(price) FROM products);

-- Retrieve the number of orders placed in each month:
SELECT MONTHNAME(order_date) AS month, COUNT(order_id) AS order_placed
FROM orders
GROUP BY MONTHNAME(order_date);

-- Retrieve the customers who have placed orders within the last 30 days:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, o.order_id, o.order_date
FROM customer c
JOIN orders o ON c.customer_id = o.customer_id
WHERE o.order_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY);

-- Retrieve the products that have a name starting with the letter 'C':
SELECT prod_id, prod_name
FROM products
WHERE prod_name LIKE 'C%';

-- Retrieve the customers who have purchased the maximum number of unique products:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, COUNT(DISTINCT p.prod_id) AS unique_product_count
FROM customer c
JOIN cart ct ON c.prod_id = ct.prod_id
JOIN products p ON ct.prod_id = p.prod_id
GROUP BY c.customer_id, customer_name
HAVING COUNT(DISTINCT p.prod_id) = (SELECT MAX(unique_product_count) FROM (SELECT COUNT(DISTINCT prod_id) AS unique_product_count FROM cart GROUP BY prod_id) AS subquery);

-- Retrieve the products that have been purchased by more than 1 customers:
SELECT p.prod_id, p.prod_name
FROM products p
JOIN cart ct ON p.prod_id = ct.prod_id
JOIN customer c ON c.prod_id = p.prod_id
GROUP BY p.prod_id, p.prod_name
HAVING COUNT(DISTINCT c.customer_id) >= 1;

-- Retrieve the customers who have placed an order within a specific date range:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, o.order_id, o.order_date
FROM customer c
JOIN orders o ON c.customer_id = o.customer_id
WHERE o.order_date BETWEEN '2023-06-17' AND '2023-06-18';

-- Retrieve the customers who have purchased products from multiple categories:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name
FROM customer c
JOIN cart ct ON c.prod_id = ct.prod_id
JOIN products p ON ct.prod_id = p.prod_id
GROUP BY c.customer_id, customer_name
HAVING COUNT(DISTINCT p.cat_id) > 1;

-- Retrieve the products that have been purchased by all customers:
SELECT p.prod_id, p.prod_name
FROM products p
WHERE NOT EXISTS (
    SELECT c.customer_id
    FROM customer c
    WHERE NOT EXISTS (
        SELECT 1
        FROM cart ct
        WHERE c.prod_id = ct.prod_id
        AND ct.prod_id = p.prod_id
    )
);

-- Retrieve the customers who have placed at least 1 orders with a total purchase amount greater than 2000:
SELECT c.customer_id, CONCAT(c.fname, ' ', c.lname) AS customer_name, COUNT(o.order_id) AS order_count, SUM(p.price * ct.quantity) AS total_purchase_amount
FROM customer c
JOIN orders o ON c.customer_id = o.customer_id
JOIN cust_pro cp ON o.order_id = cp.order_id
JOIN cart ct ON cp.prod_id = ct.prod_id
JOIN products p ON ct.prod_id = p.prod_id
GROUP BY c.customer_id, customer_name
HAVING order_count >= 1 AND total_purchase_amount > 2000;

-- Indexing
-- Creating an index on a column:
CREATE INDEX product_name ON products (prod_name);

-- Using an index in a SELECT query to improve performance:
SELECT * FROM products WHERE prod_name = ' Lemon Pound Cake';

-- Utilizing an index in an ORDER BY clause:
SELECT * FROM products ORDER BY price;

-- Complete --




























