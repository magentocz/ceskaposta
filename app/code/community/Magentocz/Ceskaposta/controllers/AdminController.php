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
 * 
 * @category Magentocz 
 * @package Magentocz_Ceskaposta
 * @author Jaromir Muller, jaromir.muller@getready.cz
 */
class Magentocz_Ceskaposta_AdminController extends Mage_Adminhtml_Controller_Action
{
  /**
   *
   */
  public function ajaxImportDataAction() {
    $result = array();
    try {
      $number = Mage::helper('magentocz_ceskaposta')->importXML2MySQL();
      $result['ok'] = true;
      $result['number'] = $number;
      $result['message'] = $this->__('%s posts have been imported', $result['number']);
    } catch (Exception $e) {
      $result['ok'] = false;
      $result['message'] = $this->__('There was an error during post import operation.');
    }

    $this->getResponse()->setHeader('Content-type', 'application/json');
    $this->getResponse()->setBody( json_encode( $result ) );
  }
}
