<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TripPackage;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details', 'trip_package', 'user'])
            ->findOrFail($id);
        return view('pages.checkout', [
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $trip_package = TripPackage::findOrFail($id);
        $transaction = Transaction::create([
            'trip_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'additional_health_letter' => 0,
            'transaction_total' => $trip_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality'=> 'ID',
            'is_band' => false,
            'd_healt_letter' => Carbon::now()->addYears(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findOrFail($detail_id);
        $transaction = Transaction::with(['details', 'trip_package'])
            ->findOrFail($item->transactions_id);

        if ($item->is_band) {
            $transaction->transaction_total -= 190;
            $transaction->additional_health_letter -= 190;
        }

        $transaction->transaction_total -= $transaction->trip_package->price;
        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'is_band' => 'required|boolean',
            'd_healt_letter' => 'required'
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

         // Debugging statement
        // dd($data);

        TransactionDetail::create($data);

        $transaction = Transaction::with(['trip_package'])->find($id);

        if ($request->is_band) {
            $transaction->transaction_total += 190;
            $transaction->additional_health_letter += 190;
        }

        $transaction->transaction_total += $transaction->trip_package->price;
        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request , $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        return view('pages.success');
    }
}
