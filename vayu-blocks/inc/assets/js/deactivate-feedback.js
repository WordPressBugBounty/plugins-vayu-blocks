(function ($) {
    'use strict';

    var deactivateUrl = '';

    /* --------------------------------------------------
     * Intercept Deactivate click via event delegation.
     * -------------------------------------------------- */
    $(document).on('click.vayuBlocksFeedback', 'a', function (e) {
        var href    = $(this).attr('href') || '';
        var decoded = decodeURIComponent( href );

        // Only intercept our plugin's deactivate link
        if ( decoded.indexOf('action=deactivate') === -1 ) return;
        if ( decoded.indexOf('vayu-blocks/vayu-blocks.php') === -1 ) return;

        var overlay    = document.getElementById('vayu-blocks-deactivate-overlay');
        var submitBtn  = document.getElementById('vayu-df-submit');
        var detailWrap = document.getElementById('vayu-df-detail-wrap');
        var detailText = document.getElementById('vayu-df-detail-text');

        if ( ! overlay ) return;

        e.preventDefault();
        e.stopImmediatePropagation();

        deactivateUrl = href;

        // Reset modal state
        $('input[name="vayu_deactivate_reason"]').prop('checked', false);
        if ( detailText )  detailText.value = '';
        if ( detailWrap )  detailWrap.style.display = 'none';
        if ( submitBtn ) {
            submitBtn.disabled    = false;
            submitBtn.textContent = vayuBlocksDeactivate.i18n.submit;
        }

        overlay.style.display = 'flex';
    });

    /* --------------------------------------------------
     * Show detail textarea for certain reasons
     * -------------------------------------------------- */
    $(document).on('change', 'input[name="vayu_deactivate_reason"]', function () {
        var detailWrap = document.getElementById('vayu-df-detail-wrap');
        if ( detailWrap ) {
            var show = ( this.value === 'other' || this.value === 'missing_feature' );
            detailWrap.style.display = show ? 'block' : 'none';
        }
    });

    /* --------------------------------------------------
     * Close when clicking outside the modal box
     * -------------------------------------------------- */
    $(document).on('click', '#vayu-blocks-deactivate-overlay', function (e) {
        if ( e.target === this ) this.style.display = 'none';
    });

    $(document).on('keydown', function (e) {
        if ( e.key === 'Escape' ) {
            var overlay = document.getElementById('vayu-blocks-deactivate-overlay');
            if ( overlay ) overlay.style.display = 'none';
        }
    });

    /* --------------------------------------------------
     * Skip & Deactivate
     * -------------------------------------------------- */
    $(document).on('click', '#vayu-df-skip', function (e) {
        e.preventDefault();
        var overlay = document.getElementById('vayu-blocks-deactivate-overlay');
        if ( overlay ) overlay.style.display = 'none';
        if ( deactivateUrl ) window.location.href = deactivateUrl;
    });

    /* --------------------------------------------------
     * Submit & Deactivate
     * -------------------------------------------------- */
    $(document).on('click', '#vayu-df-submit', function () {
        var overlay    = document.getElementById('vayu-blocks-deactivate-overlay');
        var submitBtn  = this;
        var detailText = document.getElementById('vayu-df-detail-text');
        var selected   = overlay ? overlay.querySelector('input[name="vayu_deactivate_reason"]:checked') : null;

        // If nothing selected, just deactivate
        if ( ! selected ) {
            if ( overlay ) overlay.style.display = 'none';
            if ( deactivateUrl ) window.location.href = deactivateUrl;
            return;
        }

        submitBtn.disabled    = true;
        submitBtn.textContent = vayuBlocksDeactivate.i18n.submitting;
        fetch( vayuBlocksDeactivate.apiUrl, {
            method  : 'POST',
            headers : {
                'Content-Type' : 'application/json',
                'X-WP-Nonce'   : vayuBlocksDeactivate.nonce
            },
            body : JSON.stringify({
                reason         : selected.value,
                details        : detailText ? detailText.value.trim() : '',
                site_url       : window.location.origin,
                plugin_version : vayuBlocksDeactivate.pluginVersion,
                plugin_name    : vayuBlocksDeactivate.pluginName
            }),
            keepalive : true
        })
        .then(function ( response ) { return response.json(); })
        .catch(function () { /* network error – still deactivate */ })
        .finally(function () {
            if ( overlay ) overlay.style.display = 'none';
            if ( deactivateUrl ) window.location.href = deactivateUrl;
        });
    });

})(jQuery);
