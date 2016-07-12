<?php
/**
 * Extending Mage_SalesRule_Model_Rule_Condition_Product to allow condition based on product stock
 *
 * @category   Mage
 * @package    Mage_Customer
 * @author     Thomas Birke <tbirke@netextreme.de>
 */
class Quafzi_StockSalesRule_Model_Rule_Condition_Product
    extends Mage_SalesRule_Model_Rule_Condition_Product
{
    /**
     * Add special attributes
     *
     * @param array $attributes
     */
    protected function _addSpecialAttributes(array &$attributes)
    {
        parent::_addSpecialAttributes($attributes);
        $attributes['stock_amount'] = Mage::helper('catalog')->__('Stock Availability');
    }

    /**
     * Validate Product Rule Condition
     *
     * @param Varien_Object $object
     *
     * @return bool
     */
    public function validate(Varien_Object $object)
    {
        /** @var Mage_Catalog_Model_Product $product */
        $product = $object->getProduct();
        if (!($product instanceof Mage_Catalog_Model_Product)) {
            $product = Mage::getModel('catalog/product')->load($object->getProductId());
        }

        $product->setStockAmount($object->getProduct()->getStockItem()->getQty());

        return parent::validate($object);
    }
}
