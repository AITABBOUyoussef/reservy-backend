<?php

namespace App\Http\Controllers;

use App\Requests\ReservationRequests;
use App\Requests\UpdateReservationRequest;
use App\Services\reservationService;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    public function __construct(protected reservationService $reservationService) {}

    public function index(): JsonResponse
    {
        $data = $this->reservationService->getReservations();

        return response()->json(['success' => true, 'reservations' => $data['reservations']]);
    }

    public function store(ReservationRequests $request): JsonResponse
    {
        $data = $this->reservationService->createReservation($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Réservation créée avec succès.',
            'reservation' => $data['reservation'],
        ], 201);
    }

    public function show(int $reservation): JsonResponse
    {
        $data = $this->reservationService->getReservation($reservation);

        return response()->json(['success' => true, 'reservation' => $data['reservation']]);
    }

    public function update(UpdateReservationRequest $request, int $reservation): JsonResponse
    {
        $data = $this->reservationService->updateReservation($reservation, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Réservation modifiée avec succès.',
            'reservation' => $data['reservation'],
        ]);
    }

    public function destroy(int $reservation): JsonResponse
    {
        $this->reservationService->deleteReservation($reservation);

        return response()->json([
            'success' => true,
            'message' => 'Réservation supprimée avec succès.',
        ]);
    }
}
