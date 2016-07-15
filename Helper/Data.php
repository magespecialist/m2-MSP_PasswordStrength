<?php
/**
 * IDEALIAGroup srl
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@idealiagroup.com so we can send you a copy immediately.
 *
 * @category   MSP
 * @package    MSP_PasswordStrength
 * @copyright  Copyright (c) 2016 IDEALIAGroup srl (http://www.idealiagroup.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


namespace MSP\PasswordStrength\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const XML_PATH_GENERAL_ENABLED_BACKEND = 'msp_securitysuite/passwordstrength/enabled_backend';
    const XML_PATH_GENERAL_ENABLED_FRONTEND = 'msp_securitysuite/passwordstrength/enabled_frontend';

    const XML_PATH_GENERAL_MINLEVEL_BACKEND = 'msp_securitysuite/passwordstrength/min_level_backend';
    const XML_PATH_GENERAL_MINLEVEL_FRONTEND = 'msp_securitysuite/passwordstrength/min_level_frontend';

    protected $scopeConfigInterface;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfigInterface
    ) {
        $this->scopeConfigInterface = $scopeConfigInterface;

        parent::__construct($context);
    }

    /**
     * Get score descriotion
     * @param $score
     * @return string
     */
    public function getScoreDescription($score)
    {
        switch ($score) {
            case 0: return __('Not secure');
            case 1: return __('Weak');
            case 2: return __('So-so');
            case 3: return __('Good');
        }

        return __('Perfect!');
    }

    /**
     * Return true if module is enabled on frontend
     * @return bool
     */
    public function getEnabledFrontend()
    {
        return (bool) $this->scopeConfigInterface->getValue(self::XML_PATH_GENERAL_ENABLED_FRONTEND);
    }

    /**
     * Return true if module is enabled on frontend
     * @return bool
     */
    public function getEnabledBackend()
    {
        return (bool) $this->scopeConfigInterface->getValue(self::XML_PATH_GENERAL_ENABLED_BACKEND);
    }

    /**
     * Return minimum security level required for frontend
     * @return int
     */
    public function getMinlevelFrontend()
    {
        return intval($this->scopeConfigInterface->getValue(self::XML_PATH_GENERAL_MINLEVEL_FRONTEND));
    }

    /**
     * Return minimum security level required for backend
     * @return int
     */
    public function getMinlevelBackend()
    {
        return intval($this->scopeConfigInterface->getValue(self::XML_PATH_GENERAL_MINLEVEL_BACKEND));
    }
}
