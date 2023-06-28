<?php

    use App\Http\Requests\ItemEssentialPatchRequest;
    use App\Http\Requests\ItemRequest;
    use App\Http\Service\ItemService;
    use App\Models\BuildingInfo;
    use App\Models\Item;
    use App\Models\User;
    use App\Models\UserCategory;
    use App\Models\Warehouse;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\Facades\Route;
    use Inertia\Inertia;
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', function () {
        return Inertia::render('Auth/Login', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    });

    Route::get('/dashboard', function () {
        return Inertia::render(
            'Dashboard',
            [
                "UserCategory"    =>  UserCategory::all(),
                "Items" => ItemService::getItemWithActiveBuildInfo(),
            ]
        );
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/BuildInfoList/{page?}', function ($page = 1) {
        // ページネーションが利かないのでリゾルバで解決
        Paginator::currentPageResolver(function() use ($page){
            return $page;
        });
        return Inertia::render(
            'BuildInfoList',
            [
                "UserCategory"    =>  UserCategory::all(),
                "Items" => Item::with(['wood_species','unit','warehouse'])->get(),
                "BulidInfoList" => BuildingInfo::with(['user', 'building_info_details'])->forPage($page)->paginate()
            ]
        );
    })->middleware(['auth', 'verified'])->name('BuildInfoList');

    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'master'], function () {
        Route::get('/Users', function () {
            return Inertia::render(
                'Master/Users',
                [
                    "Items" => Item::with(['wood_species','unit','warehouse'])->get(),
                    "Users" => User::with(['user_category'])->get()
                ]
            );
        })->name('UsersMaster');

        Route::get('/Items', function () {
            return Inertia::render(
                'Master/Items',
                [
                    "Items" => Item::with(['wood_species','unit','warehouse'])->get()
                ]
            );
        })->name('ItemsMaster');

        Route::patch('/Items', function (ItemRequest $request) {
            $data = $request->validated();
            DB::beginTransaction();
            foreach ($data['items'] as $item) {
                Item::where(['id' => $item['id']])->update(['essential_quantity' => $item['essential_quantity']]);
            }
            DB::commit();
            return redirect()->route('ItemsMaster');
        })->name('ItemsMaster.patch');

        Route::patch('/Items/essential', function (ItemEssentialPatchRequest $request) {
            $data = $request->validated();
            ItemService::modifyEssential($data['items']);
            return redirect()->route('ItemsMaster');
        })->name('ItemsMaster.essential.patch');


        Route::get('/Warehouse', function () {
            return Inertia::render(
                'Master/Warehouse',
                [
                    "Items" => Item::with(['wood_species','unit','warehouse'])->get(),
                    "Warehouses" => Warehouse::all()
                ]
            );
        })->name('WarehouseMaster');
    });

    require __DIR__.'/auth.php';
