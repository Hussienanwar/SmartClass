<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Validation\ValidationException;

class StudentsImport implements ToCollection, WithHeadingRow
{
    private $room_id;
    private $errors = [];
    private $validRows = [];

    // Constructor to receive the room_id
    public function __construct($room_id)
    {
        $this->room_id = $room_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $row = array_change_key_case(array_map('trim', $row->toArray()), CASE_LOWER);

            // Validate each row
            $validator = Validator::make($row, [
                'name'  => 'required|string|max:255',
                'code'  => 'required|string|unique:students,code',
                'sec'   => 'required|integer|min:1|max:5',
            ]);

            if ($validator->fails()) {
                $this->errors[] = "Row " . ($index + 2) . ": " . implode(', ', $validator->errors()->all());
            } else {
                $this->validRows[] = $row;
            }
        }

        if (!empty($this->errors)) {
            throw ValidationException::withMessages(['errors' => $this->errors]);
        }

        // Insert valid students into the database with room_id
        foreach ($this->validRows as $row) {
            Student::create([
                'name'    => $row['name'],
                'code'    => $row['code'],
                'section' => $row['sec'],
                'room_id' => $this->room_id, // Assigning room_id
            ]);
        }
    }
}
