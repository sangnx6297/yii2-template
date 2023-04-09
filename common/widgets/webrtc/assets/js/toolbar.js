(function () {
    'use strict';

    var findToolbar = function () {
            return document.querySelector('#mini-phone-toolbar');
        },
        url,
        div,
        toolbarEl = findToolbar(),
        toolbarAnimatingClass = 'mini-phone-toolbar_animating',
        toolbarTitleCollapsedClass = 'mini-phone-toolbar_title__collapsed',
        toolbarTitleExpandedlass = 'mini-phone-toolbar_title__expanded',
        toolbarIconSelector = '.mini-phone-toolbar__icon',
        barSelector = '.mini-phone-toolbar__bar',
        viewSelector = '.mini-phone-toolbar__view',
        blockSelector = '.mini-phone-toolbar__block',
        toggleSelector = '.mini-phone-toolbar__toggle',
        externalSelector = '.mini-phone-toolbar__external',
        titleSelector = '.mini-phone-toolbar__title',

        CACHE_KEY = 'mini-phone-toolbar',
        ACTIVE_STATE = 'active',

        animationTime = 300,

        activeClass = 'mini-phone-toolbar_active',
        iframeActiveClass = 'mini-phone-toolbar_iframe_active',
        iframeAnimatingClass = 'mini-phone-toolbar_iframe_animating',
        titleClass = 'mini-phone-toolbar__title',
        // blockClass = 'mini-phone-toolbar__block',
        ignoreClickClass = 'mini-phone-toolbar__ignore_click',
        blockActiveClass = 'mini-phone-toolbar__block_active',
        requestStack = [];

    showToolbar(toolbarEl);


    function showToolbar(toolbarEl) {
        var barEl = toolbarEl.querySelector(barSelector),
            viewEl = toolbarEl.querySelector(viewSelector),
            toggleEl = toolbarEl.querySelector(toggleSelector),
            iconEl = toolbarEl.querySelector(toolbarIconSelector),
            externalEl = toolbarEl.querySelector(externalSelector),
            blockEls = barEl.querySelectorAll(blockSelector),
            titleEl = toolbarEl.querySelector(titleSelector),
            blockLinksEls = document.querySelectorAll(blockSelector + ':not(.' + titleClass + ') a'),
            iframeEl = viewEl.querySelector('iframe'),
            // iframeHeight = function () {
            //     return (window.innerHeight * (toolbarEl.dataset.height / 100) - barEl.clientHeight) + 'px';
            // },
            isIframeActive = function () {
                return toolbarEl.classList.contains(iframeActiveClass);
            },
            // resizeIframe = function(mouse) {
            //     var availableHeight = window.innerHeight - barEl.clientHeight;
            //     viewEl.style.height = Math.min(availableHeight, availableHeight - mouse.y) + "px";
            // },
            // showIframe = function (href) {
            //     toolbarEl.classList.add(iframeAnimatingClass);
            //     toolbarEl.classList.add(iframeActiveClass);
            //
            //     iframeEl.src = externalEl.href = href;
            //     iframeEl.removeAttribute('tabindex');
            //
            //     viewEl.style.height = iframeHeight();
            //     setTimeout(function () {
            //         toolbarEl.classList.remove(iframeAnimatingClass);
            //     }, animationTime);
            // },
            hideIframe = function () {
                toolbarEl.classList.add(iframeAnimatingClass);
                toolbarEl.classList.remove(iframeActiveClass);
                iframeEl.setAttribute("tabindex", "-1");
                removeActiveBlocksCls();

                externalEl.href = '#';
                viewEl.style.height = '';
                setTimeout(function () {
                    toolbarEl.classList.remove(iframeAnimatingClass);
                }, animationTime);
            },
            removeActiveBlocksCls = function () {
                [].forEach.call(blockEls, function (el) {
                    el.classList.remove(blockActiveClass);
                });
            },
            toggleToolbarClass = function (className) {
                toolbarEl.classList.add(toolbarAnimatingClass);
                if (toolbarEl.classList.contains(className)) {
                    toolbarEl.classList.remove(className);
                    [].forEach.call(blockLinksEls, function (el) {
                        el.setAttribute('tabindex', "-1");
                    });
                    titleEl.classList.remove(toolbarTitleExpandedlass);
                    titleEl.classList.add(toolbarTitleCollapsedClass);
                } else {
                    [].forEach.call(blockLinksEls, function (el) {
                        el.removeAttribute('tabindex');
                    });
                    toolbarEl.classList.add(className);
                    titleEl.classList.remove(toolbarTitleCollapsedClass);
                    titleEl.classList.add(toolbarTitleExpandedlass);
                }
                setTimeout(function () {
                    toolbarEl.classList.remove(toolbarAnimatingClass);
                }, animationTime);
            },
            toggleStorageState = function (key, value) {
                if (window.localStorage) {
                    var item = localStorage.getItem(key);

                    if (item) {
                        localStorage.removeItem(key);
                    } else {
                        localStorage.setItem(key, value);
                    }
                }
            },
            // restoreStorageState = function (key) {
            //     if (window.localStorage) {
            //         return localStorage.getItem(key);
            //     }
            // },
            togglePosition = function () {
                if (isIframeActive()) {
                    hideIframe();
                } else {
                    toggleToolbarClass(activeClass);
                    toggleStorageState(CACHE_KEY, ACTIVE_STATE);
                }
            };

        // if (restoreStorageState(CACHE_KEY) === ACTIVE_STATE) {
        //     var transition = toolbarEl.style.transition;
        //     toolbarEl.style.transition = 'none';
        //     toolbarEl.classList.add(activeClass);
        //     setTimeout(function () {
        //         toolbarEl.style.transition = transition;
        //     }, animationTime);
        // } else {
        //     [].forEach.call(blockLinksEls, function (el) {
        //         el.setAttribute('tabindex', "-1");
        //     });
        // }
        //
        // toolbarEl.style.display = 'block';
        //
        // window.onresize = function () {
        //     if (toolbarEl.classList.contains(iframeActiveClass)) {
        //         viewEl.style.height = iframeHeight();
        //     }
        // };
        //
        // toolbarEl.addEventListener("mousedown", function(e) {
        //     if (isIframeActive() && (e.y - toolbarEl.offsetTop < 4 /* 4px click zone */)) {
        //         document.addEventListener("mousemove", resizeIframe, false);
        //     }
        // }, false);
        //
        // document.addEventListener("mouseup", function(){
        //     if (isIframeActive()) {
        //         document.removeEventListener("mousemove", resizeIframe, false);
        //     }
        // }, false);
        //
        // barEl.onclick = function (e) {
        //     var target = e.target,
        //         block = findAncestor(target, blockClass);
        //
        //     if (block
        //         && !block.classList.contains(titleClass)
        //         && !block.classList.contains(ignoreClickClass)
        //         && e.which !== 2 && !e.ctrlKey // not mouse wheel and not ctrl+click
        //     ) {
        //         while (target !== this) {
        //             if (target.href) {
        //                 removeActiveBlocksCls();
        //                 block.classList.add(blockActiveClass);
        //                 showIframe(target.href);
        //             }
        //             target = target.parentNode;
        //         }
        //
        //         e.preventDefault();
        //     }
        // };

        toggleEl.onclick = togglePosition;
        iconEl.onclick = togglePosition;
    }

    // function findAncestor(el, cls) {
    //     while ((el = el.parentElement) && !el.classList.contains(cls)) ;
    //     return el;
    // }
    //
    //
    // /**
    //  * Should AJAX request to be logged in debug panel
    //  *
    //  * @param requestUrl
    //  * @returns {boolean}
    //  */
    // function shouldTrackRequest(requestUrl) {
    //     var a = document.createElement('a');
    //     a.href = requestUrl;
    //     var skipAjaxRequestUrls = JSON.parse(toolbarEl.getAttribute('data-skip-urls'));
    //     if (Array.isArray(skipAjaxRequestUrls) && skipAjaxRequestUrls.length && skipAjaxRequestUrls.includes(requestUrl)) {
    //         return false;
    //     }
    //     return a.host === location.host;
    // }




})();
