/* global define, console, $, jQuery, lozad, loadjs, player */
'use strict';
let loc = '';
if (window.location.hostname === 'www.phpcrudgenerator.com') {
    // remove the language folder if any
    loc = '/documentation/';
}

loadjs([
    loc + 'assets/javascripts/plugins/loaders/pace.min.js',
    loc + 'assets/javascripts/jquery-3.5.1.min.js',
    loc + 'assets/javascripts/popper.min.js',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'
], 'core',
    {
        async: false
    }
);

loadjs([
    'https://cdnjs.cloudflare.com/ajax/libs/cloudinary-core/2.11.1/cloudinary-core-shrinkwrap.min.js'
], function () {
    loadjs.done('bundleA');
});

// cloudinary loaded
// - the function replaces the src url (relative or root-relative) with cloudinary URL
//   it uses fixed width for images with a "width" attribute
//
// - use data-max-w attribute to limit the img width (will generate srcset + sizes).
//   ie: data-max-w="750"
//
// - add data-ratio attribute to set automatic image height. Ratio is width/height.
//   ie: data-ratio="1.5"
//

loadjs.ready('core', function () {
    jQuery.event.special.touchstart = {
        setup: function (_, ns, handle) {
            this.addEventListener("touchstart", handle, { passive: true });
        }
    };

    if ($('.sidebar')[0]) {
        loadjs([
            loc + 'assets/javascripts/plugins/OverlayScrollbars.min.js'
        ], function () {
            loadjs.done('overlayscrollbars');
        });
    }

    $('a[href^="#"]').on('click', function (e) {
        const anchor = $.attr(this, 'href').substr(1);
        if (anchor.length < 1) {
            e.preventDefault();
            return;
        }
        const $targetLink = $('#' + $.attr(this, 'href').substr(1)),
            dataToggle = $(this).attr('data-toggle');
        if ($targetLink[0] && dataToggle != 'modal' && dataToggle != 'collapse') {
            $('html, body').animate(
                {
                    scrollTop: $targetLink.offset().top - 56
                },
                500
            );
        } else if (dataToggle == 'collapse') {
            window.location.hash = $(e.target).attr('id');
        }
    });

    if (location.hash != '' && $(location.hash)[0]) {
        const $link = $(location.hash),
            $targetLink = $($link.attr('href'));
        if ($targetLink[0] && $targetLink.hasClass('collapse')) {
            $targetLink.on('shown.bs.collapse', function () {
                $('html, body').animate(
                    {
                        scrollTop: $link.offset().top - 56
                    },
                    0,
                    function () {
                        $link.off('shown.bs.collapse');
                    }
                );
                return false;
            });
            $targetLink.collapse('show');
        }
    }

    if ($('#video-nav')[0]) {
        $('#video-nav a').on('click', function (e) {
            e.preventDefault();
            const seconds = $(this).attr('data-time');
            player.seekTo(seconds);

            return false;
        });
    }

    if ($('#search-form')[0]) {
        $('#search-form').on('submit', function () {
            $('#search-submit i').removeClass('fas fa-search').addClass('fas fa-spinner fa-spin');
        })
    }

    if ($('a[data-fancybox]')[0]) {
        loadjs([
            'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css'
        ]);
    }
});

loadjs.ready(['bundleA'], function () {
    const cloudFolder = 'phpcg',
        cloudName = 'migli';
    let responsivePreset = `w_auto,q_auto,f_auto,dpr_auto,c_scale/${cloudFolder}`,
        fixedWidthPreset = `w_{width},q_auto,f_auto,dpr_auto,c_scale/${cloudFolder}`,
        maxWidthPreset = `w_{width},q_auto,f_auto,dpr_auto,c_scale/${cloudFolder}{src} {width}w`;

    let images = document.querySelectorAll('.cld-responsive'),
        loc = window.location.pathname,
        currentFolder = loc.substring(0, loc.lastIndexOf('/')),
        cloudUrl = `https://res.cloudinary.com/${cloudName}/image/upload/`,
        defaultBreakpoints = [360, 540, 630, 720, 840, 960, 1050, 1140];

    const myObserver = new ResizeObserver(entries => {
        for (let entry of entries) {
            let img = entry.target;
            img.setAttribute('style', 'height:' + parseFloat(getComputedStyle(img, null).width.replace('px', '')) / img.getAttribute('data-ratio') + 'px');
        }
    });

    images.forEach(function (img, i) {
        let src = img.getAttribute('data-src'),
            fixedWidthAttr = img.getAttribute('data-fixed-width'),
            maxWidthAttr = img.getAttribute('data-max-width'),
            widthAttr = img.getAttribute('width');

        if (!src.startsWith('/')) {
            src = currentFolder + '/' + src;
        }

        img.setAttribute('data-src', cloudUrl + responsivePreset + src);

        if (fixedWidthAttr === 'true') {
            img.setAttribute('data-src', cloudUrl + fixedWidthPreset.replace('{width}', widthAttr) + src);
        } else if (maxWidthAttr !== null) {
            let maxWidth = parseInt(maxWidthAttr, 10),
                srcset = '';
            defaultBreakpoints.forEach(function (bp, j) {
                if (bp < maxWidth) {
                    if (j === 0) {
                        img.setAttribute('data-src', cloudUrl + fixedWidthPreset.replace('{width}', bp) + src);
                    }
                    srcset += cloudUrl + maxWidthPreset.replace(/{width}/g, bp).replace('{src}', src) + ',';
                }
            });
            srcset += cloudUrl + maxWidthPreset.replace(/{width}/g, maxWidth).replace('{src}', src);
            Object.assign(img, {
                srcset: srcset,
                sizes: '(min-width: ' + maxWidth + 'px) ' + maxWidth + 'px, 100vw',
                style: 'max-width: 100%'
            });
        }

        if (img.getAttribute('data-ratio') !== null && widthAttr > 0) {
            img.setAttribute('style', 'height:' + parseInt(widthAttr) / img.getAttribute('data-ratio') + 'px');
            myObserver.observe(img);
        }
    });

    const cl = cloudinary.Cloudinary.new({ cloud_name: cloudName });
    cl.config({ breakpoints: defaultBreakpoints, responsive_use_breakpoints: 'resize' });
    cl.responsive();
});

loadjs.ready('overlayscrollbars', function () {
    /*===============================
    =            Sidebar            =
    ===============================*/

    OverlayScrollbars(document.querySelector('#sidebar-main'), {
        overflowBehavior: {
            x: "scroll",
            y: "scroll"
        }
    });

    function toggleSidebar () {
        if ($('body').hasClass('sidebar-collapsed')) {
            $('body').addClass('sidebar-open').removeClass('sidebar-collapsed');
            const $sidebarBackdrop = $('<div class="sidebar-backdrop"></div>');
            $('body').append($sidebarBackdrop);
            $sidebarBackdrop.on('click', function () {
                toggleSidebar();
            })
        } else {
            $('body').removeClass('sidebar-open').addClass('sidebar-collapsed');
            $('.sidebar-backdrop').remove();
        }
    }

    if ($('body').width() >= 768) {
        $('body').addClass('sidebar-open');
    } else {
        $('body').addClass('sidebar-collapsed');
    }
    $('.sidebar-toggler').on('click', toggleSidebar);
});
