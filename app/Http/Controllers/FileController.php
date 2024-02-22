<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // Define $mappedData at the class level
    protected $mappedData = [];

    public function mapAndModifyFile(Request $request)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:txt|max:10240', // Adjust the validation rules as needed
        ]);
    
        // Store the uploaded file
        $file = $request->file('file');
        $path = $file->store('files'); // 'files' is the storage folder; you can customize it
    
        // Specify the file path
        $filePath = storage_path('app/' . $path);
    
        if (file_exists($filePath)) {
            // Read the contents of the file
            $fileContents = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
            // Initialize the mappedData array
            $this->mappedData = [];
            // Capture the first line of the modified data
            if (!empty($fileContents)) {
                $firstLine = [
                    'truncated_data' => substr($fileContents[0], 0, 139) . substr($fileContents[0], 140),
                ];
                $this->mappedData[] = $firstLine;
            }
    
            // Iterate through each line in the file (excluding the first and last lines)
            for ($i = 1; $i < count($fileContents) - 1; $i++) {
                $line = $fileContents[$i];
                $truncatedLine = substr($line, 80, 2);
    
                if ($truncatedLine !== "00") {
                    // Check if the substring at positions 80 to 82 is equal to '  '
                    if (substr($line, 80, 2) !== '  ') {
                        $line = substr_replace($line, "00", 80, 2);
                        $line = substr_replace($line, "0000", 493, 0);
                        $line = substr($line, 0, 139) . substr($line, 140);
                        $line = substr($line, 0, 105) . substr($line, 108);
    
                        $this->mappedData[] = [
                            'truncated_data' => $line,
                        ];
                    }
                }
            }
    
            // Capture the last line of the modified data
            if (!empty($fileContents)) {
                $lastLine = [
                    'truncated_data' => substr(end($fileContents), 0, 139) . substr(end($fileContents), 140),
                ];
                $this->mappedData[] = $lastLine;
            }
    
            // Save the modified contents back to the file
            $newFileName = $file->getClientOriginalName();
            $newFilePath = storage_path("app/modified_files/{$newFileName}");
            file_put_contents($newFilePath, implode(PHP_EOL, array_column($this->mappedData, 'truncated_data')));
    
            // Do something with the mapped data (e.g., display or process)
            dd($this->mappedData);
    
            // Remove the original file
            unlink($filePath);
        } else {
            // Handle the case where the file doesn't exist
            echo "The file does not exist.";
        }
    
        // Return a response without downloading the file immediately
        return view('file.dowlnd', [
            'mappedData' => $this->mappedData,
            'downloadLink' => isset($newFilePath) ? asset("storage/modified_files/{$newFileName}") : null,
        ]);
    }
    
    
    
    public function showForm()
    {
        return view('File.insert');
    }

    // Assume this is your controller method (e.g., FileController.php)
    public function downloadTextFile()
    {
        $modifiedFilePath = storage_path('app/modified_files/File.txt');
    
        if (file_exists($modifiedFilePath)) {
            return response()->download($modifiedFilePath, 'downloaded_modified_file.txt');
        } else {
            return response()->json(['error' => 'The modified file does not exist.']);
        }
    }
}
