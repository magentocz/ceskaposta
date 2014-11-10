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
 * Helper.
 * 
 * @category Magentocz 
 * @package Magentocz_Ceskaposta
 * 
 */

class Magentocz_Ceskaposta_Helper_Data extends Mage_Core_Helper_Abstract
{

  protected $_xmlFile = 'http://napostu.cpost.cz/vystupy/napostu.xml';
  
  public function importXML2MySQL() {
    
    $num = 0;

    $xml = simplexml_load_file($this->_xmlFile);

    if ($xml != FALSE) {

      // clean post database first.
      $coll = Mage::getModel('magentocz_ceskaposta/posta')->getCollection();
      foreach ( $coll as $posta ) {
        $posta->delete();
      }

      // import all posts into db
      foreach ($xml->children() AS $child) {

        $name = $child->getName();    

        if ($name == 'row') {

          $posta = Mage::getModel('magentocz_ceskaposta/posta');

          foreach ($child as $a => $b) {
    
            switch ( $a ) {
              case 'PSC':
                $key = strtolower( $a );
                $posta->setData( $key, (int) $b );
                break;
              case 'NAZ_PROV':
              case 'OKRES':
              case 'ADRESA':
              case 'VYDEJ_NP_OD':
              case 'PSC_NP_NAHR':
              case 'NAZ_NP_NAHR':
                $key = strtolower( $a );
                $posta->setData( $key, (string) $b );
                break;
              case 'V_PROVOZU':
              case 'PRODL_DOBA':
              case 'BANKOMAT':
              case 'PARKOVISTE':
              case 'KOMPLET_SERVIS':
              case 'VIKEND':
              case 'LOKALITY_PRODL':
              case 'UKL_NP_LIMIT':
              case 'ABC_BOX':
                $key = strtolower( $a );
                $posta->setData( $key, (int) ($b == 'A') );
                break;
              case 'OTV_DOBA':
                foreach ($b->children() AS $x) {
                  $day = $x->attributes()->name;
                  $den = mb_strtolower($day, 'UTF-8');
                  $den = str_replace(array('ě', 'í', 'č', 'ř', 'ú', 'ý', 'á'), array('e', 'i', 'c', 'r', 'u', 'y', 'a'), $den);
                  
                  // od_do
                  $count = 1;
                  foreach ($x->children() as $doba) {
                    // <od> a <do>
                    $start = (string) $doba->od;
                    $end = (string) $doba->do;

                    $key = strtolower($den . "_od" . $count);
                    $posta->setData( $key, $start );
                   
                    $key = strtolower($den . "_do" . $count);
                    $posta->setData( $key, $end );
                   
                    $count++;
                  }
                }
                break;
              
              default:
                # code...
                break;
            }
          }

          try {
            $posta->save();
            $num++; 
          } catch ( Exception $e ) {
            Mage::logException( $e );
          }
        }
      }
    }

    return $num; 
  }
}
