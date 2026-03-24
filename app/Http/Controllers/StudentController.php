<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Universities;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use App\Models\University;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
            $students = Student::with('university')->get();
            return view('students.index', compact('students'));
    }
            


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    $universities = Universities::all();
    return view('students.create', compact('universities'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'course' => 'required',
            'dob' => 'required|date',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'grade' => 'required',
            'university'=> 'required'
        ]);

        // Store the image in the assets/images folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('assets/images'), $imageName);

        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->course = $request->course;
        $student->dob = $request->dob;
        $student->grade = $request->grade;
        $student->detail = $request->detail;
        $student->image = $imageName;
        $student->university_id = $request->university;
        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student): View
    {
        $universities = Universities::all();
        return view('students.edit', compact('student', 'universities'));
    }




    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($student->image) {
                $oldImagePath = public_path('assets/images/' . $student->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // Store the new image in the public assets directory
            $image->move(public_path('assets/images'), $imageName);
            // Update the student with the new image name
            $student->update([
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
                'image' => $imageName,
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'dob' => $request->input('dob'),
                'university_id' => $request->input('university_id'),
            ]);
            return redirect()->route('students.index')->with('success', 'Student updated successfully with a new image.');
        }
        // No new image uploaded, update other fields without touching the image
        $student->update([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => $request->input('status'),
            'dob' => $request->input('dob'),
            'university_id' => $request->input('university_id'),
        ]);
        return redirect()->route('students.index')->with('success', 'Student updated successfully without changing the image.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): RedirectResponse
    {
        // Delete the associated image if it exists
        if ($student->image) {
            $imagePath = public_path('assets/images/' . $student->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete the student
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}