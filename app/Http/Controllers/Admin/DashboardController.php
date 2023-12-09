<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function index(){
        $projects_count = count(Project::all());
        $tecnologies_count = count(Tecnology::all());
        $types_count = count(Type::all());
        return view('admin.home',compact('projects_count','tecnologies_count','types_count'));
    }

    public function importCsv(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            $fileContents = file($file->getPathname());

            foreach ($fileContents as $line){
                $data = str_getcsv($line);

                // Product::create([
                //     'name' => $data[0],
                //     'price' => $data[1],
                //     // Add more fields as needed
                // ]);
            }
        }
        // return redirect()->back()->with('success', 'CSV file imported successfully.');
        return view('admin.partials.import_csv');
    }

    public function exportCsv(Request $request){
        $products = Project::all();
        $csvFileName = 'products.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Name', 'Price']); // Add more headers as needed

        foreach ($products as $product) {
            fputcsv($handle, [$product->name, $product->price]); // Add more fields as needed
        }

        fclose($handle);

        return Response::make('', 200, $headers);
    }
}
