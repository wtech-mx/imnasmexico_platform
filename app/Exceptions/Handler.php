<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Mail;
use App\Models\WebPage;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            $message = $exception->getMessage();
            $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
            $subject = "Error $statusCode: $message";

            if (app()->bound('sentry') && $this->shouldReportToSentry($exception)) {
                app('sentry')->captureException($exception);
            }

            if (app()->environment('production')) {
                $this->sendEmail($subject, $exception);
            }

            // Almacenar el error en la sesión para pasarlo a la vista
            session()->flash('error_code', $statusCode);
            session()->flash('error_message', $message);
            session()->flash('error_trace', $exception->getTraceAsString());
        }

        parent::report($exception);
    }

    protected function sendEmail($subject, $exception)
    {
        $webpage = WebPage::first();

        $to = $webpage->email_developer;
        $to2  = $webpage->email_developer_two;

        $message = $exception->getMessage() . "\n\n" .
            $exception->getTraceAsString() . "\n\n" .
            'Request Data: ' . json_encode(request()->all());

        // Mail::raw($message, function ($email) use ($to, $subject) {
        //     $email->to($to)
        //           ->subject($subject);
        // });

        Mail::raw($message, function ($email) use ($to, $to2, $subject) {
            $email->to($to)
                  ->to($to2)
                  ->subject($subject);
        });

    }

}
