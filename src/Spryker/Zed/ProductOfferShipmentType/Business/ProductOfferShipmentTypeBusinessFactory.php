<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOfferShipmentType\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferExpander;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferExpanderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferProductOfferShipmentTypeCollectionExpander;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferProductOfferShipmentTypeCollectionExpanderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferProductOfferShipmentTypeCollectionRequestExpander;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferProductOfferShipmentTypeCollectionRequestExpanderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferShipmentTypeCollectionRequestExpander;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ProductOfferShipmentTypeCollectionRequestExpanderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ShipmentTypeProductOfferShipmentTypeCollectionExpander;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ShipmentTypeProductOfferShipmentTypeCollectionExpanderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ShipmentTypeProductOfferShipmentTypeCollectionRequestExpander;
use Spryker\Zed\ProductOfferShipmentType\Business\Expander\ShipmentTypeProductOfferShipmentTypeCollectionRequestExpanderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ErrorExtractor;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ErrorExtractorInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ProductOfferExtractor;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ProductOfferExtractorInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ProductOfferShipmentTypeExtractor;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ProductOfferShipmentTypeExtractorInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ShipmentTypeExtractor;
use Spryker\Zed\ProductOfferShipmentType\Business\Extractor\ShipmentTypeExtractorInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Filter\ProductOfferFilter;
use Spryker\Zed\ProductOfferShipmentType\Business\Filter\ProductOfferFilterInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Filter\ProductOfferProductOfferShipmentTypeCollectionFilter;
use Spryker\Zed\ProductOfferShipmentType\Business\Filter\ProductOfferProductOfferShipmentTypeCollectionFilterInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Filter\ShipmentTypeProductOfferShipmentTypeCollectionFilter;
use Spryker\Zed\ProductOfferShipmentType\Business\Filter\ShipmentTypeProductOfferShipmentTypeCollectionFilterInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Indexer\ProductOfferIndexer;
use Spryker\Zed\ProductOfferShipmentType\Business\Indexer\ProductOfferIndexerInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Indexer\ShipmentTypeIndexer;
use Spryker\Zed\ProductOfferShipmentType\Business\Indexer\ShipmentTypeIndexerInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Reader\ProductOfferReader;
use Spryker\Zed\ProductOfferShipmentType\Business\Reader\ProductOfferReaderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Reader\ProductOfferShipmentTypeReader;
use Spryker\Zed\ProductOfferShipmentType\Business\Reader\ProductOfferShipmentTypeReaderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Reader\ShipmentTypeReader;
use Spryker\Zed\ProductOfferShipmentType\Business\Reader\ShipmentTypeReaderInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Saver\ProductOfferShipmentTypeSaver;
use Spryker\Zed\ProductOfferShipmentType\Business\Saver\ProductOfferShipmentTypeSaverInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\ProductOfferValidator;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\ProductOfferValidatorInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\Rule\ProductOffer\ProductOfferExistsProductOfferValidatorRule;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\Rule\ProductOffer\ProductOfferUniquenessValidatorRule;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\Rule\ProductOffer\ProductOfferValidatorRuleInterface;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\Rule\ProductOffer\ShipmentTypeExistsProductOfferValidatorRule;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\Rule\ProductOffer\ShipmentTypeUniquenessProductOfferValidatorRule;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\Util\ErrorAdder;
use Spryker\Zed\ProductOfferShipmentType\Business\Validator\Util\ErrorAdderInterface;
use Spryker\Zed\ProductOfferShipmentType\Dependency\Facade\ProductOfferShipmentTypeToProductOfferFacadeInterface;
use Spryker\Zed\ProductOfferShipmentType\Dependency\Facade\ProductOfferShipmentTypeToShipmentTypeFacadeInterface;
use Spryker\Zed\ProductOfferShipmentType\ProductOfferShipmentTypeDependencyProvider;

