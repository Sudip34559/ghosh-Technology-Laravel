<?php
namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationsExport implements FromCollection, WithHeadings
{
    /**
     * Return the collection of data for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Fetch all registrations with their related models
        $registrations =  Registration::with(['products', 'installedBy', 'calledBy', 'paymentReceivedBy', 'renual', 'renual.calledBy', 'renual.caseStatus'])
            ->get()
            ->map(function ($registration) {
                return [
                    'expiry_date' => $registration->expiry_date,
                    'installation_date' => $registration->installation_date,
                    'product' => $registration->products->prod_list ?? '',  // Assuming 'prod_list' is the name field
                    'ins_by' => $registration->installedBy->install_by ?? '',  // Adjust field names accordingly
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
                    'call_by' => $registration->calledBy->call_by ?? '',  // Adjust field names accordingly
                    'payment_received_by' => $registration->paymentReceivedBy->	pay_recv_by ?? '',
                    'CASE STATUS' => $registration->renual ? $registration->renual->caseStatus->case_status : '',
                    'FOLLOW UP DATE' => $registration->renual ? $registration->renual->caseStatus->case_status === 'Follow Up' ? $registration->renual->call_time : ''  : '',
                    'CALL DONE' => $registration->renual ? $registration->renual->calledBy !== null ? $registration->renual->calledBy->call_by : '' : '',
                    'COMMENT' => $registration->renual ? $registration->renual->call_note : '', 
                ];
                
            });
            return $registrations;
    
        }

    /**
     * Return the headings for the exported CSV.
     *
     * @return array
     */
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
