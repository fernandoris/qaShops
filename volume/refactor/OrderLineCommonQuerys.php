<?php
namespace qashops\refactor;

Class OrderLineCommonQuerys extends OrderLine
{
	public static function getBlockedOrders($productId)
	{
		return find()
			->select('SUM(quantity) as quantity')
			->joinWith('order')
			->where(
				"
				order.status IN (
					'" . Order::STATUS_PENDING . "',
					'" . Order::STATUS_PROCESSING . "',
					'" . Order::STATUS_WAITING_ACCEPTANCE . "'
				)				 
				AND order_line.product_id = $productId
				"
			)->scalar();
	}
}