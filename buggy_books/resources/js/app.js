import './bootstrap';
import * as Sentry from "@sentry/browser";

window.Sentry = Sentry; 

Sentry.init({
  dsn: "https://7e2d8fbd67bc4397297ff8e603d98df2@o4509634813034496.ingest.us.sentry.io/4509634815459328",
  integrations: [Sentry.replayIntegration()],
  replaysSessionSampleRate: 1.0,
  replaysOnErrorSampleRate: 1.0
});

window.onload = function() {
    // Only trigger the error if the cart is empty
    if (document.body.textContent.includes('Your cart is empty.')) {
        // This will be captured by Sentry and trigger a replay
        Sentry.captureException(new Error('Cart is empty!'));
        // Optionally, throw for console visibility:
        // throw new Error('Cart is empty!');
    }
};



