<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v16/errors/reach_plan_error.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V16\Errors;

class ReachPlanError
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�
6google/ads/googleads/v16/errors/reach_plan_error.protogoogle.ads.googleads.v16.errors"�
ReachPlanErrorEnum"�
ReachPlanError
UNSPECIFIED 
UNKNOWN!
NOT_FORECASTABLE_MISSING_RATE)
%NOT_FORECASTABLE_NOT_ENOUGH_INVENTORY(
$NOT_FORECASTABLE_ACCOUNT_NOT_ENABLEDB�
#com.google.ads.googleads.v16.errorsBReachPlanErrorProtoPZEgoogle.golang.org/genproto/googleapis/ads/googleads/v16/errors;errors�GAA�Google.Ads.GoogleAds.V16.Errors�Google\\Ads\\GoogleAds\\V16\\Errors�#Google::Ads::GoogleAds::V16::Errorsbproto3'
        , true);
        static::$is_initialized = true;
    }
}

