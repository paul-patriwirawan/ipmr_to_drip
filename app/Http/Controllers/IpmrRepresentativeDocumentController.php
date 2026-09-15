<?php

namespace App\Http\Controllers;

use App\Models\IpmrRepresentativeDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IpmrRepresentativeDocumentController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(IpmrRepresentativeDocument::query()->get());
    }

    public function show(IpmrRepresentativeDocument $ipmrRepresentativeDocument): JsonResponse
    {
        return response()->json($ipmrRepresentativeDocument);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate($this->rules());
        $validated['attachment_path'] = $this->storeAttachment($request);

        $document = IpmrRepresentativeDocument::create($validated);

        return response()->json([
            'message' => 'IPMR representative document created successfully.',
            'data' => $document,
        ], 201);
    }

    public function update(Request $request, IpmrRepresentativeDocument $ipmrRepresentativeDocument): JsonResponse
    {
        $validated = $request->validate($this->rules(true));

        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $this->storeAttachment($request);
            Storage::delete($ipmrRepresentativeDocument->attachment_path);
        }

        $ipmrRepresentativeDocument->update($validated);

        return response()->json([
            'message' => 'IPMR representative document updated successfully.',
            'data' => $ipmrRepresentativeDocument->fresh(),
        ]);
    }

    public function destroy(IpmrRepresentativeDocument $ipmrRepresentativeDocument): JsonResponse
    {
        Storage::delete($ipmrRepresentativeDocument->attachment_path);
        $ipmrRepresentativeDocument->delete();

        return response()->json(null, 204);
    }

    private function storeAttachment(Request $request): string
    {
        $attachment = $request->file('attachment');
        $extension = $attachment->getClientOriginalExtension();

        return $attachment->storeAs(
            'ipmr/documents',
            Str::random(40).($extension !== '' ? '.'.$extension : '')
        );
    }

    private function rules(bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return [
            'representative_id' => [$required, 'integer', 'exists:drip_ipmr_representatives,id'],
            'document_type' => [$required, 'string', 'max:255'],
            'document_name' => [$required, 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'attachment' => [$partial ? 'nullable' : 'required', 'file', 'max:10240', 'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx'],
        ];
    }
}