<?php

namespace App\Livewire\Frontend;

use App\Enums\BookingStep;
use App\Libraries\Alert\AlertMessage;
use App\Libraries\Booking\BookingSession;
use App\Models\Branch;
use App\Models\Service;
use App\Rules\Frontend\IsValidPhoneNo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Revolution\Google\Sheets\Facades\Sheets;

class ServiceForm extends Component
{
    public bool $serviceModal = false;
    public bool $contactModal = false;
    public array $hideContacts = [];
    public array $services = [];
    public float $total = 0;
    public string $contact_no = '';
    public string $citySlug = '';
    public string $companySlug = '';

    #[Computed]
    public function branch()
    {
        return Branch::select('*', 'companies.id as company_id', 'companies.name as company_name', 'branches.id as id')
            ->join('companies', 'branches.company_id', 'companies.id')
            ->join('cities', 'branches.city_id', 'cities.id')
            ->with('services')
            ->where('cities.slug', $this->citySlug)
            ->where('companies.slug', $this->companySlug)
            ->first();
    }

    public function mount(string $citySlug, string $companySlug, int $branchId)
    {
        $this->citySlug = $citySlug;
        $this->companySlug = $companySlug;
        $this->setCartQuantity($branchId);
    }

    public function render()
    {
        //dd($this->branch());

        return view('livewire.frontend.service-form');
    }

    public function openServiceModal(): void
    {
        $this->dispatch('openMoverModal');
        $this->serviceModal = true;
    }

    #[On('closeServiceModal')]
    public function closeServiceModal(): void
    {
        $this->dispatch('closeMoverModal');
        $this->serviceModal = false;
    }

    public function openContactModal(): void
    {
        $this->contactModal = true;
    }

    #[On('closeContactModal')]
    public function closeContactModal(): void
    {
        $this->contactModal = false;
    }


    /**
     * Increase Service Quantity
     *
     * @param int $serviceId
     * @return void
     */
    public function increaseQuantity(int $serviceId): void
    {
        $newServices = [];
        $hasService = false;

        foreach ($this->services as $service) {
            $newService = $service;
            if ($service['service_id'] == $serviceId) {
                ++$newService['quantity'];
                $newService['total'] = $newService['quantity'] * ($newService['price'] ?? 0);
                $hasService = true;
            }
            $newServices[] = $newService;
        }

        if (!$hasService) {
            $service = Service::with('branch', 'branch.city', 'branch.company')->findOrFail($serviceId);
            if ($service) {
                $newServices[] = [
                    'service_id' => $service->id,
                    'service_name' => $service->name,
                    'service_type' => $service->type,
                    'branch_id' => $service->branch->id,
                    'city_id' => $service->branch->city->id,
                    'city_name' => $service->branch->city->name,
                    'company_id' => $service->branch->company->id,
                    'company_name' => $service->branch->company->name,
                    'quantity' => 1,
                    'price' => $service->price,
                    'total' => $service->price,
                ];
            }
        }

        $this->services = $newServices;
    }


    /**
     * Decrease Service Quantity
     *
     * @param int $serviceId
     * @return void
     */
    public function decreaseQuantity(int $serviceId): void
    {
        $newServices = [];

        foreach ($this->services as $service) {
            $newService = $service;
            if ($service['service_id'] == $serviceId) {
                if ($newService['quantity'] > 0) {
                    --$newService['quantity'];
                }
                $newService['total'] = $newService['quantity'] * ($newService['price'] ?? 0);
            }
            $newServices[] = $newService;
        }

        $this->services = $newServices;
    }


    /**
     * Add to Cart
     *
     * @return void
     */
    public function addToCart(): void
    {
        if (!$this->hasServiceQuantity()) {
            AlertMessage::error(__('Service quantity is required'));
            return;
        }

        $newCartItems = mergeWithCartItems(getCart(), $this->services);

        $this->closeServiceModal();

        BookingSession::update(['services' => $newCartItems]);

        $this->dispatch('openCartModal');
    }

    /**
     * Add to Contact Sheet
     *
     * @return void
     * @throws ValidationException
     */
    public function addToContactSheet(): void
    {
        $this->validate(['contact_no' => ['required', 'max:20', 'min:7', new IsValidPhoneNo()]], [
            'contact_no.required' => __('Contact number is required'),
            'contact_no.max' => __('Contact number is too long'),
            'contact_no.min' => __('Contact number is too short'),
        ]);

        $contactSheetId = setting('contact_sheet_id');
        $contactSheetName = setting('contact_sheet_name');

        if (strlen($contactSheetId) > 0 && strlen($contactSheetName) > 0) {
            try {
                $sheetList = Sheets::spreadsheet($contactSheetId)
                    ->sheetList();

                if (!in_array($contactSheetName, $sheetList)) {
                    Sheets::spreadsheet($contactSheetId)->addSheet($contactSheetName);
                }

                Sheets::spreadsheet($contactSheetId)
                    ->sheet($contactSheetName)
                    ->append([[$this->contact_no]]);

                session()->flash('contact_updated', trans('Thank you! The number :contact_no has been successfully added for a callback. We will be in touch with you shortly.', ['contact_no' => $this->contact_no]));
                $this->contact_no = '';

            } catch (\Exception $exception) {
                throw ValidationException::withMessages(['contact_no' => $exception->getMessage()]);
            }
        } else {
            throw ValidationException::withMessages(['contact_no' => trans('There is some technical issues. Please contact administrator.')]);
        }
    }


    /**
     * Go to next form
     *
     * @return RedirectResponse|null
     */
    public function goToContactForm()
    {
        if (getCartTotalQuantity() == 0) {
            AlertMessage::error(__('Cart is empty'));
            return null;
        }

        if (getBookingStep() < BookingStep::contact->value) {
            BookingSession::update(['step' => BookingStep::contact->value]);
        }

        return redirect()->route('booking.process');
    }


    private function setCartQuantity(int $branchId): void
    {
        foreach (getCart() as $item) {
            if ($item['branch_id'] == $branchId) {
                $this->services[] = $item;
            }
        }
    }

    protected function hasServiceQuantity(): bool
    {
        if (count($this->services) == 0) {
            return false;
        }

        foreach ($this->services as $service) {
            if (isset($service['quantity']) && $service['quantity'] > 0) {
                return true;
            }
        }

        return false;
    }

    public function toggleContacts($index): void
    {
        if (!in_array($index, $this->hideContacts)) {
            $this->hideContacts[] = $index;
        } else {
            $this->hideContacts = array_filter($this->hideContacts, fn($contact) => ($contact != $index));
        }
    }




}






