<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;
use App\Utilities\Pagination;

class ServicesController extends Controller
{
    use Pagination;

    /**
     * @var Service
     */
    private $service;

    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     * ServicesController constructor.
     *
     * @param Service           $service
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(Service $service, ServiceRepository $serviceRepository)
    {
        $this->service = $service;
        $this->serviceRepository = $serviceRepository;
    }

    public function showNewServiceForm()
    {
        return view('sections.admin.create-service');
    }

    public function showServices()
    {
        return view('sections.admin.services');
    }

    public function showService()
    {
        return view('sections.admin.service');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('page', 'quantity')) {
                if ($request->has('search')) {
                    $services = $this->serviceRepository->search(
                        $request->get('search'), $request->input('quantity', 10)
                    );
                } else {
                    $services = $this->serviceRepository->pagination($request->input('quantity'));
                }
                $response = $this->makePaginationArray($services);
                return response()->json($response);
            }
            $services = $this->serviceRepository->getAll();
            return response()->json(['services' => $services]);
        }
        return redirect()->route('dashboard.start');
    }

    public function show(Request $request, Service $service)
    {
        if ($request->ajax()) {
            $response = [
                'service' => $service
            ];
            return response()->json($response);
        }
        return redirect()->route('dashboard.start');
    }

    public function update(Request $request, Service $service)
    {
        $saved = $service->update([
            'name' => $request->input('name', 'default'),
            'price' => $request->input('price', 0),
            'description' => $request->input('description', 'description')
        ]);
        return response()->json(['saved' => $saved]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:200',
            'price' => 'required|numeric',
            'description' => 'required|string'
        ]);
        $created = $this->service->create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ]);
        if ($created) {
            $message = [
                'type' => 'success',
                'content' => 'Servicio registrado con exito.'
            ];
        } else {
            $message = [
                'type' => 'error',
                'content' => 'Ha ocurrido un error al registrar el servicio.'
            ];
        }
        return redirect()->route('dashboard.services')->with($message['type'], $message['content']);
    }

    public function destroy(Service $service)
    {
        $deleted = $service->delete();
        return response()->json(['deleted' => $deleted]);
    }

}
