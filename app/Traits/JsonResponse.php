<?php

namespace App\Traits;

use DB;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

trait JsonResponse
{
    /**
     * This method shall be used to send a successfull json response
     *
     * @author Jomit
     *
     * @param array|\Illuminate\Support\Collection|null $data The data to be sent in the response
     * @param string|null $message The message to be sent in the response
     * @param integer $statusCode The status code of the response
     * @param integer|null $customCode A custom we send for identifying various scenarios
     * @param array|null $headers Custom headers to be attached to response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data = [], $message = 'Success', $statusCode = 200, $customCode = null, $headers = [])
    {
        if (empty($statusCode)) {
            $statusCode = 200;
        }
        if (is_string($data)) {
            $message = $data;
            $data = [];
        }

        return $this->sendJsonResponse($data, $message, [], $statusCode ?? 404, $customCode, true, $headers);
    }

    /**
     * This method shall be used to send a failiure json response
     *
     * @param  Throwable|string|null  $message  The message to be sent in the response
     * @param  integer  $statusCode  The status code of the response
     * @param  array  $errors  The errors. Usually this is used for sending validation errors
     * @param  integer|null  $customCode  A custom we send for identifying various scenarios
     * @param  array|null  $headers  Custom headers to be attached to response
     * @param  array  $data
     * @return \Illuminate\Http\JsonResponse
     * @throws Throwable
     * @author Jomit
     *
     */
    public function sendError(
        $message = 'Technical Error. Please Try again Later',
        $statusCode = 404,
        $errors = [],
        $customCode = null,
        $headers = [],
        $data = []
    ) {
        // We are rolling back transactions here so that any locks we applied on tables get released
        // and so that any query we execute in this response handler remains unaffected by the transaction
        DB::rollback();


        if ($message instanceof Throwable) {
            $exceptionHeaders = [];
            // If the exception is an instance of HtppException, then it may have headers
            // which were assigned by framework or by us
            if ($message instanceof HttpException) {
                // we get those headers and merge the headers
                $exceptionHeaders = $message->getHeaders();
                $headers = array_merge($headers, $exceptionHeaders);
            }

            if ($message instanceof AuthenticationException) {
                $statusCode = 401;
                $message = 'Unauthenticated';
            } else if ($message instanceof ModelNotFoundException) {
                $statusCode = 404;
                $message = 'Resource not Found';
            } else if ($message instanceof TokenMismatchException) {
                $statusCode = 419;
                $message = 'Page Expired. Please Refresh the page and try again';
            } else if ($message instanceof TooManyRequestsHttpException) {
                // If the exception is a rate limited exception
                $statusCode = 429;
                // we check if there is a Retry-After Header
                // Usually this header will contain the number of seconds
                // the user needs to wait before they are unblocked
                // So we send a custom message
                // In our js error handler, we check for this Retry-After header and show
                // seconds properly based on the header value,
                if (isset($exceptionHeaders['Retry-After']) && $exceptionHeaders['Retry-After']) {
                    $seconds = $exceptionHeaders['Retry-After'];
                    $message = 'We have received too many requests from your side. Please wait for ' . $seconds . ' seconds and try again';
                } else {
                    $message = $message->getMessage();
                }
            } else {
                $message = $message->getMessage();
            }
        }

        if (app()->isProduction() && $statusCode == 500) {
            // Sending common message in case of 500 errors.
            // This is to avoid sql queries being returned to the user in the exception messages
            $message = 'Technical Error. Please Try again Later';
        }


        return $this->sendJsonResponse($data, $message, $errors, $statusCode ?? 404, $customCode, false, $headers);
    }
    /**
     * This method logs all api error responses
     * This is for debugging purposes only
     * Sensitive data, such as password, user card data, etc must be hidden
     *
     * @param mixed $error
     * @param integer $code
     * @param array $errors
     *
     * @return void
     */
    public function logErrorMessage($error, $code, $errors = [])
    {
        $logData = [];
        $request = request();
        $user = $request->user();

        if (!empty($user)) {
            $logData['user_id'] = $user->id;
        }
        $logData['agent'] = $request->header('user-agent');
        $logData['url'] = $request->url();
        $logData['method'] = $request->method();
        $logData['controllerAction'] = optional($request->route())->getActionName();
        $logData['error'] = $error;
        $logData['errors'] = $errors;
        $logData['code'] = $code;
        $data = $request->all();
        $keysToHide = [
            'otp',
            'password',
            'password_confirmation'
        ];
        foreach ($keysToHide as $key) {
            $value = \Arr::get($data, $key);
            // The length of the value
            $length = strlen($value);
            // If the value is not null or empty string
            if ($length) {
                // Then replace the value with *. Number of stars = number of characters
                \Arr::set($data, $key, str_repeat('*', $length));
            }
        }
        $logData['data'] = $data;
        logger()->channel('api')->error($error, $logData);
    }

    /**
     * Common method for sending json response
     *
     * @author Jomit
     *
     * @param array $data The data to be send
     * @param string $message The message
     * @param array $errors Array of validation errors if any
     * @param integer $statusCode The status code (Ex: 200,404,etc)
     * @param integer $customCode A custom code for identifying special cases
     * @param boolean $success Boolean indicating whether request is success or failiure
     * @param array $headers Custom headers to be attached to response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendJsonResponse($data = [], $message = 'Success', $errors = [], $statusCode, $customCode, $success, $headers)
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
            'message' => $message,
            'code' => $customCode ?? $statusCode,
            'errors' => $errors,
        ], $statusCode)
            ->withHeaders($headers);
    }
}