/**
 * @method \Spryker\Zed\ProductOfferShipmentType\ProductOfferShipmentTypeConfig getConfig()
 * @method \Spryker\Zed\ProductOfferShipmentType\Persistence\ProductOfferShipmentTypeEntityManagerInterface getEntityManager()
 * @method \Spryker\Zed\ProductOfferShipmentType\Persistence\ProductOfferShipmentTypeRepositoryInterface getRepository()
 */
class ProductOfferShipmentTypeBusinessFactory extends AbstractBusinessFactory
{
    public function createProductOfferExpander(): ProductOfferExpanderInterface
    {
        return new ProductOfferExpander(
            $this->getRepository(),
            $this->createProductOfferExtractor(),
            $this->createProductOfferShipmentTypeExtractor(),
            $this->createShipmentTypeReader(),
            $this->createShipmentTypeIndexer(),
        );
    }

    public function createProductOfferShipmentTypeSaver(): ProductOfferShipmentTypeSaverInterface
    {
        return new ProductOfferShipmentTypeSaver(
            $this->getEntityManager(),
            $this->createProductOfferValidator(),
            $this->createProductOfferFilter(),
            $this->getRepository(),
            $this->createProductOfferShipmentTypeCollectionRequestExpander(),
            $this->createProductOfferExtractor(),
        );
    }

    public function createProductOfferShipmentTypeReader(): ProductOfferShipmentTypeReaderInterface
    {
        return new ProductOfferShipmentTypeReader(
            $this->getConfig(),
            $this->getRepository(),
            $this->createProductOfferReader(),
            $this->createShipmentTypeReader(),
        );
    }

    public function createProductOfferReader(): ProductOfferReaderInterface
    {
        return new ProductOfferReader(
            $this->createProductOfferProductOfferShipmentTypeCollectionFilter(),
            $this->createProductOfferProductOfferShipmentTypeCollectionExpander(),
            $this->getProductOfferFacade(),
        );
    }

    public function createShipmentTypeReader(): ShipmentTypeReaderInterface
    {
        return new ShipmentTypeReader(
            $this->createShipmentTypeProductOfferShipmentTypeCollectionFilter(),
            $this->createShipmentTypeProductOfferShipmentTypeCollectionExpander(),
            $this->createShipmentTypeExtractor(),
            $this->getShipmentTypeFacade(),
        );
    }

    public function createProductOfferProductOfferShipmentTypeCollectionFilter(): ProductOfferProductOfferShipmentTypeCollectionFilterInterface
    {
        return new ProductOfferProductOfferShipmentTypeCollectionFilter(
            $this->createProductOfferIndexer(),
        );
    }

    public function createShipmentTypeProductOfferShipmentTypeCollectionFilter(): ShipmentTypeProductOfferShipmentTypeCollectionFilterInterface
    {
        return new ShipmentTypeProductOfferShipmentTypeCollectionFilter(
            $this->createShipmentTypeIndexer(),
        );
    }

    public function createProductOfferProductOfferShipmentTypeCollectionExpander(): ProductOfferProductOfferShipmentTypeCollectionExpanderInterface
    {
        return new ProductOfferProductOfferShipmentTypeCollectionExpander(
            $this->createProductOfferIndexer(),
        );
    }

    public function createShipmentTypeProductOfferShipmentTypeCollectionExpander(): ShipmentTypeProductOfferShipmentTypeCollectionExpanderInterface
    {
        return new ShipmentTypeProductOfferShipmentTypeCollectionExpander(
            $this->createShipmentTypeIndexer(),
            $this->createShipmentTypeExtractor(),
        );
    }

    public function createProductOfferShipmentTypeCollectionRequestExpander(): ProductOfferShipmentTypeCollectionRequestExpanderInterface
    {
        return new ProductOfferShipmentTypeCollectionRequestExpander(
            $this->createProductOfferProductOfferShipmentTypeCollectionRequestExpander(),
            $this->createShipmentTypeProductOfferShipmentTypeCollectionRequestExpander(),
        );
    }

