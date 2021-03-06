<?php


namespace App\Controller\Payments;


use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Error;
use Symfony\Component\Routing\Annotation\Route;

class StripeController
{
    /**
     * @Route("/donate/create/stripe", methods={"POST"})
     */
    public function createPaymentIntent(): JsonResponse
    {
        Stripe::setApiKey($_ENV['STRIPE_KEY']);

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $json_str = file_get_contents('php://input');
            $json_obj = json_decode($json_str);
            $paymentIntent = \Stripe\PaymentIntent::create(
                [
                    'amount' => 1400,
                    'currency' => 'usd',
                ]
            );
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            return new JsonResponse(
                [
                    $output,
                ],
                Response::HTTP_OK,
            );
        } catch (Error | ApiErrorException $e) {
            http_response_code(500);
            return new JsonResponse(
                [
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
