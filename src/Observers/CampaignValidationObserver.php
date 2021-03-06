<?php

namespace Drivezy\LaravelCampaignManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class CampaignValidationObserver
 * @package Drivezy\LaravelCampaignManager\Observers
 * @author  Yash Devkota <devkotayash4098@gmail.com>
 */
class CampaignValidationObserver extends BaseObserver
{
    /**
     * Required parameters.
     *
     * @var array
     */
    protected $rules = [
        'source_type' => 'required',
        'source_id'   => 'required',
        'master_id'   => 'required',
        'operator'    => 'required',
        'value'       => 'required',
    ];
}