    public function createProductOfferProductOfferShipmentTypeCollectionRequestExpander(): ProductOfferProductOfferShipmentTypeCollectionRequestExpanderInterface
    {
        return new ProductOfferProductOfferShipmentTypeCollectionRequestExpander(
            $this->createProductOfferExtractor(),
            $this->createProductOfferReader(),
        );
    }

    public function createShipmentTypeProductOfferShipmentTypeCollectionRequestExpander(): ShipmentTypeProductOfferShipmentTypeCollectionRequestExpanderInterface
    {
        return new ShipmentTypeProductOfferShipmentTypeCollectionRequestExpander(
            $this->createProductOfferExtractor(),
            $this->createShipmentTypeReader(),
        );
    }

    public function createProductOfferIndexer(): ProductOfferIndexerInterface
    {
        return new ProductOfferIndexer();
    }

    public function createShipmentTypeIndexer(): ShipmentTypeIndexerInterface
    {
        return new ShipmentTypeIndexer();
    }

    public function createShipmentTypeExtractor(): ShipmentTypeExtractorInterface
    {
        return new ShipmentTypeExtractor();
    }

    public function createProductOfferFilter(): ProductOfferFilterInterface
    {
        return new ProductOfferFilter($this->createErrorExtractor());
    }

    public function createProductOfferExtractor(): ProductOfferExtractorInterface
    {
        return new ProductOfferExtractor();
    }

    public function createErrorExtractor(): ErrorExtractorInterface
    {
        return new ErrorExtractor();
    }

    public function createProductOfferShipmentTypeExtractor(): ProductOfferShipmentTypeExtractorInterface
    {
        return new ProductOfferShipmentTypeExtractor();
    }

    public function createProductOfferValidator(): ProductOfferValidatorInterface
    {
        return new ProductOfferValidator($this->getProductOfferValidatorRules());
    }

    /**
     * @return list<\Spryker\Zed\ProductOfferShipmentType\Business\Validator\Rule\ProductOffer\ProductOfferValidatorRuleInterface>
     */
    public function getProductOfferValidatorRules(): array
    {
        return [
            $this->createProductOfferExistsProductOfferValidatorRule(),
            $this->createShipmentTypeExistsProductOfferValidatorRule(),
            $this->createShipmentTypeUniquenessProductOfferValidatorRule(),
            $this->createProductOfferUniquenessValidatorRule(),
        ];
    }

    public function createProductOfferExistsProductOfferValidatorRule(): ProductOfferValidatorRuleInterface
    {
        return new ProductOfferExistsProductOfferValidatorRule(
            $this->createErrorAdder(),
            $this->createProductOfferReader(),
        );
    }

    public function createShipmentTypeExistsProductOfferValidatorRule(): ProductOfferValidatorRuleInterface
    {
        return new ShipmentTypeExistsProductOfferValidatorRule(
            $this->createProductOfferExtractor(),
            $this->createShipmentTypeExtractor(),
            $this->createShipmentTypeReader(),
            $this->createErrorAdder(),
        );
    }

    public function createShipmentTypeUniquenessProductOfferValidatorRule(): ProductOfferValidatorRuleInterface
    {
        return new ShipmentTypeUniquenessProductOfferValidatorRule(
            $this->createErrorAdder(),
            $this->createShipmentTypeExtractor(),
        );
    }

    public function createProductOfferUniquenessValidatorRule(): ProductOfferValidatorRuleInterface
    {
        return new ProductOfferUniquenessValidatorRule($this->createErrorAdder());
    }

    public function createErrorAdder(): ErrorAdderInterface
    {
        return new ErrorAdder();
    }

    public function getShipmentTypeFacade(): ProductOfferShipmentTypeToShipmentTypeFacadeInterface
    {
        return $this->getProvidedDependency(ProductOfferShipmentTypeDependencyProvider::FACADE_SHIPMENT_TYPE);
    }

    public function getProductOfferFacade(): ProductOfferShipmentTypeToProductOfferFacadeInterface
    {
        return $this->getProvidedDependency(ProductOfferShipmentTypeDependencyProvider::FACADE_PRODUCT_OFFER);
    }
}
