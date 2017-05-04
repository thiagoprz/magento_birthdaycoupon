<?php

/**
 * Class Thiagoprz_Birthdaycoupon_Model_Observer
 * Observer that adds the new set of rules to work with birthday condition in promotions
 */
class Thiagoprz_Birthdaycoupon_Model_Observer
{

    /**
     * Adds birthday condition to the existing promotion conditions
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addBirthdayCondition(Varien_Event_Observer $observer)
    {
        $birthdayCondition = array(
            array(
                'value' => 'thiagoprz_birthdaycoupon/rule_condition_customer_birthday',
                'label' => Mage::helper('thiagoprz_birthdaycoupon')->__('Birthday Person'),
            ),
        );

        // Gets the already existing conditions and joins with the Birthday condition
        $additional = $observer->getAdditional();
        $conditions = (array)$additional->getConditions();
        $conditions = array_merge_recursive($conditions, $birthdayCondition);
        $additional->setConditions($conditions);
        $observer->setAdditional($additional);
        return $this;
    }
}