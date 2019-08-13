<?php

namespace Drivezy\LaravelMarketing\Libraries\Validations;

use Drivezy\LaravelMarketing\Libraries\CouponDataTrait;
use Drivezy\LaravelUtility\Library\DateUtil;

/**
 * Class TermCampaignValidation
 * @package Drivezy\LaravelMarketing\Libraries\Validations
 * @author Yash Devkota <devkotayash4098@gmail.com>
 */
class TermCampaignValidation extends BaseCampaignValidation {
    use CouponDataTrait;

    /**
     * Timings related to the campaign/coupon
     *
     * @var object
     */
    private $term = false;

    /**
     * Sets operand for comparision.
     */
    protected function setOperand () {
        $this->term = $this->getCouponData('term');
        if ( !count($this->term) ) return $this->operand = true;

        $this->operand = $this->isCampaignTimeValid();
        if ( !$this->operand ) return;

        return $this->operand = $this->isAssetTimeValid();
    }

    /**
     * Checks if campaign is valid for current time.
     *
     * @return bool
     */
    private function isCampaignTimeValid () {
        $currentTime = DateUtil::getDateTime();

        return ( $this->term->valid_from <= $currentTime && $this->term->valid_to >= $currentTime );
    }

    /**
     * Checks if campaign is valid for time of asset acquisition.
     *
     * @return bool
     */
    private function isAssetTimeValid () {
        if ( !$this->term->start_time || !$this->term->end_time ) return true;

        return ( $this->term->start_time <= $this->request->start_time && $this->term->end_time >= $this->request->end_time );
    }
}