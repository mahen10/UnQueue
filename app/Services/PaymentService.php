<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentService
{
    /**
     * Buat invoice pembayaran.
     * Sekarang: mode dummy → return URL simulasi.
     * Nanti: ganti isi method ini dengan API Xendit/Midtrans.
     * Controller & semua kode lain TIDAK perlu berubah.
     */
    public static function createInvoice(Order $order): string
    {
        if (env('PAYMENT_MODE', 'dummy') === 'dummy') {
            return self::createDummyInvoice($order);
        }

        // ─── XENDIT (nanti diaktifkan) ────────────────────────────────────────
        // return self::createXenditInvoice($order);

        // ─── MIDTRANS (alternatif) ────────────────────────────────────────────
        // return self::createMidtransInvoice($order);

        return self::createDummyInvoice($order);
    }

    // ─── DUMMY ────────────────────────────────────────────────────────────────────

    private static function createDummyInvoice(Order $order): string
    {
        $reference = 'DUMMY-' . strtoupper(Str::random(8)) . '-' . $order->id;

        Payment::create([
            'order_id'          => $order->id,
            'shop_id'           => $order->shop_id,
            'amount'            => $order->total,
            'status'            => 'pending',
            'method'            => null,
            'gateway_reference' => $reference,
            'xendit_invoice_url' => route('customer.checkout.pending', $order),
            'gateway_response'  => ['mode' => 'dummy', 'reference' => $reference],
        ]);

        return route('customer.checkout.pending', $order);
    }

    // ─── KONFIRMASI PEMBAYARAN (dipanggil dari webhook atau simulasi) ─────────────

    public static function markAsPaid(Order $order, array $gatewayData = []): void
    {
        // Update payment
        $order->payment()->update([
            'status'           => 'success',
            'method'           => $gatewayData['method'] ?? 'other',
            'paid_at'          => now(),
            'gateway_response' => array_merge(
                $order->payment->gateway_response ?? [],
                $gatewayData
            ),
        ]);

        // Update order status → paid (siap diproses dapur)
        $order->update(['status' => 'paid']);

        // TODO Fase 6: Broadcast ke KDS via Reverb/Websocket
        // event(new OrderPaid($order));
    }

    public static function markAsFailed(Order $order): void
    {
        $order->payment()->update(['status' => 'failed']);
        $order->update(['status' => 'cancelled']);
    }

    // ─── XENDIT (template untuk nanti) ────────────────────────────────────────────

    /*
    private static function createXenditInvoice(Order $order): string
    {
        $shop = $order->shop;

        // Pakai API key milik shop (model hybrid) atau for-user-id (XenPlatform)
        $xendit = new \Xendit\Xendit();
        $xendit->setApiKey($shop->xendit_secret_key);

        $params = [
            'external_id'      => 'UQ-' . $order->order_number,
            'amount'           => (int) $order->total,
            'description'      => 'Pesanan ' . $order->order_number . ' di ' . $shop->name,
            'invoice_duration' => 300, // 5 menit
            'success_redirect_url' => route('customer.track', $order),
            'failure_redirect_url' => route('customer.checkout.pending', $order),
        ];

        $response = \Xendit\Invoice::create($params);

        Payment::create([
            'order_id'           => $order->id,
            'shop_id'            => $order->shop_id,
            'amount'             => $order->total,
            'status'             => 'pending',
            'gateway_reference'  => $response['id'],
            'xendit_invoice_url' => $response['invoice_url'],
            'gateway_response'   => $response,
        ]);

        return $response['invoice_url'];
    }
    */
}
