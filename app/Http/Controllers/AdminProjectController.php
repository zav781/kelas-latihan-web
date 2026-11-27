<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminProjectController extends Controller
{
    private const STATUSES = ['Selesai', 'In Progress'];

    public function index(): View
    {
        $projects = Project::latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create', ['statuses' => self::STATUSES]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules(imageRequired: true), $this->messages());

        $data['images'] = $this->uploadImage($request->file('image'));
        unset($data['image']);

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', [
            'project'  => $project,
            'statuses' => self::STATUSES,
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $request->validate($this->rules(imageRequired: false), $this->messages());

        if ($request->hasFile('image')) {
            $this->deleteImage($project->images);
            $data['images'] = $this->uploadImage($request->file('image'));
        }
        unset($data['image']); 

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil diupdate.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteImage($project->images);
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }

    private function rules(bool $imageRequired): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'teknologi'   => ['required', 'string', 'max:255'],
            'status'      => ['required', 'in:' . implode(',', self::STATUSES)],
            'image'       => [
                $imageRequired ? 'required' : 'nullable',
                'image', 'mimes:jpg,jpeg,png,webp', 'max:2048',
            ],
        ];
    }

    private function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'image'    => ':attribute harus berupa gambar.',
            'mimes'    => ':attribute harus berformat jpg, jpeg, png, atau webp.',
            'max'      => ':attribute terlalu besar (maks. :max).',
            'in'       => ':attribute tidak valid.',
        ];
    }

    private function uploadImage(UploadedFile $file): string
    {
        $filename = time() . '_' . $file->hashName();
        $file->move(public_path('image'), $filename);

        return $filename;
    }

    private function deleteImage(?string $filename): void
    {
        if ($filename && is_file(public_path('image/' . $filename))) {
            unlink(public_path('image/' . $filename));
        }
    }

        public function exportPdf()
        {
            $projects = Project::all();
            $pdf = Pdf::loadView('admin.projects.pdf', compact('projects'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'chroot' => public_path(),
                'isRemoteEnabled' => true,
            ]);
            return $pdf->download('projects.pdf');
        }
    }

