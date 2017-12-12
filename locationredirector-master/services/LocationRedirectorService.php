<?php
/**
 * Location Redirector plugin for Craft CMS
 *
 * LocationRedirector Service
 *
 * --snip--
 * All of your plugin’s business logic should go in services, including saving data, retrieving data, etc. They
 * provide APIs that your controllers, template variables, and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 * --snip--
 *
 * @author    Luca Jegard
 * @copyright Copyright (c) 2017 Luca Jegard
 * @link      google.com
 * @package   LocationRedirector
 * @since     1.0.0
 */

namespace Craft;

class LocationRedirectorService extends BaseApplicationComponent
{
    protected $redirectorRecord;
    /**
     * Create a new instance of the Cocktail Recpies Service.
     * Constructor allows IngredientRecord dependency to be injected to assist with unit testing.
     *
     * @param @ingredientRecord IngredientRecord The ingredient record to access the database
     */
     public function __construct($redirectorRecord = null)
     {
       $this->redirectorRecord = $redirectorRecord;
       if(is_null($this->redirectorRecord)){
         $this->redirectorRecord = LocationRedirectorRecord::model();
       }
     }
    /**
     * This function can literally be anything you want, and you can have as many service functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     craft()->locationRedirector->exampleService()
     */
    public function exampleService()
    {
    }
    /**
     * Get all cpuntries from the database.
     *
     * @return array
     */
    public function getAllCountries()
    {
      $records = $this->redirectorRecord->findAll(array('order' => 't.countryName'));

      return LocationRedirectorModel::populateModels($records, 'id');
    }
    public function newCountry($attributes = array())
    {
      $model = new LocationRedirectorModel();
      $model->setAttributes($attributes);

      return $model;
    }
    public function getCountryById($id)
    {
      if ($record = $this->redirectorRecord->findByPk($id)) {
          return LocationRedirectorModel::populateModel($record);
      }
    }
    public function saveCountry(LocationRedirectorModel &$model)
    {
        if ($id = $model->getAttribute('id')) {
            if (null === ($record = $this->redirectorRecord->findByPk($id))) {
                throw new Exception(Craft::t('Can\'t find country with ID "{id}"', array('id' => $id)));
            }
        } else {
            //\Kint::dump( $this->redirectorRecord );
            $record = $this->redirectorRecord->create();
        }
        $record->setAttributes($model->getAttributes());
        if ($record->save()) {
            // update id on model (for new records)
            $model->setAttribute('id', $record->getAttribute('id'));
            return true;
        } else {
            $model->addErrors($record->getErrors());
            return false;
        }
    }
    public function deleteCountryById($id)
    {
      return $this->redirectorRecord->deleteByPk($id);
    }
}
