<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::latest()->get();

        return view('admin.services.index', compact('services'));
    }


    public function create()
    {
        return view('admin.services.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required|max:200',
            'icon'          => 'required',
            'service_order' => 'required',
        ]);

        $service = new Service();
        $service->title         = $request->title;
        $service->description   = $request->description;
        $service->icon          = $request->icon;
        $service->service_order = $request->service_order;
        $service->save();

        Toastr::success('message', 'Service created successfully.');
        return redirect()->route('admin.services.index');
    }


    public function edit(Service $service)
    {
        $service = Service::findOrFail($service->id);

        return view('admin.services.edit', compact('service'));
    }


    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required|max:200',
            'icon'          => 'required',
            'service_order' => 'required',
        ]);

        $service = Service::findOrFail($service->id);
        $service->title         = $request->title;
        $service->description   = $request->description;
        $service->icon          = $request->icon;
        $service->service_order = $request->service_order;
        $service->save();

        Toastr::success('message', 'Service updated successfully.');
        return redirect()->route('admin.services.index');
    }


    public function destroy(Service $service)
    {
        $service = Service::findOrFail($service->id);
        $service->delete();

        Toastr::success('message', 'Service deleted successfully.');
        return back();
    }
}
