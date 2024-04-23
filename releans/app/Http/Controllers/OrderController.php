<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Car;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $order = new Order;
        $order->car_id = $id;
        $order->user_id = Auth::user()->id;
        $order->save();

        $car = Car::find($id);
        $car->stock--;
        $car->save();

        return redirect()->route('buyingNotification');
    }

    public function getReportData()
    {
        $numberOfOrders = Order::count();
        $numberOfTotalCars = Car::count();
        $numberOfCarsInStock = Car::where('stock', '>=', 1)->count();
        $mostRepeatedCarId = Order::select('car_id')
            ->groupBy('car_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->pluck('car_id')
            ->first();

        $mostPopularCar = Car::find($mostRepeatedCarId);

        // Generate HTML content for the PDF
        $html = '<h1>Sales Report</h1>';
        $html .= '<table border="1" cellpadding="5">';
        $html .= '<tr><th>Attribute</th><th>Value</th></tr>';
        $html .= '<tr><td>Number of Orders</td><td>' . $numberOfOrders . '</td></tr>';
        $html .= '<tr><td>Number of Total Cars</td><td>' . $numberOfTotalCars . '</td></tr>';
        $html .= '<tr><td>Number of Cars in Stock</td><td>' . $numberOfCarsInStock . '</td></tr>';
        $html .= '<tr><td>Most Popular Car</td><td>' . $mostPopularCar->type . '</td></tr>';
        $html .= '</table>';

        // Create a new Dompdf instance
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (optional: you can also pass a filename)
        $dompdf->render();

        // Output the generated PDF
        $pdfContent = $dompdf->output();

        // Download the PDF
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment;filename="sales_report.pdf"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
