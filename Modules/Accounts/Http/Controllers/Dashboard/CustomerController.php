<?php

namespace Modules\Accounts\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\Customer;
use Modules\Accounts\Http\Requests\CustomerRequest;
use Modules\Accounts\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * The repository instance.
     *
     * @var CustomerRepository
     */
    private $repository;

    /**
     * CustomerController constructor.
     *
     * @param CustomerRepository $repository
     */
    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $customers = $this->repository->all();

        return view('accounts::customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('accounts::customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(CustomerRequest $request)
    {
        $customer = $this->repository->create($request->allWithHashedPassword());

        flash(trans('accounts::customers.messages.created'))->success();

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function show(Customer $customer)
    {
        $customer = $this->repository->find($customer);

        return view('accounts::customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function edit(Customer $customer)
    {
        $customer = $this->repository->find($customer);

        return view('accounts::customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerRequest $request
     * @param Customer $customer
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer = $this->repository->update($customer, $request->allWithHashedPassword());

        flash(trans('accounts::customers.messages.updated'))->success();

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Customer $customer)
    {
        $this->repository->delete($customer);

        flash(trans('accounts::customers.messages.deleted'))->error();

        return redirect()->route('dashboard.customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     * @throws Exception
     */
    public function block(Customer $customer)
    {
        $this->repository->block($customer);

        flash(trans('accounts::customers.messages.blocked'))->success();

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return RedirectResponse
     * @throws Exception
     */
    public function unblock(Customer $customer)
    {
        $this->repository->unblock($customer);

        flash(trans('accounts::customers.messages.unblocked'))->success();

        return redirect()->route('dashboard.customers.show', $customer);
    }
}
