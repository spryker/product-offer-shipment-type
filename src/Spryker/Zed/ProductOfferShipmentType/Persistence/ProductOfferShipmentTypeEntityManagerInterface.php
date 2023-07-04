<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferShipmentType\Persistence;

interface ProductOfferShipmentTypeEntityManagerInterface
{
    /**
     * @param int $idProductOffer
     * @param int $idShipmentType
     *
     * @return void
     */
    public function createProductOfferShipmentType(int $idProductOffer, int $idShipmentType): void;

    /**
     * @param int $idProductOffer
     * @param array<int> $shipmentTypeIds
     *
     * @return void
     */
    public function deleteProductOfferShipmentTypes(int $idProductOffer, array $shipmentTypeIds): void;
}
