<?php
/**
 * Location Redirector plugin for Craft CMS
 *
 * LocationRedirector Controller
 *
 * --snip--
 * Generally speaking, controllers are the middlemen between the front end of the CP/website and your plugin’s
 * services. They contain action methods which handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering post data, saving it on a model,
 * passing the model off to a service, and then responding to the request appropriately depending on the service
 * method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what the method does (for example,
 * actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 * --snip--
 *
 * @author    Luca Jegard
 * @copyright Copyright (c) 2017 Luca Jegard
 * @link      google.com
 * @package   LocationRedirector
 * @since     1.0.0
 */

namespace Craft;

class LocationRedirectorController extends BaseController
{

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     * @access protected
     */
    protected $allowAnonymous = array(
      'actionIndex',
      'actionAddCountry',
      'actionDeleteCountry'
    );

    /**
     * Handle a request going to our plugin's index action URL, e.g.: actions/locationRedirector
     */
    public function actionIndex()
    {
    }
    public function actionAddCountry()
    {
      $this->requirePostRequest();
      //\Kint::dump(craft()->request->getPost('countryId'));
      if( $id = craft()->request->getPost('countryId')) {
        $model = craft()->locationRedirector->newCountry($id);
      }
      $attributes = craft()->request->getPost('attr');
      $model->setAttributes( $attributes );

      if (craft()->locationRedirector->saveCountry($model)) {
            craft()->userSession->setNotice(Craft::t('Country saved.'));
            return $this->redirectToPostedUrl(array('countryId' => $model->getAttribute('id')));
      } else {
          craft()->userSession->setError(Craft::t("Couldn't save country."));
          craft()->urlManager->setRouteVariables(array('attr' => $model));
      }

    }
    public function actionDeleteCountry()
    {
      $this->requirePostRequest();
      $id = craft()->request->getRequiredPost('id');
      craft()->locationRedirector->deleteCountryById($id);
      //$this->returnJson(array('success' => true));
    }
}
