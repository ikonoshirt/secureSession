<?php
class Ikonoshirt_SecureSession_Model_Observer
{
    public function controller_action_predispatch()
    {
        if ((boolean)Mage::getStoreConfig(
            'ikonoshirt_securesession/securesession/renew_session_per_request'
        )
        ) {
            $this->regenerateSessionId();
        }

        if ((boolean)Mage::getStoreConfig(
            'ikonoshirt_securesession/securesession/' .
            'logout_user_if_session_id_in_param'
        )
        ) {
            $this->checkForSessionInUrl();
        }


    }

    /**
     * if the sessionId were changed via $_POST/$_GET, logut the user
     */
    protected function checkForSessionInUrl()
    {
        /* @var Mage_Core_Model_Session */
        $session = Mage::getSingleton('core/session');
        $sidFromParam = Mage::app()->getFrontController()->getRequest()
        ->getParam($session->getSessionIdQueryParam(), false);
        if ($sidFromParam !== false) {
            /* @var $customerSession Mage_Customer_Model_Session */
            $customerSession = Mage::getSingleton('customer/session');
            $customerSession->logout();
        }
    }

    /**
     * regenerate the session id
     */
    protected function regenerateSessionId()
    {
        $session = Mage::getSingleton('core/session');
        $session->renewSession();
    }

    public function customer_customer_authenticated()
    {

        if ((boolean)Mage::getStoreConfig(
            'ikonoshirt_securesession/securesession/' .
            'renew_session_id_after_login'
        )
        ) {
            $this->regenerateSessionId();
        }

    }


}