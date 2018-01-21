<?php
namespace qashops\refactor;

class Product
{
	public static function stock(
		$productId,
		$quantityAvailable,
		$cache = false,
		$cacheDuration = 60,
		$securityStockConfig = null
	) {
		if ($cache) {
			// Obtenemos el stock bloqueado por pedidos en curso
			$blockedOrders = OrderLine::getDb()->cache(
				OrderLineCommonQuerys::getBlockedOrders($productId),
				$cacheDuration
			);

			// Obtenemos el stock bloqueado
			$blockedStock = BlockedStock::getDb()->cache(
				BlockedStockCommonQuerys::getBlockedStock($productId),
				$cacheDuration
			);
		} else {
			// Obtenemos el stock bloqueado por pedidos en curso
			$blockedOrders = OrderLineCommonQuerys::getBlockedOrders($productId);

			// Obtenemos el stock bloqueado
			$blockedStock = BlockedStockCommonQuerys::getBlockedStock($productId,true);
		}


		// Calculamos las unidades disponibles
		if (isset($blockedOrders) || isset($blockedStock))
		{
			$quantityAvailable = $quantityAvailable - $blockedOrders - $blockedStock;
		}

		if ($quantityAvailable >= 0) {
			if (!empty($securityStockConfig)) {
				$quantityAvailable = ShopChannel::applySecurityStockConfig(
					$quantityAvailable,
					$securityStockConfig->mode,
					$securityStockConfig->quantity
				);
			}
		}

		return $quantityAvailable;
	}
}
