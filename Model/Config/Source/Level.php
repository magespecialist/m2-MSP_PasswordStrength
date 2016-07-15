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

namespace MSP\PasswordStrength\Model\Config\Source;


use Magento\Framework\Option\ArrayInterface;
use MSP\PasswordStrength\Helper\Data;

class Level implements ArrayInterface
{
    protected $helperData;

    public function __construct(
        Data $helperData
    ) {
        $this->helperData = $helperData;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $res = [];
        for ($i = 0; $i < 5; $i++) {
            $res[] = ['value' => $i, 'label' => $this->helperData->getScoreDescription($i)];
        }

        return $res;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $res = [];
        for ($i = 0; $i < 5; $i++) {
            $res[$i] = $this->helperData->getScoreDescription($i);
        }

        return $res;
    }
}
