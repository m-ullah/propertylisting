CREATE TABLE `property` (
 `property_id` string PRIMARY KEY,
 `sync_date` timestamp DEFAULT CURRENT_TIMESTAMP,
 `data` mediumtext
);