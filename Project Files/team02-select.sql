/*query1*/
SELECT f.item_name AS Food, COUNT(f.itemID) AS Count, r.rest_name
FROM deliveries AS d 
JOIN orders AS o 
ON o.orderID = d.orderID 
JOIN food_items AS f                                           
ON o.itemID = f.itemID
JOIN menu AS m                                        
ON m.menuID = f.itemID
JOIN restaurant AS r                                        
ON m.restaurantID = r.restaurantID
WHERE r.rest_name = 'Fanoodle'
GROUP BY f.itemID;

/*query2*/
SELECT d.driverID AS id, CONCAT(d.driver_fname, d.driver_lname) AS name, COUNT(del.driverID) AS CompletedOrders
FROM driver AS d
JOIN deliveries AS del
ON del.driverID = d.driverID
WHERE del.delivery_success_y_or_n = "y"
GROUP BY del.driverID
ORDER BY COUNT(del.driverID);

/*query3*/
SELECT CONCAT(driver_fname, " " , driver_mname, " ", driver_lname) as
Name, driver_dob AS 'DOB', driver_phone AS phone, driver_email AS email
FROM driver
JOIN deliveries ON driver.driverID=deliveries.driverID
WHERE delivery_time > '2022-04-01 00:00:01'
GROUP BY DOB
 
/*query4*/
SELECT COUNT(*)
FROM menu
JOIN food_items ON menu.menuID =food_items.menuID
JOIN purchase_ticket ON food_items.itemID=purchase_ticket.itemID
JOIN orders ON purchase_ticket.orderID=orders.orderID
JOIN deliveries ON orders.orderID=deliveries.orderID
JOIN driver ON deliveries.driverID=driver.driverID
WHERE menu_name = 'Red Hartebeest' AND 33 < (DATEDIFF(CURDATE(), driver_dob)/365);
 
/*query5*/
SELECT p.itemID, SUM(purchases) AS Total_Revenue, r.rest_name  
FROM purchase_ticket AS p 
JOIN orders as o ON  o.orderID = p.orderID 
JOIN food_items AS f                                           
ON o.itemID = f.itemID
JOIN menu AS m                                        
ON m.menuID = f.itemID
JOIN restaurant AS r                                        
ON m.restaurantID = r.restaurantID
WHERE r.rest_name = 'Fanoodle'
GROUP BY p.orderID 
ORDER BY SUM(p.purchases) DESC 
LIMIT 3;

 



