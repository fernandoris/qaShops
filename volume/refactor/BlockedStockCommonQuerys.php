<?php
namespace qashops\refactor;

Class BlockedStockCommonQuerys extends BlockedStock
{
	/**
	 * Devuelve el stock bloqueado de un productId
	 * @param $productId
	 * @param bool $to_date Si está a true se consulta el campo blocked_stock_date si no blocked_stock_to_date
	 *
	 * @return int
	 */
	public static function getBlockedStock($productId, $to_date = false)
	{
		$field = 'blocked_stock_date';
		if ($to_date)
		{
			$field = 'blocked_stock_to_date';
		}
		return find()->select('SUM(quantity) as quantity')
		             ->joinWith('shoppingCart')
		             ->where(
		             	"blocked_stock.product_id = $productId AND 
		             	$field > '" . date('Y-m-d H:i:s') . "' AND 
		             	(
		             	    shopping_cart_id IS NULL 
		             	    OR shopping_cart.status = '" . ShoppingCart::STATUS_PENDING . "'
		             	)"
		             )
		             ->scalar();
	}
}