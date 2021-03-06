<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Inventory\Model\ResourceModel\Reservation;

use Magento\Framework\App\ResourceConnection;
use Magento\Inventory\Setup\Operation\CreateReservationTable;
use Magento\InventoryApi\Api\Data\ReservationInterface;

/**
 * Implementation of Reservation save multiple operation for specific db layer
 * Save Multiple used here for performance efficient purposes over single save operation
 */
class SaveMultiple
{
    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @param ResourceConnection $resource
     */
    public function __construct(
        ResourceConnection $resource
    ) {
        $this->resource = $resource;
    }

    /**
     * @param ReservationInterface[] $reservations
     * @return void
     */
    public function execute(array $reservations)
    {
        $connection = $this->resource->getConnection();
        $tableName = $connection->getTableName(CreateReservationTable::TABLE_NAME_RESERVATION);

        $columns = [
            ReservationInterface::STOCK_ID,
            ReservationInterface::SKU,
            ReservationInterface::QUANTITY,
            ReservationInterface::METADATA,
        ];

        $data = [];
        /** @var ReservationInterface $reservation */
        foreach ($reservations as $reservation) {
            $data[] = [
                $reservation->getStockId(),
                $reservation->getSku(),
                $reservation->getQuantity(),
                $reservation->getMetadata(),
            ];
        }
        $connection->insertArray($tableName, $columns, $data);
    }
}
