<?php

/**
 * Class Thiagoprz_Birthdaycoupon_Model_Rule_Condition_Customer_Birthday
 * Main model containing all business rules
 */
class Thiagoprz_Birthdaycoupon_Model_Rule_Condition_Customer_Birthday extends Mage_SalesRule_Model_Rule_Condition_Product_Found
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setType('thiagoprz_birthdaycoupon/rule_condition_customer_birthday');
    }

    /**
     * Returns options for dropdown in adminhtml
     * @return Thiagoprz_Birthdaycoupon_Model_Rule_Condition_Customer_Birthday
     */
    public function loadValueOptions()
    {
        $this->setValueOption(array(
            1 => Mage::helper('thiagoprz_birthdaycoupon')->__(' is a birthday person.'),
            0 => Mage::helper('thiagoprz_birthdaycoupon')->__(' not a birthday person.'),
        ));
        return $this;
    }

    /**
     * HTML retorno
     * @return string
     */
    public function asHtml()
    {
        $html = $this->getTypeElement()->getHtml() .
            Mage::helper('salesrule')->__("Customer %s", $this->getValueElement()
                ->getHtml());
        if ($this->getId() != '1') {
            $html .= $this->getRemoveLinkHtml();
        }
        return $html;
    }

    /**
     * Returns validation, if is a birthday person or not
     * @param Varien_Object $object
     * @return boolean
     */
    public function validate(Varien_Object $object)
    {
        $cliente = $object->getQuote()->getCustomer();
        $nascimento = new Datetime($cliente->getDob());
        return $nascimento->format('md') == date('md');
    }
}