<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\InventoryApi\Api;

/**
 * Get assigned Sources for Stock
 *
 * Used fully qualified namespaces in annotations for proper work of WebApi request parser
 *
 * @api
 */
interface GetAssignedSourcesForStockInterface
{
    /**
     * Get Sources assigned to Stock
     *
     * If Stock with given id doesn't exist then return an empty array
     *
     * @param int $stockId
     * @return \Magento\InventoryApi\Api\Data\SourceInterface[]
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute($stockId);
}
