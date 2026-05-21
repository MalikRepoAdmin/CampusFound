<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlobalNotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $response = $next($request);

        // Response must be HTML and the session is 'success' or 'status'
        if (method_exists($response, 'getContent') && (session()->has('success') || session()->has('status'))) {
            $message = session('success') ?? session('status');
            
            $localToastScript = "
                <div id='custom-local-toast' style='position: fixed; top: 20px; right: 20px; background-color: #10b981; color: white; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 99999; font-family: sans-serif; display: flex; align-items: center; gap: 12px; min-width: 250px; justify-content: space-between; transition: opacity 0.3s ease;'>
                    <span style='font-weight: 500; font-size: 14px;'>✓ {$message}</span>
                    <button onclick=\"document.getElementById('custom-local-toast').remove()\" style='background: none; border: none; color: white; font-weight: bold; cursor: pointer; font-size: 18px; padding: 0; line-height: 1;'>&times;</button>
                </div>
                <script>
                    setTimeout(function() {
                        var toast = document.getElementById('custom-local-toast');
                        if (toast) {
                            toast.style.opacity = '0';
                            setTimeout(function() { toast.remove(); }, 300);
                        }
                    }, 4000);
                </script>
            ";

            $content = $response->getContent();
            // Add automatic hidden script right before </body>
            $content = str_replace('</body>', $localToastScript . '</body>', $content);
            $response->setContent($content);
        }

        return $response;
    }
}
