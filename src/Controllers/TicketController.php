<?php

namespace App\Controllers;

use App\Models\Ticket;
use App\Services\PaymentService;

class TicketController 
{
    protected $ticketModel;
    protected $paymentService;

    public function __construct() {
        $this->ticketModel = new Ticket();
        $this->paymentService = new PaymentService();
    }

    // Method to manage tickets
    public function manageTicket($ticketData) {
        // Here you can add logic to create, update or delete tickets
        return $this->ticketModel->save($ticketData);
    }

    // Method to purchase a ticket
    public function purchaseTicket($ticketId, $paymentDetails) {
        $ticket = $this->ticketModel->find($ticketId);

        if (!$ticket) {
            return 'Ticket not found';
        }

        // Handle payment
        $paymentResponse = $this->paymentService->processPayment($paymentDetails);

        if ($paymentResponse['success']) {
            // Logic to mark ticket as sold
            return 'Ticket purchased successfully';
        } else {
            return 'Payment failed: ' . $paymentResponse['message'];
        }
    }
}
