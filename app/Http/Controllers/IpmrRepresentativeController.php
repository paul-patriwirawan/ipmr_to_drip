<?php

namespace App\Http\Controllers;

use App\Models\IpmrRepresentative;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IpmrRepresentativeController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(IpmrRepresentative::query()->get());
    }

    public function show(IpmrRepresentative $ipmrRepresentative): JsonResponse
    {
        return response()->json($ipmrRepresentative);
    }

    public function store(Request $request): JsonResponse
    {
        $representative = IpmrRepresentative::create($request->validate($this->rules()));

        return response()->json([
            'message' => 'IPMR representative created successfully.',
            'data' => $representative,
        ], 201);
    }

    public function update(Request $request, IpmrRepresentative $ipmrRepresentative): JsonResponse
    {
        $ipmrRepresentative->update($request->validate($this->rules(true)));

        return response()->json([
            'message' => 'IPMR representative updated successfully.',
            'data' => $ipmrRepresentative->fresh(),
        ]);
    }

    public function destroy(IpmrRepresentative $ipmrRepresentative): JsonResponse
    {
        $ipmrRepresentative->delete();

        return response()->json(null, 204);
    }

    private function rules(bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return [
            'ipmr_id' => [$required, 'integer', 'exists:drip_ipmr,id'],
            'first_name' => [$required, 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => [$required, 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'sex' => [$required, 'in:Male,Female'],
            'ad_name' => [$required, 'integer'],
            'ip_type' => [$required, 'in:Rightsholder,Migrant'],
            'ip_group' => [$required, 'string', 'max:255'],
            'complete_address' => [$required, 'string'],
            'contact_no' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_current' => [$required, 'boolean'],
            'birthdate' => ['nullable', 'date'],
            'image_path' => ['nullable', 'string', 'max:255'],
        ];
    }
}
