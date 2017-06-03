<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\DataObject\Copy\Config as CopyConfig;

/**
 * Class Fields used to read the field set file to generate
 * the fields across the system
 * @package Eadesigndev\Checkoutaddressfields\Helper
 */
class Fields extends AbstractHelper
{
    /**
     * @var CopyConfig
     */
    private $copyConfig;

    /**
     * Fields constructor.
     * @param Context $context
     * @param CopyConfig $copyConfig
     */
    public function __construct(Context $context, CopyConfig $copyConfig)
    {
        $this->copyConfig = $copyConfig;
        parent::__construct($context);
    }
}
