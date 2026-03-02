<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferShipmentType\Business\Filter;

use Generated\Shared\Transfer\ProductOfferCollectionTransfer;
use Generated\Shared\Transfer\ProductOfferShipmentTypeCollectionTransfer;

interface ProductOfferProductOfferShipmentTypeCollectionFilterInterface
{
    public function filterProductOfferShipmentTypeCollectionTransfersByProductOfferCollectionTransfer(
        ProductOfferShipmentTypeCollectionTransfer $productOfferShipmentTypeCollectionTransfer,
        ProductOfferCollectionTransfer $productOfferCollectionTransfer
    ): ProductOfferShipmentTypeCollectionTransfer;
}
