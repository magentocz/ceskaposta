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
 * Česká pošta
 * 
 * @category Magentocz 
 * @package Magentocz_Ceskaposta
 * @author Jaromir Muller, jaromir.muller@getready.cz
 */

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('magentocz_ceskaposta/posta')};
CREATE TABLE {$this->getTable('magentocz_ceskaposta/posta')} (
  `posta_id` int(5) NOT NULL AUTO_INCREMENT,
  `psc` int(6) NOT NULL,
  `naz_prov` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `okres` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `adresa` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `v_provozu` tinyint(1) NOT NULL,
  `prodl_doba` tinyint(1) NOT NULL,
  `bankomat` tinyint(1) NOT NULL,
  `parkoviste` tinyint(1) NOT NULL,
  `komplet_servis` tinyint(1) NOT NULL,
  `vikend` tinyint(1) NOT NULL,
  `lokality_prodl` tinyint(1) NOT NULL,
  `vydej_np_od` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `ukl_np_limit` tinyint(1) NOT NULL,
  `psc_np_nahr` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `naz_np_nahr` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `abc_box` tinyint(1) NOT NULL,
  `pondeli_od1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `pondeli_do1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `pondeli_od2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `pondeli_do2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `pondeli_od3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `pondeli_do3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `utery_od1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `utery_do1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `utery_od2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `utery_do2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `utery_od3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `utery_do3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `streda_od1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `streda_do1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `streda_od2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `streda_do2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `streda_od3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `streda_do3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `ctvrtek_od1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `ctvrtek_do1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `ctvrtek_od2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `ctvrtek_do2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `ctvrtek_od3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `ctvrtek_do3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `patek_od1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `patek_do1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `patek_od2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `patek_do2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `patek_od3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `patek_do3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `sobota_od1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `sobota_do1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `sobota_od2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `sobota_do2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `sobota_od3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `sobota_do3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `nedele_od1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `nedele_do1` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `nedele_od2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `nedele_do2` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `nedele_od3` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `nedele_do3` varchar(40) COLLATE utf8_czech_ci NOT NULL,                      
  PRIMARY KEY (`posta_id`),
  INDEX `IDX_PSC` (`psc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
");

$installer->endSetup(); 
