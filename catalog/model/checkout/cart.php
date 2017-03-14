<?php
class ModelCheckoutCart extends Model {
	public function getSellerID($cart_id) {
		$query = $this->db->query("SELECT seller_id FROM " . DB_PREFIX . "cart WHERE cart_id = '" . $cart_id . "'");

		return $query->row['seller_id'];
	}
}