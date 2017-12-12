<?php
/**
 * Location Redirector plugin for Craft CMS
 *
 * Location Redirector Variable
 *
 * --snip--
 * Craft allows plugins to provide their own template variables, accessible from the {{ craft }} global variable
 * (e.g. {{ craft.pluginName }}).
 *
 * https://craftcms.com/docs/plugins/variables
 * --snip--
 *
 * @author    Luca Jegard
 * @copyright Copyright (c) 2017 Luca Jegard
 * @link      google.com
 * @package   LocationRedirector
 * @since     1.0.0
 */

namespace Craft;

class LocationRedirectorVariable
{
    /**
     * Whatever you want to output to a Twig template can go into a Variable method. You can have as many variable
     * functions as you want.  From any Twig template, call it like this:
     *
     *     {{ craft.locationRedirector.exampleVariable }}
     *
     * Or, if your variable requires input from Twig:
     *
     *     {{ craft.locationRedirector.exampleVariable(twigValue) }}
     */
    public function getCountryNames(){
      //include_once(dirname(__FILE__)."/geocity/geoipcity.inc");
      //include_once(dirname(__FILE__)."/geocity/geoipregionvars.php");
      $giCity = geoip_open(dirname(__FILE__)."/geocity/GeoLiteCity.dat", GEOIP_STANDARD);
      return $giCity->GEOIP_COUNTRY_NAMES;
    }
    public function getAllCountries()
    {
      return craft()->locationRedirector->getAllCountries();
    }
    public function exampleVariable($optional = null)
    {
        return "And away we go to the Twig template...";
    }
}
