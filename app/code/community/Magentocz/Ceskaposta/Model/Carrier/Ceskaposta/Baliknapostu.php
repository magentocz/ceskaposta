<?php
/** 
 * Magento CZ Module
 * 
 * NOTICE OF LICENSE 
 * 
 * This source file is subject to the Open Software License (OSL 3.0) 
 * that is bundled with this package in the file LICENSE.txt. 
 * It is also available through the world-wide-web at this URL: 
 * http://opensource.org/licenses/osl-3.0.php 
 * If you did of the license and are unable to 
 * obtain it through the world-wide-web, please send an email 
 * to magentocz@gmail.com so we can send you a copy immediately. 
 * 
 * @copyright Copyright (c) 2014 GetReady s.r.o. (https://getready.cz)
 * 
 */
/** 
 * Balík na poštu od České pošty
 * 
 * @category Magentocz 
 * @package Magentocz_Ceskaposta
 * @author Jaromír Müller, https://twitter.com/jaromirmuller
 */
class Magentocz_Ceskaposta_Model_Carrier_Ceskaposta_Baliknapostu
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{

    protected $_code = 'magentoczceskapostabaliknapostu';

    /**
     *
     * @param Mage_Shipping_Model_Rate_Request $data
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $result = Mage::getModel('shipping/rate_result');
        if ($this->getConfigData('type') == 'O') { // per order
            $shippingPrice = $this->getConfigData('price');
        } elseif ($this->getConfigData('type') == 'I') { // per item
            $shippingPrice = $request->getPackageQty() * $this->getConfigData('price');

            if ($request->getAllItems()) {
                foreach ($request->getAllItems() as $item) {
                    if ($item->getFreeShipping() && !$item->getProduct()->getTypeInstance()->isVirtual()) {
                        $shippingPrice -= $item->getQty() * $this->getConfigData('price');
                    }
                }
            }
        } else {
            $shippingPrice = false;
        }

        $shippingPrice = $this->getFinalPriceWithHandlingFee($shippingPrice);

        if ($shippingPrice !== false) {
            $method = Mage::getModel('shipping/rate_result_method');

            $method->setCarrier('magentoczceskapostabaliknapostu');
            $method->setCarrierTitle($this->getConfigData('title'));

            $method->setMethod('standard');
            $method->setMethodTitle($this->getConfigData('name'));

            if ($request->getFreeShipping() === true) {
                $shippingPrice = '0.00';
            }

            $method->setPrice($shippingPrice);
            $method->setCost($shippingPrice);

            $result->append($method);
        }

        return $result;
    }
    

    public function getAllowedMethods()
    {
        return array( 'standard' =>$this->getConfigData('name'));
    }

}
