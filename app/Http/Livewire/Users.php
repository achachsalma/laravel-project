<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Livewire;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Users extends PowerGridComponent
{
    use ActionButton;
    public array $name;
    public array $email;

    // protected function getListeners()
    // {
    //     return array_merge(
    //         Button::getListeners(),
    //         [
    //             'rowActionEvent',
    //             'bulkActionEvent',
    //         ]);
    // }

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */
    public function rowActionEvent(array $data): void
    {
        $message = 'You have clicked #' . $data['id'];

        $this->dispatchBrowserEvent('showAlert', ['message' => $message]);
    }
    public function bulkActionEvent(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatchBrowserEvent('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $ids = implode(', ', $this->checkboxValues);

        $this->dispatchBrowserEvent('showAlert', ['message' => 'You have selected IDs: ' . $ids]);
    }
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
                Header::make()
                    ->showToggleColumns()
                    ->showSearchInput(),
                Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }
    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\User>
    */
    public function datasource(): Builder
    {
        return User::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')

           /** Example of custom column using a closure **/
            ->addColumn('name_lower', function (User $model) {
                return strtolower(e($model->name));
            })

            ->addColumn('email')
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (User $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        //User permissions. In a real world project, this would be managed by your system.
        $canCopy = true;

        return [
            Column::make('ID', 'id')
                ->makeInputRange(),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->editOnClick(),

            Column::make('EMAIL', 'email')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->clickToCopy($canCopy)
                ->editOnClick(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),
        ]
;
    }
        /*
    |--------------------------------------------------------------------------
    |  Table header
    |--------------------------------------------------------------------------
    | Configure Action Buttons for your table header.
    |

    */
     /**
     * PowerGrid Header
     *
     * @return array<int, Button>
     */
    public function header(): array
    {
        return [
            Button::add('bulk-demo')
                ->caption(__('Bulk Action'))
                ->class('cursor-pointer block bg-indigo-500 text-white border border-gray-300 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500 dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300')
                ->emit('bulkActionEvent', []),
            Button::add('create')
                ->caption(__('Create'))
                ->class('cursor-pointer px-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded')
                ->openModal('edit', [])
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */

    
    public function actions(): array
    {
       return [
            Button::add('edit')
               ->caption('Edit')
               ->class('bg-indigo-500 hover:bg-indigo-600 cursor-pointer text-white px-3 py-2 m-0.5 text-sm rounded-md')
               ->openModal('create', ['user' => 'id', 'name' => 'name', 'email' => 'email']),
            Button::add('destroy')
                ->caption('Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->openModal('distroy', ['user' => 'id']),
            // Button::make('edit', 'Edit')
            // ->target('')
            // ->route('users', ['user' => 'id']),
            //    Button::make('destroy', 'Delete')
        //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
        //        ->route('users', [])
        //        ->method('delete')
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($user) => $user->id === 1)
                ->hide(),
        ];
    }
    */
    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        User::query()->find($id)->update([
            $field => $value,
        ]);
    }

}