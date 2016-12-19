SELECT COUNT(DISTINCT p.product_id) AS total FROM oc_product p LEFT JOIN oc_product_description pd 
ON (p.product_id = pd.product_id) LEFT JOIN oc_product_to_store p2s ON (p.product_id = p2s.product_id) 
WHERE pd.language_id = '1' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '0' AND 
( pd.name LIKE '%stay%' OR pd.tag LIKE '%stay%'