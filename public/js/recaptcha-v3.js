/**
 * Google reCAPTCHA v3 integration.
 * Forms with data-recaptcha-action get a token before submit; token is sent as g-recaptcha-response.
 * Requires the reCAPTCHA script to be loaded (render=siteKey) and grecaptcha to be available.
 */
(function () {
    'use strict';

    var SITE_KEY_ID = 'recaptcha-site-key';
    var ACTION_ATTR = 'data-recaptcha-action';

    function getSiteKey() {
        var el = document.getElementById(SITE_KEY_ID);
        return el ? el.getAttribute('content') : null;
    }

    function getForms() {
        return document.querySelectorAll('form[' + ACTION_ATTR + ']');
    }

    function onSubmit(e) {
        var form = e.target;
        var action = form.getAttribute(ACTION_ATTR);
        var input = form.querySelector('input[name="g-recaptcha-response"]');
        var submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');

        if (!action || !input) return;

        var siteKey = getSiteKey();
        if (!siteKey) return; // reCAPTCHA not configured; submit normally

        e.preventDefault();

        if (submitBtn) {
            submitBtn.disabled = true;
            if (submitBtn.dataset) submitBtn.dataset.recaptchaLoading = '1';
        }

        function doExecute() {
            if (typeof grecaptcha === 'undefined' || !grecaptcha.execute) {
                return Promise.reject(new Error('reCAPTCHA not loaded'));
            }
            return grecaptcha.execute(siteKey, { action: action });
        }

        function waitForGrecaptcha(attempts) {
            attempts = attempts || 0;
            if (attempts > 50) return Promise.reject(new Error('reCAPTCHA timeout'));
            if (typeof grecaptcha !== 'undefined' && grecaptcha.execute) return doExecute();
            return new Promise(function (resolve) { setTimeout(resolve, 100); }).then(function () {
                return waitForGrecaptcha(attempts + 1);
            });
        }

        waitForGrecaptcha().then(function (token) {
            input.value = token;
            if (submitBtn) {
                submitBtn.disabled = false;
                if (submitBtn.dataset) delete submitBtn.dataset.recaptchaLoading;
            }
            form.removeEventListener('submit', onSubmit);
            form.submit();
        }, function (err) {
            if (submitBtn) {
                submitBtn.disabled = false;
                if (submitBtn.dataset) delete submitBtn.dataset.recaptchaLoading;
            }
            if (typeof console !== 'undefined' && console.error) {
                console.error('reCAPTCHA error:', err);
            }
            alert('Security check failed. Please try again.');
        });
    }

    function init() {
        var siteKey = getSiteKey();
        if (!siteKey) return;

        getForms().forEach(function (form) {
            form.addEventListener('submit', onSubmit);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
