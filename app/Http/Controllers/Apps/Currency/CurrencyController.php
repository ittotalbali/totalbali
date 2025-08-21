<?php

namespace App\Http\Controllers\Apps\Currency;

use App\Http\Controllers\Controller;
use App\Services\Currency\DeleteCurrencyService;
use App\Services\Currency\GetCurrencyService;
use App\Services\Currency\StoreCurrencyService;
use App\Services\Currency\ConvCurrency;
use App\Services\Currency\UpdateCurrencyService;
use Illuminate\Http\Request;
use App\Models\Currency\Currency;
use App\Models\Currency\Currencyexchange;

class CurrencyController extends Controller
{
    public function index(GetCurrencyService $getCurrencyService)
    {
        $result = $getCurrencyService->execute();

        return view('admin.currency.index', [
            'currencies' => $result->data
        ]);
    }
    
    //Start Rino
    public function kurs(GetCurrencyService $getCurrencyService)
    {
        $currencies = Currency::all();
        $konversi = Currencyexchange::all();
    return view('admin.currency.kurs', [
        'currencies' => $currencies, 'konversi' => $konversi
    ]);

    }

    public function conv(
        Request $request,
        ConvCurrency $convCurrencyService
    ) {
        $result = $convCurrencyService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    //End rino

    public function get(
        Request $request,
        GetCurrencyService $getCurrencyService
    ) {
        $result = $getCurrencyService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    public function store(
        Request $request,
        StoreCurrencyService $storeCurrencyService
    ) {
        $result = $storeCurrencyService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    public function update(
        Request $request,
        UpdateCurrencyService $updateCurrencyService
    ) {
        $result = $updateCurrencyService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }

    public function delete(
        Request $request,
        DeleteCurrencyService $deleteCurrencyService
    ) {
        $result = $deleteCurrencyService->execute($request->all());

        return response()->json([
            'success' => true,
            'data' => $result->data
        ]);
    }
}
