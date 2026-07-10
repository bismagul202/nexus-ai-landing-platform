<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InjectFilamentCustomStyles
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (method_exists($response, 'getContent') && str_contains($response->headers->get('Content-Type') ?? '', 'text/html')) {
            $content = $response->getContent();
            
           $customCss = "
        <style>
            /* Sidebar Background */
            .fi-sidebar {
                background-color: #0b2211 !important;
            }

            /* Inactive Tabs: Force White Text */
            .fi-sidebar-item-button .fi-sidebar-item-label,
            .fi-sidebar-item-button .fi-sidebar-item-icon {
                color: #ffffff !important;
            }

            /* Active State: Lime Green Background + Dark Text */
            /* Filament ka active link aksar [aria-current='page'] use karta hai */
            .fi-sidebar-item-button[aria-current='page'],
            .fi-sidebar-item-button.fi-active {
                background-color: #a3e635 !important;
                border-radius: 8px !important;
            }
            
            .fi-sidebar-item-button[aria-current='page'] .fi-sidebar-item-label,
            .fi-sidebar-item-button[aria-current='page'] .fi-sidebar-item-icon,
            .fi-sidebar-item-button.fi-active .fi-sidebar-item-label,
            .fi-sidebar-item-button.fi-active .fi-sidebar-item-icon {
                color: #0b2211 !important;
                font-weight: 700 !important;
            }
        </style>
        ";

            $content = str_replace('</head>', $customCss . '</head>', $content);
            $response->setContent($content);
        }

        return $response;
    }
}