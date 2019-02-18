<?php

namespace App\Http\Controllers;

use App\Services\QuoteBoardService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class QuoteBoardController extends BaseController
{
    public $quoteBoardService;


    public function __construct(QuoteBoardService $quoteBoardService)
    {
        $this->quoteBoardService = $quoteBoardService;
    }

    public function index()
    {
        return response()->json(['data' => $this->quoteBoardService->index()]);
    }

    public function getRandomizedDummyData()
    {
        return response()->json(['data' => $this->quoteBoardService->getRandomizedDummyData()]);
    }

    public function save(Request $request)
    {
        $payload = $request->get('symbol');
        $quote = $this->quoteBoardService->save($payload);

        return response()->json(['data' => $quote]);
    }
}
