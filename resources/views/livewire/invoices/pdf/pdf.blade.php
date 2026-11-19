<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $page_title }}</title>
    <style>
        body {
            font-family: "cairo", "dejavusans", sans-serif;
            margin: 0;
            padding: 0;
            color: #4b4f58;
            font-size: 9pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .cell-top {
            vertical-align: top;
        }

        .bar {
            color: #f2b806;
            background-color: #3C3F46;
            font-size: 9pt;
            font-weight: bold;
            padding: 2.6mm 3mm;
            text-align: start;
            border:1px solid #d5d5cd
        }

        .info-name {
            font-size: 10.5pt;
            font-weight: bold;
            color: #3C3F46;
            padding-bottom: 1.2mm;
        }

        .info-line {
            font-size: 8.6pt;
            color: #6b7079;
            line-height: 1.4;
        }

        .meta-cell {
            width: 33.33%;
            padding: 0 2mm 2.6mm 0;
            vertical-align: top;
        }

        .meta-label {
            font-size: 7.2pt;
            color: #9aa0a8;
            text-transform: uppercase;
            padding-bottom: 0.6mm;
        }

        .meta-value {
            font-size: 9pt;
            font-weight: bold;
            color: #3C3F46;
        }

        /* ---------- Summary strip ---------- */

        .summary {
            margin-top: 4.5mm;
            border-top: 1px solid #e4e4e4;
            border-bottom: 1px solid #e4e4e4;
        }

        .summary-cell {
            padding: 3mm 0;
            vertical-align: middle;
        }

        .sum-label {
            font-size: 7.4pt;
            color: #9aa0a8;
            text-transform: uppercase;
            vertical-align: middle;
        }

        .sum-amount {
            font-size: 12pt;
            font-weight: bold;
            color: #3C3F46;
            padding-right: 2mm;
            vertical-align: middle;
        }

        .sum-value {
            font-size: 9pt;
            font-weight: bold;
            color: #3C3F46;
            padding-right: 2mm;
            vertical-align: middle;
        }

        /* ---------- Items table ---------- */

        .items {
            margin-top: 3.5mm;
        }

        /* The items header stays square on purpose: mPDF crashes when a
           background-image is set on a <thead> cell and the table breaks
           across pages (vendor/Mpdf.php, thead repaint reads a missing key). */
        .item-th {
            background-color: #3C3F46;
            color: #ffffff;
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
            padding: 3mm;
            white-space: nowrap;
        }

        .item-td {
            font-size: 8.8pt;
            padding: 2.5mm 3mm;
            border-bottom: 1px solid #ededed;
            vertical-align: middle;
        }

        .section-cell {
            background-color: #EEEEEE;
            color: #3C3F46;
            font-size: 8.8pt;
            font-weight: bold;
            padding: 2.4mm 3mm;
        }

        .amount {
            white-space: nowrap;
        }

        /* ---------- Totals ---------- */

        .totals {
            width: 78mm;
            margin-top: 3mm;
            page-break-inside: avoid;
        }

        .t-lab {
            padding: 2mm 3mm;
            font-size: 8.8pt;
            color: #6b7079;
        }

        .t-val {
            padding: 2mm 3mm;
            font-size: 8.8pt;
            font-weight: bold;
            color: #3C3F46;
            white-space: nowrap;
            text-align: end;
        }

        /* The fill is painted by the rounded SVG background (inline style). */
        .t-grand {
            color: #3C3F46;
            background-color: #f2b806;
            font-size: 10.5pt;
            font-weight: bold;
            padding: 0;
        }

        .t-grand-cell {
            padding: 3.4mm 3mm;
            color: #3C3F46;
            font-size: 10.5pt;
            font-weight: bold;
        }

        /* ---------- Bottom panel ---------- */

        /* Kept square: its height depends on how many lines the note wraps to,
           and an SVG background must match the cell size exactly. */
        .panel {
            margin-top: 6mm;
            background-color: #F1F1F1;
            page-break-inside: avoid;
        }

        .panel-cell {
            padding: 4mm 6mm;
            vertical-align: middle;
        }

        .thanks {
            font-size: 10pt;
            font-weight: bold;
            color: #3C3F46;
        }

        .note {
            font-size: 8pt;
            color: #7b8089;
            padding-top: 1.6mm;
        }
    </style>

    @if(app()->getLocale() == 'ar')

        <style>
            .text-start{
                text-align: right;
            }

            .text-end{
                text-align: left;
            }
        </style>

    @else
        <style>
            .text-start{
                text-align: left;
            }

            .text-end{
                text-align: right;
            }
        </style>


    @endif
</head>

<body>


    <table>
        <tr>
            <th class="bar" style="width:66%;">{{ __('messages.customer_info') }}</th>
            <th style="width:4mm"></th>
            <th class="bar" style="width:33%">{{ __('messages.invoice_information') }}</th>
        </tr>
        <tr>
            <td style="padding: 2mm; border:1px solid #d5d5cd">
                <table>
                    <tr>
                        <td style="width: fit-content; padding:1mm 2mm">{{ __('messages.name') }}</td>
                        <th style="text-align: right;">{{ $invoice->order->customer->name }}</th>
                    </tr>
                    <tr>
                        <td style="width: fit-content; padding:1mm 2mm">{{ __('messages.phone') }}</td>
                        <th style="text-align: right;">{{ $invoice->order->phone->number }}</th>
                    </tr>
                    <tr>
                        <td style="width: fit-content; padding:1mm 2mm">{{ __('messages.address') }}</td>
                        <th style="text-align: right;">{{ $invoice->order->address->full_address() }}</th>
                    </tr>
                </table>
            </td>
            <td></td>
            <td style="padding: 2mm; border:1px solid #d5d5cd;">
                <table>
                    <tr>
                        <td style="width: fit-content; padding:1mm 2mm; white-space: nowrap">{{ __('messages.order_number') }}</td>
                        <th style="text-align: right;">{{ $invoice->order->formated_id }}</th>
                    </tr>
                    <tr>
                        <td style="width: fit-content; padding:1mm 2mm; white-space: nowrap">{{ __('messages.invoice_number') }}</td>
                        <th style="text-align: right;">{{ $invoice->formated_id }}</th>
                    </tr>
                    <tr>
                        <td style="width: fit-content; padding:1mm 2mm; white-space: nowrap">{{ __('messages.date') }}</td>
                        <th style="text-align: right;">{{ $invoice->created_at->format('d-m-Y') }}</th>
                    </tr>
                    <tr>
                        <td style="width: fit-content; padding:1mm 2mm; white-space: nowrap">{{ __('messages.department') }}</td>
                        <th style="text-align: right;">{{ $invoice->order->department->name }}</th>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="height: 4mm;"></td>
        </tr>
        <tr>
            <td colspan="3" style="padding: 2mm; border:1px solid #d5d5cd">
                <span style="color: #f2b806; font-weight:bold">{{ __('messages.technician') }}</span> : <span>{{ $invoice->order->technician->name }}</span>
            </td>
        </tr>
    </table>

    <!-- {{-- ==================== Items ==================== --}} -->
    <table class="items">
        <thead>
            <tr>
                <th class="item-th text-start" style="width: 55%; color:#f2b806">{{ __('messages.service') }}</th>
            </tr>
        </thead>
        <tbody>

            <!-- {{-- Services Section --}} -->
            @if ($invoice->invoice_details->where('service.type', 'service')->count() > 0)
                <tr>
                    <td  class="section-cell text-start">{{ __('messages.services') }}</td>
                </tr>
                @foreach ($invoice->invoice_details->where('service.type', 'service') as $row)
                    <tr>
                        <td class="item-td text-start">{{ $row->service->name }}</td>
                    </tr>
                @endforeach
            @endif

            <!-- {{-- Parts Section --}} -->
            @if (
                $invoice->invoice_details->where('service.type', 'part')->count() > 0 ||
                    $invoice->invoice_part_details->count() > 0)
                <tr>
                    <td  class="section-cell text-start">{{ __('messages.parts') }}</td>
                </tr>
                @foreach ($invoice->invoice_details->where('service.type', 'part') as $row)
                    <tr>
                        <td class="item-td text-start">{{ $row->service->name }}</td>
                    </tr>
                @endforeach
                @foreach ($invoice->invoice_part_details as $row)
                    <tr>
                        <td class="item-td text-start">{{ $row->name }}</td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <!-- {{-- ==================== Totals ==================== --}} -->
    <table class="totals" align="{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}">
        <tbody>
            @if ($invoice->discount > 0)
                <tr>
                    <td class="t-lab">{{ __('messages.discount') }}</td>
                    <td class="t-val">{{ number_format($invoice->discount, 3) }}</td>
                </tr>
            @endif
            @if ($invoice->delivery > 0)
                <tr>
                    <td class="t-lab">{{ __('messages.delivery') }}</td>
                    <td class="t-val text-end">{{ number_format($invoice->delivery, 3) }}</td>
                </tr>
            @endif
            <tr>
                <td colspan="2" class="t-grand">
                    <table>
                        <tr>
                            <td class="t-grand-cell">{{ __('messages.total') }}</td>
                            <td class="t-grand-cell text-end">{{ number_format($invoice->amount, 3) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            @if ($invoice->cash_amount > 0)
                <tr>
                    <td class="t-lab">{{ __('messages.cash') }}</td>
                    <td class="t-val text-end">{{ number_format($invoice->cash_amount, 3) }}</td>
                </tr>
            @endif
            @if ($invoice->knet_amount > 0)
                <tr>
                    <td class="t-lab">{{ __('messages.knet') }}</td>
                    <td class="t-val text-end">{{ number_format($invoice->knet_amount, 3) }}</td>
                </tr>
            @endif
            <tr>
                <td class="t-lab">{{ __('messages.paid_amount') }}</td>
                <td class="t-val text-end">{{ number_format($invoice->payments->sum('amount'), 3) }}</td>
            </tr>
            @if ($invoice->remaining_amount > 0)
                <tr>
                    <td class="t-lab">{{ __('messages.remaining_amount') }}</td>
                    <td class="t-val text-end">{{ number_format($invoice->remaining_amount, 3) }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- {{-- ==================== Bottom panel ==================== --}} -->
    <table class="panel">
        <tr>
            <td class="panel-cell text-center">
                {{ __('messages.thanks_message') }}
            </td>
        </tr>
    </table>

</body>

</html>
