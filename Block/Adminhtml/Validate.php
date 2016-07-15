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

namespace MSP\PasswordStrength\Block\Adminhtml;

use Magento\Framework\Json\EncoderInterface;
use Magento\Backend\Block\Template;
use MSP\PasswordStrength\Model\Config\Source\Level;
use MSP\PasswordStrength\Helper\Data;

class Validate extends Template
{
    protected $level;
    protected $encoderInterface;
    protected $helperData;

    public function __construct(
        Template\Context $context,
        Level $level,
        EncoderInterface $encoderInterface,
        Data $helperData,
        array $data = []
    ) {
        $this->level = $level;
        $this->encoderInterface = $encoderInterface;
        $this->helperData = $helperData;

        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        if ($this->helperData->getEnabledBackend()) {
            return parent::_toHtml();
        }

        return '';
    }

    /**
     * Get security levels
     * @return string
     */
    public function getStengthLevelsJs()
    {
        $levels = $this->level->toArray();

        foreach ($levels as $key => &$value) {
            $value = __('Strength: <strong>%1</strong>', [$value]);
        }

        return $this->encoderInterface->encode($levels);
    }

    /**
     * Get minimum security level
     * @return int
     */
    public function getMinLevel()
    {
        return $this->helperData->getMinlevelBackend();
    }
}
