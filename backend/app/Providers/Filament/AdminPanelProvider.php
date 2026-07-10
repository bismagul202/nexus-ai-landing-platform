<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => '#a3e635', // Vibrant lime/neon accent matching your chart highlights
                'gray' => Color::Slate,
            ])
            ->font('Inter') 
            ->brandName('Nexus AI Landing Platform')
            ->maxContentWidth('2xl')
            ->sidebarFullyCollapsibleOnDesktop()
            ->darkMode(true) // Bonus feature integration active!
            
            // 🔥 Pure Premium Custom CSS for exact layout transformation
            ->renderHook(
                'filament::styles.end',
                fn () => new \Illuminate\Support\HtmlString("
                    <style>
                        /* Strict Style Force Override */
                        body, html, .fi-layout, .fi-main {
                            background-color: #eef5f0 !important; /* Content area pastel tint */
                        }
                        aside.fi-sidebar, .fi-sidebar-header, .fi-sidebar-nav {
                            background-color: #0b2211 !important; /* Matte Forest Green Sidebar */
                        }
                        .fi-sidebar-header span, .fi-sidebar-nav-label, .fi-sidebar-item-label {
                            color: #e2e8f0 !important;
                        }
                        .fi-sidebar-item-icon {
                            color: #94a3b8 !important;
                        }
                        .fi-sidebar-item-button.fi-active {
                            background-color: #a3e635 !important;
                        }
                        .fi-sidebar-item-button.fi-active .fi-sidebar-item-label,
                        .fi-sidebar-item-button.fi-active .fi-sidebar-item-icon {
                            color: #0b2211 !important;
                        }
                        header.fi-topbar {
                            background-color: #0b2211 !important;
                            border-bottom: 1px solid #14351d !important;
                        }
                        header.fi-topbar * {
                            color: #ffffff !important;
                        }
                    </style>
                ")
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \Filament\Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\InjectFilamentCustomStyles::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}