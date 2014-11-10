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
class Magentocz_Ceskaposta_Block_Adminhtml_System_Config_Form_Button_Import extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('magentocz/ceskaposta/system/config/button/import.phtml');
    }
 
    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }
 
    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getAjaxImportUrl()
    {
        return $this->getUrl('magentocz_ceskaposta/admin/ajaxImportData');
    }
 
    public function getButtonId() {
      return 'magentocz_ceskaposta_napostu_import';
    }

    /**
     * Generate button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
            'id'        => $this->getButtonId(),
            'label'     => $this->helper('magentocz_ceskaposta')->__('Import'),
            'onclick'   => 'javascript: Magentocz.Ceskaposta.importData(); return false;'
        ));
 
        return $button->toHtml();
    }

    public function countPosts() {
      return Mage::getModel('magentocz_ceskaposta/posta')->getCollection()->count();
    }
}
