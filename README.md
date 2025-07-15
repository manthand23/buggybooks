# Buggybooks

BuggyBooks is a Laravel web app created for Sentry’s Developer Experience Engineer interview exercise. The goal was to create a simple full-stack application and integrate Sentry's SDK to monitor errors, session replays, and performance traces—while documenting the end-to-end experience from a DX (Developer Experience) lens.

# What Is This?

A basic Laravel app that mimics a small online bookstore. It includes:

- A homepage with a simple form to look up books
- Backend logic for form handling. The app uses google books API to find books relevant to the users search.
- Intentionally introduced bugs 

Full Sentry integration:

✅ Error tracking

✅ Session replay

✅ Performance monitoring

This app is designed as both a testbed for Sentry instrumentation.

# Setup Instructions
git clone https://github.com/manthand23/buggybooks.git
cd buggybooks

// Install dependencies
composer install
cp .env.example .env
php artisan key:generate

// Set up your Sentry credentials
// Add your DSN to .env (SENTRY_LARAVEL_DSN)

// Serve the app
php artisan serve


# My Methodology

- Kept It Simple: Designed a minimal Laravel + Blade app to focus on instrumentation, not features.
- Instrument as I Go: Integrated Sentry piece-by-piece—errors, then performance, then session replay.
- Break Things on Purpose: Introduced common bugs (e.g., divide-by-zero) to test Sentry detection.
- Reflect Constantly: Logged setup friction, mental hurdles, and places Sentry or Laravel tripped me up.

# Core Friction Points
- Content Security Policy: Sentry session replay required script allowances that clashed with Laravel defaults.
- Session Replay: Enabling session replay in Sentry UI was easy, but actual capture failed silently at first.

# Areas to Explore Further
- Advanced Tracing: Add DB query spans or simulate longer server responses to explore APM use cases.

# Content Opportunities:
1. Laravel + Sentry Quickstart: One consolidated doc page with env setup, CSP tweaks, and form example.
2. Session Replay Troubleshooting Guide: Common blockers (e.g., CSP, browser restrictions).
3. Short-Form Tutorial Series: e.g., “Fix This App” challenges using BuggyBooks-like examples.
4. DX Logs: Publish real developer session logs + setup friction anonymously to identify trends.
