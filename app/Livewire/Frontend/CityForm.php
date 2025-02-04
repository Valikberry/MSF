<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Libraries\Alert\AlertMessage;
use App\Libraries\Booking\BookingSession;
use App\Models\Branch;
use App\Models\City;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CityForm extends Component
{
    use WithPagination, WithoutUrlPagination;

    public City|null $city = null;
    public int $city_id = 0;
    public int $pagination_no = 12;
    public string $currentUrl = '';

    public function mount(): void
    {
        $this->currentUrl = url('/');

        $slug = Route::current()->parameter('city');
        $this->city = City::where('slug', $slug)->first();
        $this->city_id = $this->city ? $this->city->id : 0;
    }

    #[On('refresh-city')]
    public function refresh(): void
    {

    }

    #[Computed]
    public function cities()
    {
        return City::active()->get();
    }

    #[Computed]
    public function services()
    {
        return $this->getServicesWithPrice();
    }


    public function render()
    {
        $cart = getCart();

        return view('livewire.frontend.city-form', compact(  'cart'));
    }


    /**
     * On City Change
     *
     * @param $cityId
     * @return void
     */
    public function onCityChange($cityId): void
    {
        BookingSession::update(['city_id' => (int) $cityId]);
        $this->city = City::find($cityId);
        $this->js("history.replaceState(null, '', '".$this->currentUrl.($this->city ? '/'.$this->city->slug : '')."');");
    }


    /**
     * Select Branch and Redirect
     *
     * @param int $branchId
     * @return RedirectResponse|void
     */
    public function selectBranch(int $branchId)
    {
        if ($this->city_id == 0) {
            AlertMessage::error(__('Please select city first'));
            return;
        }

        $branch = Branch::with('city', 'company')->find($branchId);

        if (!$branch) {
            AlertMessage::error(__('Service is not available. Please choose another service.'));
            return;
        }

        BookingSession::update([
            'city_id' => $branch->city_id,
            'branch_id' => $branchId,
            'step' => BookingStep::service->value,
        ]);

        return redirect()->route('booking.service', ['city' => $branch->city->slug, 'company' => $branch->company->slug,]);
    }


    /**
     * Get Services with price
     *
     * @return mixed
     */
    private function getServicesWithPrice(): mixed
    {
        if ($this->city_id > 0) {
            return Company::whereHas('branches.services')
                ->select('branches.*', 'companies.id AS id', 'companies.id AS company_id', 'companies.name AS company_name', 'companies.logo AS company_logo')
                ->join('branches', 'companies.id', '=', 'branches.company_id')
                ->where('branches.city_id', $this->city_id)
                ->with(['branches' => function ($query) {
                    $query->with(['services' => function ($query) {
                        $query->select('services.id', 'services.name', 'services.price', 'services.type', 'services.branch_id');
                    }])
                        ->select('branches.id', 'branches.city_id', 'branches.image', 'branches.company_id')
                        ->where('branches.city_id', $this->city_id);
                }])
                ->paginate($this->pagination_no)
                ->through(function ($company) {
                    return $this->getTransformedObject($company);
                });
        }

        return Company::whereHas('branches.services')
            ->select('companies.id AS id', 'companies.id AS company_id', 'companies.name AS company_name', 'companies.logo AS company_logo')
            ->with(['branches' => function ($query) {
                $query->with(['services' => function ($query) {
                    $query->select('services.id', 'services.name', 'services.price', 'services.type', 'services.branch_id');
                }])->select('branches.id', 'branches.image', 'branches.company_id');
            }])
            ->paginate($this->pagination_no)
            ->through(function ($company) {
                return $this->getTransformedObject($company);
            });
    }


    public function getTransformedObject($company): object
    {
        return (object) [
            'company_id' => $company->company_id,
            'company_name' => $company->company_name,
            'company_logo' => $company->company_logo,
            'branch_id' => $company->branches->count() > 0 ? $company->branches->first()->id : null,
            'branch_image' => $company->branches->count() > 0 ? $company->branches->first()->image : null,
            'service_id' => $company->branches?->first()->services->first()->id,
            'service_name' => $company->branches?->first()->services->first()->name,
            'service_price' => $company->branches?->first()->services->first()->price,
            'service_type' => $company->branches?->first()->services->first()->type,
        ];
    }


}






