<?php
/**
 * Location Redirector plugin for Craft CMS
 *
 * LocationRedirector Model
 *
 * --snip--
 * Models are containers for data. Just about every time information is passed between services, controllers, and
 * templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 * --snip--
 *
 * @author    Luca Jegard
 * @copyright Copyright (c) 2017 Luca Jegard
 * @link      google.com
 * @package   LocationRedirector
 * @since     1.0.0
 */

namespace Craft;

class LocationRedirectorModel extends BaseModel
{
    /**
     * Defines this model's attributes.
     *
     * @return array
     */
    protected function defineAttributes()
    {
        return array_merge(parent::defineAttributes(), array(
            'id' => AttributeType::Number,
            'countryName' => AttributeType::String,
            'redirectUrl' => AttributeType::String
        ));
    }

}
