<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferShipmentType\Business\Filter;

use Generated\Shared\Transfer\ProductOfferShipmentTypeCollectionTransfer;
use Generated\Shared\Transfer\ShipmentTypeCollectionTransfer;

interface ShipmentTypeProductOfferShipmentTypeCollectionFilterInterface
{
    public function filterProductOfferShipmentTypeCollectionTransfersByShipmentTypeCollectionTransfer(
        ProductOfferShipmentTypeCollectionTransfer $productOfferShipmentTypeCollectionTransfer,
        ShipmentTypeCollectionTransfer $shipmentTypeCollectionTransfer
    ): ProductOfferShipmentTypeCollectionTransfer;
}
