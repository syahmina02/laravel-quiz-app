<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ExcelController extends Controller
{
    public function showForm()
    {
        return view('admin.excel.form');
    }
    public function import(Request $request) {
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
    
            foreach ($sheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
    
                $rowData = [];
                foreach ($cellIterator as $cell) {
                    $rowData[] = $cell->getValue();
                }
    
                // Assuming the first column contains the category name
                $categoryName = $rowData[0];
    
                // Find or create the category
                $category = Category::firstOrCreate(['name' => $categoryName]);
    
                // Assuming the second column contains the question text
                $questionText = $rowData[1];
    
                // Create the question and associate it with the category
                $question = $category->categoryQuestions()->create(['question_text' => $questionText]);
    
                // Process the remaining columns as options
                for ($i = 2; $i < count($rowData); $i++) {
                    $optionText = $rowData[$i];
                    $points = $rowData[$i + 1]; // Assuming marks are in the next column
    
                    // Create the option and associate it with the question
                    $option = $question->questionOptions()->create(['option_text' => $optionText, 'points' => $points]);
    
                    $i++; // Skip the next column (marks)
                }
            }
    
            Session::flash('success', 'Data imported successfully!'); // Flash success message

            return redirect('admin/dashboard'); // Redirect to the dashboard page
        }
    
        return "No file found.";
}
}
