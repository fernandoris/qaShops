<?php

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
			$ordersQuantity = OrderLine::getDb()->cache(
				OrderLineCommonQuerys::getBlockedOrders($productId),
				$cacheDuration
			);

			// Obtenemos el stock bloqueado
			$blockedStockQuantity = BlockedStock::getDb()->cache(
				BlockedStockCommonQuerys::getBlockedStock($productId),
				$cacheDuration
			);
		} else {
			// Obtenemos el stock bloqueado por pedidos en curso
			$ordersQuantity = OrderLineCommonQuerys::getBlockedOrders($productId);

			// Obtenemos el stock bloqueado
			$blockedStockQuantity = BlockedStockCommonQuerys::getBlockedStock($productId,true);
		}

		// Calculamos las unidades disponibles
		if (isset($ordersQuantity) || isset($blockedStockQuantity)) {
			if ($quantityAvailable >= 0) {
				$quantity = $quantityAvailable - @$ordersQuantity - @$blockedStockQuantity;
				if (!empty($securityStockConfig)) {
					$quantity = ShopChannel::applySecurityStockConfig(
						$quantity,
						@$securityStockConfig->mode,
						@$securityStockConfig->quantity
					);
				}
				return $quantity > 0 ? $quantity : 0;
			} elseif ($quantityAvailable < 0) {
				return $quantityAvailable;
			}
		} else {
			if ($quantityAvailable >= 0) {
				if (!empty($securityStockConfig)) {
					$quantityAvailable = ShopChannel::applySecurityStockConfig(
						$quantityAvailable,
						@$securityStockConfig->mode,
						@$securityStockConfig->quantity
					);
				}
				$quantityAvailable = $quantityAvailable > 0 ? $quantityAvailable : 0;
			}
			return $quantityAvailable;
		}
		return 0;
	}
}
