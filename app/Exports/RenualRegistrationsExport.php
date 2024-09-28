<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RenualRegistrationsExport implements FromCollection,  WithHeadings
{
    protected $registrations;

    // Pass data through constructor
    public function __construct($registrations)
    {
        $this->registrations = $registrations;
    }

    /**
     * Return the collection of data for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $registrations =  $this->registrations->map(function ($registration) {
            return [
                'expiry_date' => $registration->expiry_date,
                'installation_date' => $registration->installation_date,
                'product' => $registration->products->prod_list ?? '', 
                'ins_by' => $registration->installedBy->install_by ?? '',
                'customer_name' => $registration->customer_name,
                'email_id' => $registration->email_id,
                'mobile_no' => $registration->mobile_no,
                'product_key_1' => $registration->product_key_1,
                'product_key_2' => $registration->product_key_2,
                'product_key_3' => $registration->product_key_3,
                'product_key_4' => $registration->product_key_4,
                'product_key_5' => $registration->product_key_5,
                'product_key_6' => $registration->product_key_6,
                'product_key_7' => $registration->product_key_7,
                'product_key_8' => $registration->product_key_8,
                'product_key_9' => $registration->product_key_9,
                'product_key_10' => $registration->product_key_10,
                'renewal_key' => $registration->renewal_key,
                'amount' => $registration->amount,
                'address' => $registration->address,
                'batch_no' => $registration->batch_no,
                'call_by' => $registration->calledBy->call_by ?? '',
                'payment_received_by' => $registration->paymentReceivedBy->pay_recv_by ?? '',
                'CASE STATUS' => $registration->renual ? $registration->renual->caseStatus->case_status : '',
                'FOLLOW UP DATE' => $registration->renual ? $registration->renual->caseStatus->case_status === 'Follow Up' ? $registration->renual->call_time : ''  : '',
                'CALL DONE' => $registration->renual ? $registration->renual->calledBy !== null ? $registration->renual->calledBy->call_by : '' : '',
                'COMMENT' => $registration->renual ? $registration->renual->call_note : '',
            ];
        });
        return $registrations;
    }

    public function headings(): array
    {
        return [
            'EXPIRY_DATE',
            'INSTALLATION_DATE',
            'PRODUCT',
            'INS BY',
            'CUSTOMER NAME',
            'E-MAIL ID',
            'MOBILE NO',
            'PRODUCT KEY 1',
            'PRODUCT KEY 2',
            'PRODUCT KEY 3',
            'PRODUCT KEY 4',
            'PRODUCT KEY 5',
            'PRODUCT KEY 6',
            'PRODUCT KEY 7',
            'PRODUCT KEY 8',
            'PRODUCT KEY 9',
            'PRODUCT KEY 10',
            'Renewal Key',
            'AMOUNT',
            'ADDRESS',
            'BATCH NO',
            'CALL BY',
            'PAYMENT RECEIVED BY',
            'CASE STATUS',
            'FOLLOW UP DATE',
            'CALL DONE',
            'COMMENT', 
        ];
    }
}
