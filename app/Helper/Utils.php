<?php

namespace App\Helper;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Utils
{
    /**
    * Generate a unique slug for a model instance based on the name
    *
    * @param  string  $model  The name of the model
    * @param  string  $name   The name to generate a slug from
    * @return string          The generated slug
    */
    public static function generateSlug($model, $name)
    {
        // Generate a slug from the name
        $slug = Str::slug($name);
        $slug_base = $slug;

        // Check if the slug already exists in the database
        $existingModel = $model::where('slug', $slug)->first();

        // If it does, add a counter to the end of the slug until it's unique
        $counter = 1;
        while ($existingModel) {
            $slug = $slug_base . '_' . $counter;
            $counter++;
            $existingModel = $model::where('slug', $slug)->first();
        }

        // Return the unique slug
        return $slug;
    }

    /**
    * Get a model instance by its unique slug
    *
    * @param  string  $model  The name of the model
    * @param  string  $slug   The unique slug to search for
    * @return mixed           The model instance, or null if not found
    */
    public static function getBySlug($model, $slug)
    {
        // Search for the model instance by its unique slug
        $model_by_slug =$model::where('slug', $slug)->first();

        // Return the model instance, or null if not found
        return $model_by_slug;
    }

    /**
    * Get the currently authenticated user
    *
    * @return mixed  The authenticated user, or null if not authenticated
    */
    public static function getUser(){
        // Get the currently authenticated user
        return Auth::user();
    }

    /**
    * Get the portfolio of the current user
    *
    * @return mixed
    */
    public static function getMyPortfolio()
    {
        // Get the current user
        $user = self::getUser();

        // Retrieve the portfolio of the user
        $portfolio = Portfolio::where('user_id', $user->id)->first();

        return $portfolio;
    }

    /**
    * Get items by portfolio
    *
    * @param mixed $model The model to retrieve items from
    *
    * @return mixed
    */
    public static function getByPortfolio($model)
    {
        // Get the portfolio of the current user
        $portfolio = self::getMyPortfolio();

        // Retrieve all items belonging to the portfolio
        $items = $model::where('portfolio_id', $portfolio->id)->get();

        return $items;
    }


    /**
    * Store an item in storage and update the form data accordingly.
    *
    * NB-> The attribute_key must be equal to the item_key for both the item and form_data.
    *
    * @param $item The item to be stored.
    * @param $form_data The form data containing the new item and other information.
    * @param $attribute_key The key used to identify the item in both the form_data and item.
    * @param $path_storage The path to the storage location for the item.
    * @return array form data.
    */
    public static function itemStorage($item, $form_data, $attribute_key, $path_storage)
    {
        self::deleteItemStorage($item);
        //store and put new value than attribute
        $form_data[$attribute_key] = Storage::put($path_storage, $form_data[$attribute_key]);
        return $form_data[$attribute_key];
    }

    /**
    * Delete item from storage
    *
    * @param  mixed  $item  The item to be deleted from storage
    *
    * @return void
    */
    public static function deleteItemStorage($item)
    {
        // Check if the item exists before attempting to delete it
        if ($item) Storage::delete($item);
    }

    /**
    * Synchronizes an attribute of an item with data from a form.
    *
    * NB-> The attribute_key must be equal to the item_key for both the item and form_data.
    *
    * @param mixed $item The item to synchronize.
    * @param string $attribute_key The key of the attribute to synchronize.
    * @param array $form_data An associative array of form data.
    */
    public static function syncronize($item, $attribute_key, $form_data)
    {
        // Build the method name based on the attribute key.
        $methodName = $attribute_key;
        // Check if the item has the method with the generated name.
        if (method_exists($item, $methodName)) {
            // Check if the form data contains the key for the attribute to synchronize.
            if (array_key_exists($attribute_key, $form_data))
            {
                // Get the data for the attribute from the form data.
                $attributeData = $form_data[$attribute_key];
                // Call the method on the item and synchronize the data with it.
                $item->$methodName()->sync($attributeData);
            } else
                $item->$methodName()->sync([]);
        }
    }

}
