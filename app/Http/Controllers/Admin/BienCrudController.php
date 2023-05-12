<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BienRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BienCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BienCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Bien::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bien');
        CRUD::setEntityNameStrings('bien', 'biens');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('nom');
        CRUD::column('description');
        //upload image and specify size
        CRUD::addColumn([
            'label' => "Image de bien",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'disk' => 'local',
            'width' => '100px',
            'height' => '150px',
        ]);
 
        CRUD::column('prix');
        CRUD::column('superficie');
        CRUD::column('type');
        CRUD::column('user_id');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BienRequest::class);

        CRUD::field('nom');
        CRUD::field('description');
        //upload more than one image
        CRUD::addField([
            'label' => "Image de bien",
            'name' => "image",
            'type' => 'upload',
            'upload' => true,
            'disk' => 'local',
            'rules' => 'image',
            'validation' => [
               'messages' => [
               'image' => 'Le fichier doit être une image',
        ],
    ],
        ]);
        CRUD::field('prix');
        CRUD::field('superficie');
        //type enum
        CRUD::addField([
            'name' => 'type',
            'label' => 'Type de bien',
            'type' => 'enum',
            'options' => ['Appartement' => 'Appartement', 'Maison' => 'Maison', 'Terrain' => 'Terrain', 'Villa' => 'Villa'],
            'allows_null' => false,
            'default' => 'Appartement',
        ]);
        CRUD::field('user_id');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
