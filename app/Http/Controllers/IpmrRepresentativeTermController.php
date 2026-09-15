<?php

namespace App\Http\Controllers;

use App\Models\IpmrRepresentativeTerm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IpmrRepresentativeTermController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(IpmrRepresentativeTerm::query()->get());
    }

    public function show(IpmrRepresentativeTerm $ipmrRepresentativeTerm): JsonResponse
    {
        return response()->json($ipmrRepresentativeTerm);
    }

    public function store(Request $request): JsonResponse
    {
        $term = IpmrRepresentativeTerm::create($request->validate($this->rules()));

        return response()->json([
            'message' => 'IPMR representative term created successfully.',
            'data' => $term,
        ], 201);
    }

    public function update(Request $request, IpmrRepresentativeTerm $ipmrRepresentativeTerm): JsonResponse
    {
        $ipmrRepresentativeTerm->update($request->validate($this->rules(true)));

        return response()->json([
            'message' => 'IPMR representative term updated successfully.',
            'data' => $ipmrRepresentativeTerm->fresh(),
        ]);
    }

    public function destroy(IpmrRepresentativeTerm $ipmrRepresentativeTerm): JsonResponse
    {
        $ipmrRepresentativeTerm->delete();

        return response()->json(null, 204);
    }

    private function rules(bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return [
            'representative_id' => [$required, 'integer', 'exists:drip_ipmr_representatives,id'],
            'term' => [$required, 'string', 'max:255'],
            'status' => [$required, 'in:SEATED,NOT SEATED'],
            'benefits_received' => [$required, 'in:FULL,PARTIAL,HONORARIA'],
            'date_of_selection' => [$required, 'date'],
            'coa_number' => ['nullable', 'string', 'max:255'],
            'date_issued' => ['nullable', 'date'],
            'end_of_term' => ['nullable', 'date'],
            'date_appointed' => ['nullable', 'date'],
            'source_of_funds' => ['nullable', 'string', 'max:255'],
            'other_source' => ['nullable', 'string', 'max:255'],
        ];
    }
}
