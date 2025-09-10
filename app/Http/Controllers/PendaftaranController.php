<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\Siswa;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Facades\Http;
// use App\Services\MidtransService;
// require_once __DIR__ . '/vendor/autoload.php';

class PendaftaranController extends Controller
{
    public function checkout($id)
    {
        $checkoutProgram = Program::findOrFail($id);
        $siswa = Siswa::where('id_user', Auth::id())->first();
        $harga = $checkoutProgram->biaya_program;

        // Setting konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $order_id = 'ORDER-' . time();
        $tanggalDaftar = now()->toDateString();

        // create ke database
        $existing = Pendaftaran::where('id_siswa', $siswa->id)
            ->where('id_program', $checkoutProgram->id)
            ->where('status_pembayaran', 'pending')
            ->first();

        if (!$existing) {
            $pendaftaran = Pendaftaran::create([
                'id_siswa' => $siswa->id,
                'id_program' => $checkoutProgram->id,
                'id_order' => $order_id,
                'tanggal_daftar' => $tanggalDaftar,
                'total' => $harga
            ]);
        } else {
            $pendaftaran = $existing;
        }

        $siswa->id_program = $checkoutProgram->id;
        $siswa->save();

        if (!$pendaftaran->snapToken) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => 'ORDER-' . time(),
                    'gross_amount' => $harga,
                ),
                'customer_details' => array(
                    'nama' => $siswa->nama_siswa,
                    'asal_sekolah' => $siswa->asal_sekolah,
                    'notelp' => $siswa->notelp_siswa,
                ),
            );

            $snapToken = Snap::getSnapToken($params);
            // dd($snapToken);
            $pendaftaran->snapToken = $snapToken;
            $pendaftaran->save();
        } else {
            $snapToken = $pendaftaran->snapToken;
        }
        return view('siswa.checkout', compact('checkoutProgram', 'siswa', 'snapToken'));
    }

    public function thankyou(Request $request)
    {
        $orderId = $request->query('id_order');
        // dd($orderId);

        $response = Http::withBasicAuth(config('midtrans.server_key'), '')
            ->get("https://api.sandbox.midtrans.com/v2/{$orderId}/status");

        if ($response->successful()) {
            $status = $response['transaction_status'];

            $order = Pendaftaran::where('id_order', $orderId)->first();

            if ($order) {
                if ($status === 'settlement' || $status === 'capture') {
                    $order->status_pembayaran = 'Paid';
                } elseif ($status === 'expire') {
                    $order->status_pembayaran = 'Failed';
                } else {
                    $order->status_pembayaran = 'Pending';
                }
                $order->save();
            }
            return view('siswa.thankyou', [
                'id_order' => $orderId,
                'status' => $order->status_pembayaran
            ]);
        }
        return abort(500, 'Gagal mengambil status pembayaran');
    }

    public function transaksi()
    {
        $siswa = Siswa::where('id_user', Auth::id())->first();
        // dd($siswa);
        $pendaftaran = Pendaftaran::with(['program'])
            ->where('id_siswa', $siswa->id)
            ->paginate(5);

        // dd($pendaftaran->toArray());

        return view('siswa.transaksi', compact('pendaftaran'));
    }

    public function transaksiDetail($id)
    {
        $pendaftaran = Pendaftaran::with(['siswa', 'program'])
            ->where('id', $id)
            ->whereHas('siswa', function ($query) {
                $query->where('id_user', Auth::id());
            })->firstOrFail();

        return view('siswa.detail-transaksi', [
            'pendaftaran' => $pendaftaran,
            'siswa' => $pendaftaran->siswa,
            'program' => $pendaftaran->program
        ]);
    }

    public function cetakInvoice($id)
    {
        $siswa = Siswa::where('id_user', Auth::id())->firstOrFail();
        $pendaftaran = Pendaftaran::with('program', 'siswa')
            ->where('id_siswa', $siswa->id)
            ->where('id', $id)
            ->firstOrFail();
        $program = $pendaftaran->program;

        $html = view('siswa.invoice', compact('siswa', 'pendaftaran', 'program'))->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('invoice.pdf', 'I'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}


