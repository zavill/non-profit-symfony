<?php


namespace App\Controller\Payments;


use PayPalHttp\HttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PaypalController
{
    /**
     * @Route("/donate/create/paypal", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function createPaymentIntent(): JsonResponse
    {
        $environment = new SandboxEnvironment($_ENV['PAYPAL_CLIENT'], $_ENV['PAYPAL_SECRET']);
        $client = new PayPalHttpClient($environment);
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => "test_ref_id1",
                    "amount" => [
                        "value" => "1.00",
                        "currency_code" => "USD"
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => "http://nmsbc.ga/donate/",
                "return_url" => "http://nmsbc.ga/donate/",
            ]
        ];

        try {
            $response = $client->execute($request);
            return new JsonResponse(
                [
                    $response,
                    Response::HTTP_OK
                ]
            );
        } catch (HttpException $ex) {
            return new JsonResponse(
                [
                    $ex->getMessage(),
                    Response::HTTP_INTERNAL_SERVER_ERROR
                ]
            );
        }
    }

}
