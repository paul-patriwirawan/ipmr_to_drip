<?php

namespace App\Http\Controllers;

use App\Models\Ipmr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IpmrController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Ipmr::query()->get());
    }

    public function show(Ipmr $ipmr): JsonResponse
    {
        return response()->json($ipmr);
    }

    public function store(Request $request): JsonResponse
    {
        $ipmr = Ipmr::create($request->validate($this->rules()));

        return response()->json([
            'message' => 'IPMR created successfully.',
            'data' => $ipmr,
        ], 201);
    }

    public function update(Request $request, Ipmr $ipmr): JsonResponse
    {
        $ipmr->update($request->validate($this->rules(true)));

        return response()->json([
            'message' => 'IPMR updated successfully.',
            'data' => $ipmr->fresh(),
        ]);
    }

    public function destroy(Ipmr $ipmr): JsonResponse
    {
        $ipmr->delete();

        return response()->json(null, 204);
    }

    private function rules(bool $partial = false): array
    {
        $required = $partial ? 'sometimes' : 'required';

        return [
            'ancestral_domain_id' => [$required, 'string', 'max:255'],
            'level_of_representation' => [$required, 'string', 'max:255'],
            'governance_body' => [$required, 'string', 'max:255'],
            'position_type' => [$required, 'string', 'max:255'],
            'area_of_responsibility' => [$required, 'string'],
            'region_code' => [$required, 'string', 'max:10'],
            'province_code' => [$required, 'string', 'max:10'],
            'municipality_code' => [$required, 'string', 'max:10'],
            'barangay_code' => [$required, 'string', 'max:10'],
            'lgu_represented_name' => [$required, 'string', 'max:255'],
        ];
    }
}
