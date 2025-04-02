<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\UnitModel;
use App\Models\Location;
use App\Models\GroupCompnent;
use App\Models\ComponentDetail;
use App\Models\Statusunit;
use App\Models\Manpower;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['unit', 'brand', 'unitModel', 'location', 'groupComponent', 'componentDetail', 'statusUnit', 'manpower'])
        ->orderBy('created_at', 'desc')
        ->get();
        return view('user.report', compact('reports'));
    }

    public function create()
    {
        $report = Report::with('manpowers');
        $units = Unit::all();
        $locations = Location::all();
        $groupComponents = GroupCompnent::all();
        $statusUnits = Statusunit::all();
        $manpowers = Manpower::all();

        return view('user.report-create', compact('units', 'locations', 'groupComponents', 'statusUnits', 'manpowers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'brand_id' => 'required|exists:brands,id',
            'unitmodel_id' => 'required|exists:unitmodels,id',
            'hm' => 'required|numeric',
            'location_id' => 'required|exists:locations,id',
            'problem_desc' => 'required|string',
            'groupcomponent_id' => 'required|exists:groupcomponent,id',
            'componentdetail_id' => 'required|exists:componentdetail,id',
            'date_start' => 'required|date',
            'date_finish' => 'nullable|date',
            'statusunit_id' => 'required|exists:statusunit,id',
            'activity_report' => 'required|string',
            'backlog_outstanding' => 'nullable|string',
            'manpowers' => 'required|array',
            'manpowers.*' => 'exists:manpower,id',
        ]);

        try {
            // Konversi format tanggal
            $validatedData['date_start'] = Carbon::parse($request->date_start)->format('Y-m-d H:i:s');
            $validatedData['date_finish'] = $request->date_finish ? Carbon::parse($request->date_finish)->format('Y-m-d H:i:s') : null;

            // Buat report tanpa manpower_id
            $report = Report::create($validatedData);
            $report->manpower()->sync($request->manpowers);

            return redirect()->route('reports.index')->with('success', 'Report created successfully.');
        } catch (\Exception $e) {
            Log::error('Error saving report: ' . $e->getMessage());
            return back()->with('error', 'Failed to create report. Please try again.');
        }
    }

    // public function store(Request $request)
    // {
    //     dd($request->all()); // Debug data dari form
    // }


    public function edit($id)
    {
        $report = Report::with('manpower')->findOrFail($id);
        // $report = Report::findOrFail($id); // Ambil data report berdasarkan ID
        $units = Unit::all();
        $locations = Location::all();
        $groupComponents = GroupCompnent::all();
        $componentDetails = ComponentDetail::all();
        $statusUnits = Statusunit::all();
        $manpowers = Manpower::all();

        return view('user.report-edit', compact('report', 'units', 'locations', 'groupComponents', 'componentDetails', 'statusUnits', 'manpowers'));
    }


    public function update(Request $request, Report $report)
    {
        $validatedData = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'brand_id' => 'required|exists:brands,id',
            'unitmodel_id' => 'required|exists:unitmodels,id',
            'hm' => 'required|numeric',
            'location_id' => 'required|exists:locations,id',
            'problem_desc' => 'required|string',
            'groupcomponent_id' => 'required|exists:groupcomponent,id',
            'componentdetail_id' => 'required|exists:componentdetail,id',
            'date_start' => 'required|date',
            'date_finish' => 'nullable|date',
            'statusunit_id' => 'required|exists:statusunit,id',
            'activity_report' => 'required|string',
            'backlog_outstanding' => 'nullable|string',
            'manpowers' => 'required|array',
            'manpowers.*' => 'exists:manpower,id',
        ]);

        try {
            $validatedData['date_start'] = Carbon::parse($request->date_start)->format('Y-m-d H:i:s');
            $validatedData['date_finish'] = $request->date_finish ? Carbon::parse($request->date_finish)->format('Y-m-d H:i:s') : null;
    
            $report->update($validatedData);

            $report->manpower()->sync($request->input('manpowers', []));
    
            return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error saving report: ' . $e->getMessage());
            return back()->with('error', 'Failed to create report. Please try again.');
        }
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }

    public function getBrandAndModel($unit_id)
        {
            $unit = Unit::with(['brand', 'unitModel'])->find($unit_id);

            if (!$unit) {
                return response()->json([
                    'error' => 'Unit not found',
                    'unit_id' => $unit_id,
                ], 404);
            }

            return response()->json([
                'brand' => $unit->brand ? ['id' => $unit->brand->id, 'name' => $unit->brand->name] : null,
                'unitmodel' => $unit->unitModel ? ['id' => $unit->unitModel->id, 'name' => $unit->unitModel->name] : null
            ]);
            
        }

    // Fetch component details dynamically based on selected group component
    public function getComponentDetails($groupcomponent_id)
    {
        $componentDetails = ComponentDetail::where('groupcomponent_id', $groupcomponent_id)->get();
        return response()->json($componentDetails);
    }

    public function show($id)
    {
        $report = Report::with([
            'unit', 'brand', 'unitmodel', 'location', 
            'groupComponent', 'componentDetail', 
            'statusUnit', 'manpower'
        ])->findOrFail($id);

        return view('user.report-show', compact('report'));
    }

}
